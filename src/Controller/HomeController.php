<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends AbstractController {

    #[Route('/home', name: 'app_home')]
    public function index() : Response {
        return $this->render(
            'base.html.twig', [
                'titre' => 'Page d\'accueil',
                'contenu' => 'Bienvenue sur la page d\'accueil du site',
            ]
        );
    }

}