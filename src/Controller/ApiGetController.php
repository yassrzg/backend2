<?php

namespace App\Controller;


use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiGetController extends AbstractController
{
    #[Route('/api/getProduit/{slug}', name: 'app_api_getProduit')]
    public function avisByRecette(ProduitRepository $produitRepository, SerializerInterface $serializer, $slug): JsonResponse
    {
        $produit = $produitRepository->findBy(['slug' => $slug]);
        $jsonProduit = $serializer->serialize($produit, 'json', ['groups' => 'produit']);
        return new JsonResponse($jsonProduit, Response::HTTP_OK, [], true);
    }
    #[Route('/api/getProduit', name: 'app_api_getProduit')]
    public function produit(ProduitRepository $produitRepository, SerializerInterface $serializer): JsonResponse
    {
        $produit = $produitRepository->findAll();
        if($produit) {
            $jsonProduit = $serializer->serialize($produit, 'json', ['groups' => 'produit']);
            return new JsonResponse($jsonProduit, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);

    }
}
