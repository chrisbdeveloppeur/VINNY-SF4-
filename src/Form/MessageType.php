<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
                array('label' => false,
                    'required' => false,
                )
            )

            ->add('prenom', TextType::class,
                array('label' => false,
                    'required' => false,
                )
            )

            ->add('email', EmailType::class, [
                'label' => false,
                'error_bubbling' => true,
                'attr' => ['class' => 'input'],
                'constraints' => [
                    new NotBlank(['message' => 'Please fill this field']),
                    new Email(['message' => 'Please enter a valid email address. Example: mymail@gmail.com']),
                ]
            ])

            ->add('objet', TextType::class,
                array('label' => false,
                    'required' => false,
                )
            )

            ->add('message', TextareaType::class,
                array('label' => false,
                    'constraints' => [
                    new NotBlank(['message' => 'Please fill this field']),
                    new Email(['message' => 'Please enter a valid email address. Example: mymail@gmail.com']),
                    ]
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
