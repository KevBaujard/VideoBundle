<?php

namespace VideoBundle\Entity;

use Doctrine\DBAL\Types;
use Doctrine\ORM\EntityRepository;

class VideoRepository extends EntityRepository
{

    /**
     * This method return video rows from database between 2 dates.
     *
     * @param $from
     * @param $to
     * @return array
     */
    public function findVideoBetweenDate($from, $to)
    {
        $qb = $this->createQueryBuilder('v');
        $query = $qb
            ->where($qb->expr()->between('v.date', ':from', ':to'))
            ->setParameter('from', $from, Types\Type::DATETIME)
            ->setParameter('to', $to, Types\Type::DATETIME)
            ->getQuery();

        return $query->getResult();
    }

    public function findVideoByRealisator($realisator)
    {
        $qb = $this->createQueryBuilder('v');
        $query = $qb
            ->where('v.realisator LIKE :realisator')
            ->setParameter('realisator', '%'.$realisator.'%')
            ->getQuery();

        return $query->getResult();
    }
}
