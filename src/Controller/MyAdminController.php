<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\LostPasswordType;
use App\Form\RegistrationFormType;
use App\Form\ResetPasswordType;
use App\Notif\NotifMessage;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MyAdminController extends AbstractController
{
    /**
     * Demander un lien de réinitialisation du mot de passe
     * @Route("/lost-password", name="lost_password")
     *
     * @param Request         $request          Pour le formulaire
     * @param AdminRepository  $adminRepository   Pour rechercher l'utilisateur
     */
    public function lostPassword(Request $request, AdminRepository $adminRepository, NotifMessage $notifMessage)
    {

        $lostPasswordForm = $this->createForm(LostPasswordType::class);
        $lostPasswordForm->handleRequest($request);

        if ($lostPasswordForm->isSubmitted() && $lostPasswordForm->isValid()) {
            $admin = $lostPasswordForm->getData()['email'];

            $admin = $adminRepository->findOneBy(['email' => $admin]);

            if ($admin === null) {
                $this->addFlash('danger', 'Cet adresse Email n\'est pas enregistrée');


            } else {


                $notifMessage->lostPassword($admin);

                $this->addFlash('info', 'Un email de réinitialisation de mot de passe vous a été envoyé.');
                return $this->redirectToRoute('admin_login');

            }
        }

        return $this->render('admin/lost_password.html.twig', [
            'lost_password_form' => $lostPasswordForm->createView()
        ]);
    }






    /**
     * Réinitialiser le mot de passe
     * @Route("/reset-password/{id}/{token}", name="reset_password")
     *
     * @param Admin                          $admin            L'utilisateur qui souhaite réinitialiser son mot de passe
     * @param                               $token           Le jeton à vérifier pour la réinitialisation
     * @param Request                       $request         Pour le formulaire de réinitialisation
     * @param UserPasswordEncoderInterface $passwordEncoder Pour hasher le nouveau mot de passe
     */
    public function resetPassword(
        Admin $admin,
        $token,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        // Le jeton ne correspond pas à celui de l'utilisateur
        if ($admin->getSecurityToken() !== $token) {
            $this->addFlash('danger', 'Le jeton de sécurité est invalide.');
            return $this->redirectToRoute('admin_login');
        }

        // Création du formulaire de réinitialisation du mot de passe
        $resetForm = $this->createForm(ResetPasswordType::class);
        $resetForm->handleRequest($request);

        if ($resetForm->isSubmitted() && $resetForm->isValid()) {
            $password = $resetForm->get('plainPassword')->getData();

            $oldPassword = $passwordEncoder->isPasswordValid($admin, $password);

//            dump($oldPassword);

            if($oldPassword === false){
                $admin->setPassword($passwordEncoder->encodePassword($admin, $password));
                $admin->renewToken();

                // Mise à jour de l'entité en BDD

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($admin);
                $entityManager->flush();

                // Ajout d'un message flash
                $this->addFlash('success', 'Votre mot de passe a bien été modifié.');
                return $this->redirectToRoute('admin_login');
            }else{
                $this->addFlash('danger', 'Votre mot de passe doit être différent de l\'ancien');
            }

        }

        return $this->render('admin/recovery_password_form.html.twig', [
            'reset_form' => $resetForm->createView()
        ]);
    }





}
