<?php

// src/Controller/ProfesseurController.php

namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Services\UsersServices;

class ProfesseurController extends AbstractController {
    #[Route('/professeur', name: 'app_professeur')]
    public function index(
        ProfesseurRepository $professeurRepository, 
        LoggerInterface $log,
        UsersServices $user ): Response {

        dump( $user->getInitiales('Dupont', 'Jean'));
        dd($user->getAge(new \DateTimeImmutable('1980-01-01')));

        $professeurs = $professeurRepository->findAll();
        $log->info('Liste de professeurs récupérés !');
        
        return $this->render(
            'professeurs/index.html.twig', [
                'professeurs' => $professeurs,
            ]
        );
    }
}