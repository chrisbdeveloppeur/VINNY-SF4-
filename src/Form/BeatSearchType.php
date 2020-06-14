<?php

namespace App\Form;

use App\Entity\BeatSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeatSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beatBpmMin', NumberType::class,[
                'required' => false,
                'label' => false,
                'error_bubbling' => true,
                'invalid_message' => 'Please enter a valid BPM number Min',
                'attr' => [
                    'class' => 'input pagination-control-touch',
                    'title' => 'Beat per minutes Min',
                    'placeholder' => 'Min',
                    'style' => 'z-index:0',
                    'min' => 0,
                    'max' => 1000
                ]
            ])

            ->add('beatBpmMax', NumberType::class,[
                'required' => false,
                'label' => false,
                'error_bubbling' => true,
                'invalid_message' => 'Please enter a valid PBM number Max',
                'attr' => [
                    'class' => 'input pagination-control-touch',
                    'title' => 'Beat per minutes Max',
                    'placeholder' => 'Max',
                    'style' => 'z-index:0',
                    'min' => 0,
                    'max' => 1000
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BeatSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function  getBlockPrefix()
    {
        return '';
    }

}
