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

    public function statusGraph() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('DATE_FORMAT(em.datecreated, \'%Y-%V\') AS weeknum,
                      SUM(case when em.nbstatus = 0 then 1 else 0 end) as CountValid,
                      SUM(case when em.nbstatus = 1 then 1 else 0 end) as Invalid,
                      SUM(case when em.nbstatus = 2 then 1 else 0 end) as Disposable,
                      SUM(case when em.nbstatus = 3 then 1 else 0 end) as Catchall,
                      SUM(case when em.nbstatus = 4 then 1 else 0 end) as Unknown')
            -> from('App:EmailStatus', 'em')
            -> groupBy('weeknum')
            -> orderBy('weeknum', 'ASC')
            -> setMaxResults(7);
        $result = $qb ->getQuery() ->getArrayResult();
        return $result;
    }
}