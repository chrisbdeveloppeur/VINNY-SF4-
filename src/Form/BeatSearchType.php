<?php

namespace App\Form;

use App\Entity\BeatSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeatSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beatBpmMax', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'input pagination-control-touch',
                    'title' => 'BPM (max)',
                    'placeholder' => 'BPM (max)'
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
