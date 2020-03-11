<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Beat;
use App\Form\BeatType;
use App\Form\RegistrationFormType;
use App\Repository\BeatRepository;
use App\Security\AdminLoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AdminLoginAuthenticator $authenticator): Response
    {
        $user = new Admin();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('info', 'Votre compte administrateur a bien été créé !');

//            return $guardHandler->authenticateUserAndHandleSuccess(
//                $user,
//                $request,
//                $authenticator,
//                'main' // firewall name in security.yaml
//            );

            return $this->redirectToRoute('admin_login');
        }

        return $this->render('admin/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_dashboard');
        }

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(BeatRepository $beatRepository)
    {
        $beat = $beatRepository->findAll();
        return $this->render('admin/dashboard.html.twig', [
            'beat' => $beat,
        ]);
    }

    /**
     * @Route("/add_beat", name="add_beat")
     */
    public function addBeat(Request $request)
    {
        $beat = new Beat();
        $form = $this->createForm(BeatType::class, $beat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $beat = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($beat);
            $entityManager->flush();

            $this->addFlash('info', 'Le Beat a bien été ajouter !');

            return $this->redirectToRoute('admin_dashboard');

        }

        return $this->render('admin/add_beat.html.twig', [
            'addBeatForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
