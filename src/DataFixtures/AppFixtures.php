<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Beat;
use App\Entity\Diapo;
use App\Entity\Filtre;
use App\Entity\Licence;
use App\Entity\SectionVideo;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('christian.boungou@gmail.com');
        $password = $this->encoder->encodePassword($admin, '121090cb.K4gur0');
        $admin->setPassword($password);
        $manager->persist($admin);


        for ($i=0 ; $i < 3 ; $i++){
            $filtre = new Filtre();
            $filtre->setGenre($faker->words(1, true));
            $manager->persist($filtre);

                for ($j=0 ; $j<4 ; $j++){
                    $beat = new Beat();
                    $beat->setTitre($faker->words(1,true));
                    $beat->setGenre($filtre);
                    $beat->setBpm($faker->numberBetween(5,20) . "0");
                    $manager->persist($beat);
                }

                $beat = new Beat();
                $beat->setTitre($faker->words(1,true));
                $beat->setGenre($filtre);
                $beat->setBpm($faker->numberBetween(5,20) . "0");
                $beat->setIframe('//www.beatstars.com/embed/track/?id=4141341');
                $manager->persist($beat);

        }

        for ($k=0 ; $k<2 ; $k++){
            $section = new SectionVideo();
            $section->setTitre($faker->words(2,true));
            $section->setCouleur($faker->randomElement(array('warning','danger','primary')));
            $manager->persist($section);

            for ($l=0 ; $l<15 ; $l++){
                $video = new Video();
                $video->setTitre($faker->words(3,true));
                $video->setInfo($faker->words(4,true));
                $video->setSection($section);
                $video->setLink('4YszR1SHTP4');
                $manager->persist($video);
            }
        }

        for ($m=0 ; $m<5 ; $m++){
            $diapo = new Diapo();
            $diapo->setTitre($faker->words(3,true));
            $diapo->setText($faker->sentence(15, true));
            $manager->persist($diapo);
        }

        for ($n=0 ; $n<4 ; $n++){
            $licence = new Licence();
            $licence->setTitre($faker->words(3,true));
            $licence->setColor($faker->randomElement(array('warning','danger','primary')));
            $licence->setDollar($faker->numberBetween(15,500));
            $licence->setInfo1($faker->sentence(6, true));
            $licence->setInfo2($faker->sentence(6, true));
            $licence->setInfo3($faker->sentence(6, true));
            $licence->setInfo4($faker->sentence(6, true));
            $licence->setInfo5($faker->sentence(6, true));
            $licence->setInfo6($faker->sentence(6, true));
            $manager->persist($licence);
        }







        $manager->flush();
    }
}
