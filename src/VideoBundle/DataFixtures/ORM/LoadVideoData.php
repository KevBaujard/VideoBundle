<?php

namespace VideoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use VideoBundle\Entity\Video;

class LoadVideoData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $video = new Video();
        $video->setRealisator('David Simon')
            ->setTitle('The wire')
            ->setDate(new \DateTime('20150101'));

        $manager->persist($video);
        $manager->flush();
    }
}
