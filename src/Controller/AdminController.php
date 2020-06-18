<?php

namespace App\Controller;


use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/adm", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('easyadmin');
        }

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }



    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    //    protected function persistUserEntity(Admin $user)
//    {
//        $encodedPassword = $this->encodePassword($user, $user->getPassword());
//        $user->setPassword($encodedPassword);
//
//        parent::persistEntity($user);
//    }
//
//    protected function updateUserEntity(Admin $user)
//    {
//        $encodedPassword = $this->encodePassword($user, $user->getPassword());
//        dd($encodedPassword);
//        $user->setPassword($encodedPassword);
//
//        parent::updateEntity($user);
//    }
//
//    private function encodePassword($user, $password)
//    {
//        $passwordEncoderFactory = new EncoderFactory([
//            Admin::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
//        ]);
//
//        $encoder = $passwordEncoderFactory->getEncoder($user);
//
//        return $encoder->encodePassword($password, $user->getSalt());
//    }

}
