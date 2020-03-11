<?php

namespace App\Form;

use App\Entity\Beat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beatName', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
            ])
            ->add('titre', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
            ])
            ->add('artiste', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
            ])
            ->add('album', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
            ])
            ->add('genre', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Beat::class,
        ]);
    }
}
