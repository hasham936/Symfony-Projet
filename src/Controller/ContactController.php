<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getUser()) {
                $contact->setAuteur($this->getUser());
            }

            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', 'Merci ! Votre message a été envoyé. Nous vous répondrons dans les plus brefs délais.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', ['form' => $form->createView()]);
    }
}