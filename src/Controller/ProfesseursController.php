<?php

// src/Controller/ProfesseursController.php

namespace App\Controller;

use App\Repository\ProfesseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Services\UsersServices;

class ProfesseursController extends AbstractController {
    #[Route('/professeurs', name: 'app_professeurs')]
    public function index(
        ProfesseursRepository $professeursRepository, 
        LoggerInterface $log,
        UsersServices $user ): Response {

        dump( $user->getInitiales('Dupont', 'Jean'));
        dd($user->getAge(new \DateTimeImmutable('1980-01-01')));

        $professeurs = $professeursRepository->findAll();
        $log->info('Liste de professeurs récupérés !');
        
        return $this->render(
            'professeurs/index.html.twig', [
                'professeurs' => $professeurs,
            ]
        );
    }
}