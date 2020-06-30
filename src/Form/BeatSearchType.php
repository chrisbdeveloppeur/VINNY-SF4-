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
                    'title' => 'Number between 0 and 500',
                    'placeholder' => 'Min',
                    'style' => 'z-index:0',
                    'pattern' => '([0-9]|[1-8][0-9]|9[0-9]|[1-4][0-9]{2}|500)'
                ]
            ])

            ->add('beatBpmMax', NumberType::class,[
                'required' => false,
                'label' => false,
                'error_bubbling' => true,
                'invalid_message' => 'Please enter a valid PBM number Max',
                'attr' => [
                    'class' => 'input pagination-control-touch',
                    'title' => 'Number between 0 and 500',
                    'placeholder' => 'Max',
                    'style' => 'z-index:0',
                    'pattern' => '([0-9]|[1-8][0-9]|9[0-9]|[1-4][0-9]{2}|500)'
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
