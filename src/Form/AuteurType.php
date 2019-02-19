<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'Nom : ',
                'required'=> false,
                'attr' => ['placeholder' => 'Entrez un Nom']
            ])
            ->add('prenom', TextType::class, [
                'label'=>'Prénom : ',
                'required' => false
            ])
            ->add('biographie', TextareaType::class, [
                'label'=>'Biographie : ',
                'required'=> false,
                'attr' => ['placeholder' => 'Biographie']
            ])
            ->add('date', DateType::class, [
                'label'=> 'Date de Naissance',
                'required'=> false,
                'years' => range(500, date('Y'))
            ])
            ->add('mort', DateType::class, [
                'label'=> 'Date de Naissance',
                'required'=> false,
                'years' => range(500, date('Y'))
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
