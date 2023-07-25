<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
                'class' => User::class,
                'choice_label' => 'fullname',
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image,
                    new File(maxSize: '5M')
                ]
            ])
            ->add('envoyer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
