<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Devoirs;
use App\Form\DevoirsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class DevoirsController extends AbstractController
{
    #[Route('/devoirs/new', name: 'app_devoirs_new', methods: ['GET', 'POST'])]

    public function new(Request $request, EntityManagerInterface $em): Response
    {
        // Créer un nouvel objet Devoirs()
        $devoir = new Devoirs();

        // Créer le formulaire
        $form = $this->createForm(DevoirsType::class, $devoir);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($devoir);
            $em->flush();

            // Ajoute un message de succès
            $this->addFlash('success', 'Le devoir a été créé avec succès !');

            // Redirige après enregistrement
            return $this->redirectToRoute('app_devoirs_new');
        }

        // Envoyer le formulaire à la vue
        return $this->render('devoirs/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
