<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false,
                'required' => true,
                'constraints' => [new NotBlank()],
                'attr' => ['autocomplete' => 'current-password', 'class' => 'form-control']
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'mapped' => false,
                'required' => true,
                'constraints' => [new NotBlank(), new Length(['min' => 6])],
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control']
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'mapped' => false,
                'required' => true,
                'constraints' => [new NotBlank()],
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
