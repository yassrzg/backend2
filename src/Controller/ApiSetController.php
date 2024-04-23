<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class ApiSetController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer, Security $security) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;

    }

    #[Route('/api/setUser', name: 'app_api_setUser')]
    public function user(Request $request ,UserPasswordHasherInterface $hashPassword): JsonResponse
    {
        $content = json_decode($request->getContent());
        $newUser = new User();
        if($content != null) {
            $userExist = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $content->email]);
            if(!$userExist) {
                $newUser->setEmail($content->email);
                $newUser->setRoles(['ROLE_USER']);
                $newUser->setName($content->name);
                $newUser->setSurname($content->surname);
                $password = $hashPassword->hashPassword($newUser,$content->password);
                $newUser->setPassword($password);
                $newUser->setNumberPhone($content->number);

                $this->entityManager->persist($newUser);
                $this->entityManager->flush();
                return new JsonResponse(['message' => 'Opération réussie'],
                    200);
            }
        }
        return new JsonResponse(['message' => 'Erreur dans les données fournies'], 400);
    }
}
