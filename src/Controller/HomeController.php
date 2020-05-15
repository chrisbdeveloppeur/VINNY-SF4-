<?php

namespace App\Controller;

use App\Entity\FiltresSelected;
use App\Entity\Message;
use App\Form\FiltresType;
use App\Form\MessageType;
use App\Notif\NotifMessage;
use App\Repository\BeatRepository;
use App\Repository\DiapoRepository;
use App\Repository\FiltreRepository;
use App\Repository\LicenceRepository;
use App\Repository\SectionVideoRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(BeatRepository $beatRepository, LicenceRepository $licenceRepository, FiltreRepository $filtreRepository)
    {
        $beat = $beatRepository->findAll();
        $licence = $licenceRepository->findAll();
        $filtre = $filtreRepository->findAll();

        return $this->render('beats/beats.html.twig', [
            'beat' => $beat,
            'licence' => $licence,
            'filtre' => $filtre,
        ]);

    }

    /**
     * @Route("/about", name="about")
     */
    public function about(DiapoRepository $diapoRepository)
    {
        $diapo = $diapoRepository->findAll();
        $nombre = 1;
        $active = 'active';
        return $this->render('about/about.html.twig', [
            'diapo' => $diapo,
            'nombre' => $nombre,
            'active' => $active,
        ]);
    }

    /**
     * @Route("/beat", name="beats")
     */
    public function beats(BeatRepository $beatRepository, LicenceRepository $licenceRepository, FiltreRepository $filtreRepository)
    {
        $beat = $beatRepository->findAll();
        $licence = $licenceRepository->findAll();
        $filtre = $filtreRepository->findAll();

        return $this->render('beats/beats.html.twig', [
            'beat' => $beat,
            'licence' => $licence,
            'filtre' => $filtre,
        ]);

    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos(SectionVideoRepository $sectionVideoRepository, VideoRepository $videoRepository)
    {
        $section = $sectionVideoRepository->findAll();
        $video = $videoRepository->findAll();
//        $video = $videoRepository->findBySection($section);

        return $this->render('videos/videos.html.twig', [
            'section' => $section,
            'video' => $video
        ]);
    }

    /**
     * @Route("/licenses", name="licenses")
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

            $this->addFlash('success', 'Your email has been sent');

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cookies", name="cookies")
     */
    public function cookies()
    {
        return $this->render('includes/cookies.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="mentions-legales")
     */
    public function mentionsLegales()
    {
        return $this->render('mentions_legales/mentions_legales.html.twig');
    }

    /**
     * @Route("/politique-confidentialite", name="politique-confidentialite")
     */
    public function politiqueConfidentialite()
    {
        return $this->render('politique_confidentialite/politique_confidentialite.html.twig');
    }


}
