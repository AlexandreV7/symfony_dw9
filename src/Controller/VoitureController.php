<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/voitures', name: 'app_voiture')]
class VoitureController extends AbstractController {
    #[Route('/', name: '_liste')]
    public function liste(VoitureRepository $vr): Response {
        return $this->render('voiture/liste.html.twig', [
            'voitures' => $vr->findAll(),
        ]);
    }

    #[Route('/add', name: '_add')]
    public function add(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response {
        $voiture = new Voiture;
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();

            if ($voiture->getUtilisateur()) {
                $email = (new Email())
                    ->from('monsite@yopmail.fr')
                    ->to($voiture->getUtilisateur()->getEmail())
                    ->subject('Nouvelle voiture')
                    ->text('Vous avez une nouvelle voiture ! C\'est une ' . $voiture->getMarque() . ' ' . $voiture->getModele() . ' !');

                $mailer->send($email);
            }

            return $this->redirectToRoute('app_voiture_liste');
        }


        return $this->render('voiture/formulaire.html.twig', [
            'titre' => 'Créer une voiture',
            'formulaire' => $form->createView(),
        ]);
    }

    #[Route('/update/{id}', name: '_update')]
    function update($id, VoitureRepository $vr, Request $request, EntityManagerInterface $em) {
        $voiture = $vr->find($id);

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();

            $this->addFlash('success', 'Modifications effectuées.');
        }

        return $this->render('voiture/formulaire.html.twig', [
            'titre' => 'Modifier une voiture',
            'formulaire' => $form->createView()
        ]);
    }

    #[Route('/details/{id}', name: '_details')]
    function details($id, VoitureRepository $vr) {
        $voiture = $vr->find($id);

        return $this->render('voiture/details.html.twig', [
            'voiture' => $voiture
        ]);
    }

    #[Route('/delete/{voiture}', name: '_delete')]
    function delete(Voiture $voiture, Request $request, EntityManagerInterface $em) {
        if (!$this->isCsrfTokenValid('delete', $request->query->get('token'))) {
            // Protection CSRF "à la mano"
            throw new AccessDeniedHttpException;
        }

        // Symfony, grâce au typage et à l'injection de dépendance
        // Va nous chercher directement la voiture parce qu'on lui demande
        // Et alors qu'il n'a que l'ID
        $em->remove($voiture);
        $em->flush();

        return $this->redirectToRoute('app_voiture_liste');
    }
}
