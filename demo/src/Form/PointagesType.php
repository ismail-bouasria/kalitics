<?php

namespace App\Form;

use App\Entity\Chantiers;
use App\Entity\Pointages;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('duree')
            ->add('utilisateur',EntityType::class,[
                'class'=> Utilisateurs::class,
                'choice_label' => 'matricule'
                ])
            ->add('chantier', EntityType::class,[
                'class'=> Chantiers::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointages::class,
        ]);
    }
}
