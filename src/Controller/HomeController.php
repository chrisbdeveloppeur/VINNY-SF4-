<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('about/about.html.twig', [

        ]);
    }

    /**
     * @Route("/beats", name="beats")
     */
    public function beats()
    {
        return $this->render('beats/beats.html.twig', [

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
    public function licences()
    {
        return $this->render('licences/licences.html.twig', [

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact/contact.html.twig', [

        ]);
    }
}
