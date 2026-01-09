<?php

namespace App\Form;

use App\Entity\Maillot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormulaireMaillot extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du maillot',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Maillot Real Madrid 2024']
            ])
            ->add('equipe', TextType::class, [
                'label' => 'Équipe',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Real Madrid']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Décrivez le maillot en détail']
            ])
            ->add('taille', ChoiceType::class, [
                'label' => 'Taille',
                'choices' => [
                    'XS' => 'XS',
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'XXL' => 'XXL',
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix (€)',
                'attr' => ['class' => 'form-control', 'step' => '0.01']
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Quantité en stock',
                'attr' => ['class' => 'form-control']
            ])
            ->add('envoyer', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary btn-lg w-100']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maillot::class,
        ]);
    }
}
