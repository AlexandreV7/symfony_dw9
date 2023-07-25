<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Entity\User;
use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController {
    #[Route('/admin', name: 'admin')]
    public function index(): Response {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard {
        return Dashboard::new()
            ->setTitle('Back-Office')
            ->renderContentMaximized()
            ->setLocales(['fr']);
    }

    public function configureMenuItems(): iterable {
        return [
            MenuItem::linkToRoute('Revenir à l\'accueil', 'fa-solid fa-house', 'home'),

            MenuItem::section('Les CRUD'),
            MenuItem::linkToCrud('Plats', 'fa-solid fa-drumstick-bite', Plat::class),
            MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class),
            MenuItem::linkToCrud('Voitures', 'fa-solid fa-car', Voiture::class),
            
            MenuItem::section('Autres'),
            MenuItem::linkToLogout('Se déconnecter', 'fa-solid fa-right-from-bracket')
        ];
    }
}
