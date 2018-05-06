<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class EmailStatusRepository extends EntityRepository
{
    public function findMaxRow() {
        return $this->getEntityManager()
            ->createQuery('SELECT max(e.id) FROM App:EmailStatus e')
            ->getSingleScalarResult();
    }
}