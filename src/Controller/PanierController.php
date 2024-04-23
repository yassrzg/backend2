<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/mon-panier', name: 'app_mon_panier')]
    public function index(Panier $panier): Response
    {
        $panierComplet = [];
        foreach ($panier->get() as $id => $quantity) {
            $panierComplet[] = [
                'product' => $this->entityManager->getRepository(Produit::class)->findOneById($id),
                'quantity' => $quantity
            ];
        }
        return $this->render('panier/index.html.twig', [
            'panier' => $panierComplet
        ]);
    }

    #[Route('/mon-panier/add/{id}', name: 'app_add_to_mon_panier')]
    public function addProduit(Panier $panier, $id): Response
    {

        $panier->add($id);
        return $this->redirectToRoute('app_mon_panier');
    }
    #[Route('/mon-panier/remove', name: 'app_remove_mon_panier')]
    public function removeProduit(Panier $panier): Response
    {

        $panier->remove();
        return $this->redirectToRoute('app_produit');
    }
}
