<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('marque', TextType::class, [
                'label' => ''
            ])
            ->add('modele', TextType::class, [
                'label' => 'Modèle'
            ])
            ->add('km', IntegerType::class, [
                'label' => 'Kilométrage'
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'fullname',
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('envoyer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
