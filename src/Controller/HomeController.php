<?php

namespace App\Controller;

use App\Repository\MaillotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MaillotRepository $repo): Response
    {
        $maillots = $repo->findBy([], ['dateAjout' => 'DESC'], 6);
        return $this->render('home/index.html.twig', ['maillots' => $maillots]);
    }

    #[Route('/mentions-legales', name: 'mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('pages/mentions_legales.html.twig');
    }

    #[Route('/cgu', name: 'cgu')]
    public function cgu(): Response
    {
        return $this->render('pages/cgu.html.twig');
    }

    #[Route('/politique-confidentialite', name: 'politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('pages/politique_confidentialite.html.twig');
    }

    #[Route('/qui-sommes-nous', name: 'qui_sommes_nous')]
    public function quiSommesNous(): Response
    {
        return $this->render('pages/qui_sommes_nous.html.twig');
    }
}