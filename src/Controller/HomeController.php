<?php

// src/Controller/HomeController.php

namespace App\Controller;

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends AbstractController {

    #[Route('/home', name: 'app_home')]
    public function index() : Response {
        // test de moteur de template Twig
        // variables
        $chaine = 'Bonjour';
        $nombre = 5;
        $objet = new stdClass();
        $objet->prop1 = 'valeur 1';
        $tableau = array(
            'cle1' => 'valeur1',
        );

        return $this->render(
            'base.html.twig', [
                'titre' => 'Page d\'accueil',
                'contenu' => 'Bienvenue sur la page d\'accueil du site',
                // test de moteur de template Twig
                // variables
                'chaine' => $chaine,
                'nombre' => $nombre,
                'objet' => $objet,
                'tableau' => $tableau,
            ]
        );
    }

}