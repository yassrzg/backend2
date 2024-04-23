<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Categorie;
use App\Entity\Devis;
use App\Entity\Formation;
use App\Entity\Hours;
use App\Entity\Livraison;
use App\Entity\Personnalisation;
use App\Entity\Produit;
use App\Entity\Skills;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);
//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BydSite');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-user', Categorie::class);
        yield MenuItem::linkToCrud('Personnalisation', 'fas fa-user', Personnalisation::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-user', Produit::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-user', Avis::class);
        yield MenuItem::linkToCrud('Heure', 'fas fa-user', Hours::class);
        yield MenuItem::linkToCrud('Devis', 'fas fa-user', Devis::class);
        yield MenuItem::linkToCrud('Skills', 'fas fa-user', Skills::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-user', Formation::class);
        yield MenuItem::linkToCrud('Livraison', 'fas fa-truck', Livraison::class);
    }
}
