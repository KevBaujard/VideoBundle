<?php

namespace VideoBundle\Service;

use Doctrine\ORM\EntityManager;
use VideoBundle\Entity\Video;

class VideoService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository('VideoBundle:Video');
    }

    public function save(Video $video)
    {
        $this->em->persist($video);
        $this->em->flush();
    }

    public function getVideo($params = [])
    {
        $videos = [];

        if ('' !== $params['realisator']) {
            $videos['videos'] = $this->getRepository()->findVideoByRealisator($params['realisator']);
        } elseif ('' !== $params['from'] && '' !== $params['to']) {
            $videos['videos'] = $this->getRepository()->findVideoBetweenDate(
                new \DateTime($params['from']),
                new \DateTime($params['to'])
            );
        } else {
            $videos['videos'] = $this->getRepository()->findAll();
        }

        $videos['count'] = count($videos['videos']);

        return $videos;
    }
}
