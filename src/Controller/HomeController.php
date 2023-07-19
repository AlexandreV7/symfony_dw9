<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/users/{id}', name: 'home')]
    function home(int $id, UtilisateurRepository $ur): Response {

        $utilisateur = $ur->find($id); // UN utilisateur : objet
        // $utilisateur = $ur->findAll(); // Tableaux d'utilisateurs : array
        // $utilisateur = $ur->findBy([ // Tableaux d'utilisateurs : array
        //     'prenom' => 'Jordan'
        // ]);
        // $utilisateur = $ur->findOneBy([ // UN utilisateur : objet
        //     'prenom' => 'Jordan'
        // ]);

        // J'appelle la vue
        return $this->render(
            'home.html.twig', // string : le nom de la vue
            [
                // array : les variables disponibles dans la vue 
                // (clef = nom de la variable ; valeur = valeur de la variable)
                'utilisateur' => $utilisateur
            ]
        );
    }
}
