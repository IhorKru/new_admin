<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CampaignsRepository extends EntityRepository
{
    public function campaignsPerResource(){
        return $this->getEntityManager()
            ->createQuery('SELECT a.appName, count(c.id) AS campaigns 
                                FROM App:SendyApps a JOIN a.appdetails c 
                                WHERE c.sent = :empty
                                GROUP BY a.appName')
            ->setParameter('empty', '')
            ->getArrayResult();
    }
    public function emailsPerResource() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            -> select('a.appName, count(s.id) as countsubscr')
            -> from('App\Entity\SendyApps', 'a')
            -> join('App\Entity\Campaigns', 'c', \Doctrine\ORM\Query\Expr\Join::WITH, 'a.id = c.app')
            -> join('App\Entity\Lists', 'l', \Doctrine\ORM\Query\Expr\Join::WITH, 'c.lists = l.id')
            -> join('App\Entity\Subscribers', 's', \Doctrine\ORM\Query\Expr\Join::WITH, 's.list = l.id')
            -> where('c.sent = :empty')
            -> setParameter('empty', '')
            -> groupBy('a.appName')
        ;
        $resourceemails = $qb ->getQuery() ->getArrayResult();
        return $resourceemails;
    }
    public function campSearch($categoryid, $curbatch) {
        return $this->getEntityManager()
            ->createQuery('SELECT c 
                                FROM App:Campaigns c
                                WHERE c.sent = :empty
                                      AND c.category_id = :categoryid
                                      AND c.batch_id = :curbatch')
            ->setParameter('empty', '')
            ->setParameter('categoryid', $categoryid)
            ->setParameter('curbatch', $curbatch)
            ->setMaxResults('1')
            ->getResult();
    }
}
