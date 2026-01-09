<?php

namespace App\Controller;

use App\Entity\Maillot;
use App\Form\FormulaireMaillot;
use App\Repository\MaillotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/maillots')]
class MaillotsController extends AbstractController
{
    #[Route('', name: 'app_maillots')]
    public function liste(MaillotRepository $repo): Response
    {
        $maillots = $repo->findBy([], ['dateAjout' => 'DESC']);
        return $this->render('maillots/liste.html.twig', ['maillots' => $maillots]);
    }


    #[Route('/{id}/modifier', name: 'app_maillot_modifier')]
    public function modifier(Maillot $maillot, Request $requete, EntityManagerInterface $em): Response
    {
        $formulaire = $this->createForm(FormulaireMaillot::class, $maillot);
        $formulaire->handleRequest($requete);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $em->flush();

            $this->addFlash('succes', 'Maillot modifié avec succès !');
            return $this->redirectToRoute('app_maillots');
        }

        return $this->render('maillots/modifier.html.twig', [
            'maillot' => $maillot,
            'formulaire' => $formulaire->createView()
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_maillot_supprimer')]
    public function supprimer(Maillot $maillot, EntityManagerInterface $em): Response
    {
        $em->remove($maillot);
        $em->flush();

        $this->addFlash('succes', 'Maillot supprimé avec succès !');
        return $this->redirectToRoute('app_maillots');
    }
}
