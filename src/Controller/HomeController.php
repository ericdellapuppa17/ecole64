<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController {

    #[Route('/')]
    public function accueil() : Response {
        return NEW Response('<h1>Page d\'accueil</h1>');
    }

}