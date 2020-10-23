<?php

namespace App\Form;

use App\Entity\Message;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
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
                    'error_bubbling' => true,
                )
            )

            ->add('prenom', TextType::class,
                array('label' => false,
                    'required' => false,
                    'error_bubbling' => true,
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
                    'error_bubbling' => true,
                )
            )

            ->add('message', TextareaType::class,
                array('label' => false,
                    'error_bubbling' => true,
                    'constraints' => [
                        new NotBlank(['message' => 'Please fill this field']),
                    ]
                )
            )

            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptcha',
                'label' => false,
                'error_bubbling' => true,
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
