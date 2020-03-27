<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Notif\NotifMessage;
use App\Repository\BeatRepository;
use App\Repository\LicenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('index.html.twig', [

        ]);
    }

    /**
     * @Route("/adm", name="adm")
     */

    public function admin()
    {
        return $this->render('admin/home.html.twig', [

        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('about/about.html.twig', [

        ]);
    }

    /**
     * @Route("/beat", name="beats")
     */
    public function beats(BeatRepository $beatRepository, LicenceRepository $licenceRepository)
    {
        $beat = $beatRepository->findAll();
        $licence = $licenceRepository->findAll();

        return $this->render('beats/beats.html.twig', [
            'beat' => $beat,
            'licence' => $licence,
        ]);

    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        return $this->render('videos/videos.html.twig', [

        ]);
    }

    /**
     * @Route("/licences", name="licences")
     */
    public function licences(LicenceRepository $licenceRepository)
    {
        $licence = $licenceRepository->findAll();

        return $this->render('licences/licences.html.twig', [
            'licence' => $licence
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, EntityManagerInterface $entityManager, NotifMessage $notifMessage)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var Message $message
             */
            $message = $form->getData();

            $entityManager->persist($message);
            $entityManager->flush();

            $notifMessage->sendMessage($message);

//            dd($message);

            $this->addFlash('success', 'Votre mail à bien été envoyé');


            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }

}
