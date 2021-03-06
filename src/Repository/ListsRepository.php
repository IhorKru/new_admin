<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * LinksRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ListsRepository extends EntityRepository
{
    public function selectLatestList () {
        $limit = 1;
        return $this->getEntityManager()
            ->createQuery('SELECT l FROM App:Lists l ORDER BY l.id DESC')
            ->setMaxResults($limit)
            ->getResult();
    }
}