<?php

namespace App\Controller;

use App\Repository\BeatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

//    /**
//     * @Route("/register", name="register")
//     */
//    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AdminLoginAuthenticator $authenticator): Response
//    {
//        $user = new Admin();
//        $form = $this->createForm(RegistrationFormType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // encode the plain password
//            $user->setPassword(
//                $passwordEncoder->encodePassword(
//                    $user,
//                    $form->get('plainPassword')->getData()
//                )
//            );
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            $this->addFlash('info', 'Votre compte administrateur a bien été créé !');
//
//            return $this->redirectToRoute('admin_login');
//        }
//
//        return $this->render('admin/register.html.twig', [
//            'registrationForm' => $form->createView(),
//        ]);
//    }



//    /**
//     * @Route("/add_beat", name="add_beat")
//     */
//    public function addBeat(Request $request)
//    {
//        $beat = new Beat();
//        $form = $this->createForm(BeatType::class, $beat);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $beat = $form->getData();
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($beat);
//            $entityManager->flush();
//
//            $this->addFlash('info', 'Le Beat a bien été ajouter !');
//
//            return $this->redirectToRoute('admin_dashboard');
//
//        }
//
//        return $this->render('admin/add_beat.html.twig', [
//            'addBeatForm' => $form->createView(),
//        ]);
//    }

//    /**
//     * @Route("/edit_beat_{id}", name="edit_beat")
//     * @IsGranted("ROLE_USER")
//     */
//    public function editAnnonce(Request $request, BeatRepository $beatRepository, $id){
//
//
//        $beat = $beatRepository->find($id);
//        $form = $this->createForm(BeatType::class, $beat);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
////            if($beat->getBeatFile() instanceof  UploadedFile){
////                $cacheManager->remove($helper->asset($beat, 'beatFile'));
////            }
//
//            // Formulaire lié à une classe entité: getData() retourne l'entité
//            $beat = $form->getData();
//
//            // Mise à jour de l'entité en BDD
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($beat);
//            $entityManager->flush();
//
//
//            // Ajout d'un message flash
//            $this->addFlash('success', 'Le Beat a été modifié');
//
//
//
//        }else if ($form->isSubmitted()) {
//            $this->addFlash('danger', 'Echec de modification.');
//        }
//
//        return $this->render('admin/edit_beat.html.twig', [
//            'editBeatForm' => $form->createView(),
//            'beat' => $beat,
//        ]);
//    }


}
