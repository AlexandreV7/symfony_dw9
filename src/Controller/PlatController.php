<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlatController extends AbstractController {
    #[IsGranted('ROLE_USER')]
    #[Route('/plat/add', name: 'app_plat_add')]
    public function index(Request $request, EntityManagerInterface $em): Response {
        $plat = new Plat;
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile */
            $image = $form->get('image')->getData();

            $dossier = __DIR__ . '/../../public/uploads/plats';
            $nouveauNom = uniqid() . '.' . $image->guessExtension();

            $image->move($dossier, $nouveauNom);

            $plat->setImage($nouveauNom);

            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('home', [
                'id' => $plat->getUtilisateur()->getId()
            ]);
        }

        return $this->render('plat/index.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}
