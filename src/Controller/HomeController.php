<?php

namespace App\Controller;

use App\Entity\BeatSearch;
use App\Entity\FiltresSelected;
use App\Entity\Message;
use App\Form\BeatSearchType;
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
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(BeatRepository $beatRepository, LicenceRepository $licenceRepository, FiltreRepository $filtreRepository, PaginatorInterface $paginator, Request $request)
    {
        $search = new BeatSearch();
        $form = $this->createForm(BeatSearchType::class, $search);
        $form->handleRequest($request);
        $beatBpMax = $form->get('beatBpmMax')->getData();
        $beatBpMin = $form->get('beatBpmMin')->getData();

        if ($form->isSubmitted() and  ($beatBpMin != null and $beatBpMax != null) and ($beatBpMin <= $beatBpMax))
        {
                $originalBeat = $paginator->paginate(
                    $beatRepository->findByBpm($beatBpMin, $beatBpMax),
                    $request->query->getInt('page', 1),
                    10
                );
                $beatstars = $beatRepository->findByBpm($beatBpMin, $beatBpMax);
        }elseif ($form->isSubmitted() and  ($beatBpMin != null and $beatBpMax == null)){
            $originalBeat = $paginator->paginate(
                $beatRepository->findByBpmMin($beatBpMin),
                $request->query->getInt('page', 1),
                10
            );
            $beatstars = $beatRepository->findByBpmMin($beatBpMin);
        }elseif ($form->isSubmitted() and  ($beatBpMin == null and $beatBpMax != null)){
            $originalBeat = $paginator->paginate(
                $beatRepository->findByBpmMax($beatBpMax),
                $request->query->getInt('page', 1),
                10
            );
            $beatstars = $beatRepository->findByBpmMax($beatBpMax);
        }
        elseif ($form->isSubmitted() and  ($beatBpMin > $beatBpMax)){
            $this->addFlash('danger', 'Interval error');
            $originalBeat = $paginator->paginate(
                $beatRepository->findAll(),
                $request->query->getInt('page', 1),
                10
            );
            $beatstars = $beatRepository->findByIframe(false);
        }
        else{
            $originalBeat = $paginator->paginate(
                $beatRepository->findAll(),
                $request->query->getInt('page', 1),
                10
            );
            $beatstars = $beatRepository->findByIframe(false);
        }



        $licence = $licenceRepository->findAll();
        $filtre = $filtreRepository->findAll();

        return $this->render('beats/beats.html.twig', [
            'beat' => $originalBeat,
            'beatstars' => $beatstars,
            'licence' => $licence,
            'filtre' => $filtre,
            'form' => $form->createView()
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

//    /**
//     * @Route("/beat", name="beats")
//     */
//    public function beats(BeatRepository $beatRepository, LicenceRepository $licenceRepository, FiltreRepository $filtreRepository, PaginatorInterface $paginator, Request $request)
//    {
//
////        $beatstars = $beatRepository->findByIframe(!null);
////        $originalBeat = $paginator->paginate(
////            $beatRepository->findByIframe(null),
////            $request->query->getInt('page', 1),
////            3
////        );
////        $licence = $licenceRepository->findAll();
////        $filtre = $filtreRepository->findAll();
////
////        return $this->render('beats/beats.html.twig', [
////            'beat' => $originalBeat,
////            'beatstars' => $beatstars,
////            'licence' => $licence,
////            'filtre' => $filtre,
////        ]);
//        $originalBeat = $paginator->paginate(
//            $beatRepository->findAll(),
//            $request->query->getInt('page', 1),
//            6
//        );
//        $beatstars = $beatRepository->findByIframe(false);
//        $licence = $licenceRepository->findAll();
//        $filtre = $filtreRepository->findAll();
//
//        return $this->render('beats/beats.html.twig', [
//            'beat' => $originalBeat,
//            'beatstars' => $beatstars,
//            'licence' => $licence,
//            'filtre' => $filtre,
//        ]);
//
//    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos(SectionVideoRepository $sectionVideoRepository, VideoRepository $videoRepository, PaginatorInterface $paginator, Request $request)
    {
        $section = $sectionVideoRepository->findAll();
//        $video = $videoRepository->findAll();
        $video = $paginator->paginate(
            $videoRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

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
