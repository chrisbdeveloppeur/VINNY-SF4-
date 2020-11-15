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
use Symfony\Contracts\Translation\TranslatorInterface;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(BeatRepository $beatRepository, LicenceRepository $licenceRepository, FiltreRepository $filtreRepository, TranslatorInterface $translator, Request $request)
    {
        $search = new BeatSearch();
        $form = $this->createForm(BeatSearchType::class, $search);
        $form->handleRequest($request);
        $beatBpMax = $form->get('beatBpmMax')->getData();
        $beatBpMin = $form->get('beatBpmMin')->getData();

        if ($form->isSubmitted() and  ($beatBpMin != null and $beatBpMax != null) and ($beatBpMin <= $beatBpMax))
        {
            $originalBeat = $beatRepository->findByBpm($beatBpMin, $beatBpMax);
            $beatstars = $beatRepository->findByBpm($beatBpMin, $beatBpMax);

        }elseif ($form->isSubmitted() and  ($beatBpMin != null and $beatBpMax == null))
        {
            $originalBeat = $beatRepository->findByBpmMin($beatBpMin);
            $beatstars = $beatRepository->findByBpmMin($beatBpMin);

        }elseif ($form->isSubmitted() and  ($beatBpMin == null and $beatBpMax != null))
        {
            $originalBeat = $beatRepository->findByBpmMax($beatBpMax);
            $beatstars = $beatRepository->findByBpmMax($beatBpMax);

        }
        elseif ($form->isSubmitted() and  ($beatBpMin > $beatBpMax))
        {
            $message = $translator->trans('Interval error !');
            $this->addFlash('danger',$message);
            $originalBeat = $beatRepository->sortByDate();
            $beatstars = $beatRepository->findByIframe(false);

        }
        else{
            $originalBeat = $beatRepository->sortByDate();
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
     * @Route("/beat", name="beat")
     */
    public function beat()
    {
        return $this->redirectToRoute('home');
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
     * @Route("/videos", name="videos")
     */
    public function videos(SectionVideoRepository $sectionVideoRepository, VideoRepository $videoRepository, PaginatorInterface $paginator, Request $request)
    {
        $section = $sectionVideoRepository->findAll();
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
    public function contact(Request $request, NotifMessage $notifMessage, TranslatorInterface $translator)
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var Message $message
             */
            $message = $form->getData();

            $notifMessage->sendMessage($message);

            $flashMessage = $translator->trans('Your email has been sent, Thanks !');

            $this->addFlash('success', $flashMessage);

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/disclaimer", name="mentions-legales")
     */
    public function mentionsLegales()
    {
        return $this->render('mentions_legales/page.html.twig');
    }

    /**
     * @Route("/privacy-policy", name="politique-confidentialite")
     */
    public function politiqueConfidentialite()
    {
        return $this->render('politique_confidentialite/page.html.twig');
    }

    /**
     * @Route("/terms-conditions", name="conditions-generales")
     */
    public function conditionsGenerales()
    {
        return $this->render('conditions_generales/page.html.twig');
    }


    /**
     * @Route("/change-locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        // On stock la lanque demandée dans la session
        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);

        // On reviens sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }


}
