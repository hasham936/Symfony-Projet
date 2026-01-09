<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('', name: 'app_profile')]
    public function show(): Response
    {
        $user = $this->getUser();
        return $this->render('profile/show.html.twig', ['user' => $user]);
    }

    #[Route('/edit', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('profileImage')->getData()) {
                $file = $form->get('profileImage')->getData();
                $fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('kernel.project_dir') . '/public/uploads/profiles', $fileName);
                $user->setProfileImage($fileName);
            }

            $user->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour avec succès !');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/change-password', name: 'app_change_password')]
    public function changePassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('oldPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            if (!$userPasswordHasher->isPasswordValid($user, $oldPassword)) {
                $this->addFlash('error', 'Mot de passe actuel incorrect.');
                return $this->redirectToRoute('app_change_password');
            }

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les nouveaux mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_change_password');
            }

            $user->setPassword($userPasswordHasher->hashPassword($user, $newPassword));
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe a été changé avec succès !');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/change_password.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/delete', name: 'app_profile_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $user = $this->getUser();

            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $em->remove($user);
                $em->flush();

                $this->addFlash('success', 'Votre compte a été supprimé.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('profile/delete.html.twig');
    }
}