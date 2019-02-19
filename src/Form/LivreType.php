<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        for($i=500; $i<2100; $i++){
            $years[] = $i;
        }
        $builder
            ->add('titre', TextType::class, [
                'label'=>'Titre : ',
                'required'=>false,
                'attr'=> ['placeholder'=>'Entrez un nom']
            ])
            ->add('resume', TextareaType::class, [
                'label'=>'Résumé : ',
                'required'=>false,
                'attr'=> ['placeholder'=>'Entrez le résumé']
            ])
            ->add('parution', DateType::class, [
                'label'=>'Date de parution : ',
                'required'=>false,
                'years'=>$years,
                'attr'=> ['placeholder'=>'Entrez une date']
            ])
            ->add('auteur', EntityType::class, [
                'label'=>'Auteur : ',
                'required' => false,
                'class' => Auteur::class,
                'choice_label'=>function(Auteur $auteur){
                    return $auteur->getPrenom()." ".$auteur->getNom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
