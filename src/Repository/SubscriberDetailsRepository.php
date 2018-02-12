<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class SubscriberDetailsRepository extends EntityRepository
{
    # which are:
    # subscribers that did not opt out
    # subscribers that did not receive email from Mediaff for the last 360 days
    # subscribers that never received email from mediaff
    public function campEligibilityCalc($numcampaigns) {
        $conn = $this->getEntityManager()->getConnection();
        $conn->getConfiguration()->setSQLLogger(null);
        //$em = $this ->getDoctrine() ->getManager();
        ####selecting users that did not opt out from mailing resource
        $qb0 = $this->getEntityManager()->createQueryBuilder();
        $qb0
            -> select('opto')
            -> from('App\Entity\SubscriberOptOutDetails', 'opto')
            -> where('s.id = opto.user')
        ;
        ####selecting users that did not get email from us for 360 days + did not ever bounce hard + did not ever complaint
        $qb1 = $this->getEntityManager()->createQueryBuilder();
        $qb1
            ->select('send')
            ->from('App\Entity\Subscribers', 'send')
            ->where('DATE_FORMAT(now(), \'%e-%b-%Y\') - DATE_FORMAT(FROM_UNIXTIME(send.last_campaign), \'%e-%b-%Y\') <=360')
            ->andwhere('send.bounced <> 1')
            ->andwhere('send.complaint <> 1')
            ->andwhere('s.emailaddress = send.emailaddress');
        ####selecting users that did not end up in ADK campaign error list
        $qb2 = $this->getEntityManager()->createQueryBuilder();
        $qb2
            -> select('adkerr')
            -> from('App\Entity\SubscriberADKCampErrors', 'adkerr')
            -> andwhere('s.emailaddress = adkerr.recipient')
        ;
        ####primary query to select users for future campaigns
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            -> select('s')
            -> from('App\Entity\SubscriberDetails', 's')
            -> where($qb->expr()->not($qb->expr()->exists($qb1->getDQL())))
            //-> andWhere($qb->expr()->not($qb->expr()->exists($qb0->getDQL())))
            //-> andWhere($qb->expr()->not($qb->expr()->exists($qb2->getDQL())))
            -> setMaxResults($numcampaigns)
        ;
        $query = $qb->getQuery();
        return $query ->getResult();
    }

    public function emailClean($numemails) {
        $conn = $this->getEntityManager()->getConnection();
        $conn->getConfiguration()->setSQLLogger(null);
        //$em = $this ->getDoctrine() ->getManager();
        //selecting only emails that were not checked within last 24 hours
        $qb0 = $this->getEntityManager()->createQueryBuilder();
        $qb0
            -> select('check')
            -> from('App\Entity\EmailStatus', 'check')
            -> where('s.id = check.userid')
            -> andWhere('DATE_FORMAT(now(), \'%e-%b-%Y\') - DATE_FORMAT(check.datecreated, \'%e-%b-%Y\') <=10')
        ;
        ####primary query to select users for future campaigns
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            -> select('s')
            -> from('App\Entity\SubscriberDetails', 's')
            -> where($qb->expr()->not($qb->expr()->exists($qb0->getDQL())))
            -> setMaxResults($numemails)
        ;
        $query = $qb->getQuery();
        $conn ->close();
        return $query ->getResult();
    }
}
