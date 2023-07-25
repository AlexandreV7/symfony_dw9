<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController {
    #[IsGranted('ROLE_USER')]
    #[Route('/users/me', name: 'home_bizarre')]
    function home(): Response {

        $this->isGranted('ROLE_USER'); // booléen
        $this->denyAccessUnlessGranted('ROLE_USER'); // Lance une exception si pas granted

        $utilisateur = $this->getUser();

        return $this->render(
            'home.html.twig', // string : le nom de la vue
            [
                // array : les variables disponibles dans la vue 
                // (clef = nom de la variable ; valeur = valeur de la variable)
                'utilisateur' => $utilisateur
            ]
        );
    }

    #[Route('/', name: 'home')]
    function vraieHome(): Response {
        return $this->render('vraie_home.html.twig');
    }

    #[Route('/test', name: 'home')]
    function test(VoitureRepository $vr): Response {
        $voitures = $vr->recupererLesVoituresQueJeVeux(100000);
        dd($voitures);
    }
}
