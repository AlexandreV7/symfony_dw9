<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UtilisateurFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurCrudController extends AbstractController {
    #[Route('/utilisateur/create', name: 'utilisateur_create')]
    public function index(Request $request, EntityManagerInterface $em): Response {
        $utilisateur = new User;

        $form = $this->createForm(UtilisateurFormType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('home', [
                'id' => $utilisateur->getId()
            ]);
        }


        return $this->render('utilisateur_crud/formulaire.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }

    #[Route('/utilisateur/update/{id}', name: 'utilisateur_update')]
    public function update(int $id, UserRepository $ur, Request $request, EntityManagerInterface $em): Response {
        $utilisateur = $ur->find($id);

        $form = $this->createForm(UserFormType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('home', [
                'id' => $utilisateur->getId()
            ]);
        }

        $this->addFlash('error', 'Tu t\'es gourré');

        return $this->render('utilisateur_crud/formulaire.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
