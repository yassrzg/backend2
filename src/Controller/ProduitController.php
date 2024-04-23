<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class ProduitController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        $categorie = $this->entityManager->getRepository(Categorie::class)->findAll();


        return $this->render('produit/index.html.twig', [
            'categories' => $categorie
        ]);
    }

    #[Route('/produit/{slug}', name: 'app_produit_show')]
    public function show($slug): Response
    {
        $produit = $this->entityManager->getRepository(Produit::class)->findOneBySlug($slug);
        if (!$produit) {
            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/produit.html.twig', [
            'produit' => $produit
        ]);
    }
}
