<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control']
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control']
            ])
            ->add('bio', TextareaType::class, [
                'label' => 'Biographie',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Parlez-nous de vous...']
            ])
            ->add('profileImage', FileType::class, [
                'label' => 'Photo de profil',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => User::class]);
    }
}
