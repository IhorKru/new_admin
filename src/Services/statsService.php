<?php

namespace App\Services;

use App\Entity\StatsYearly;
use App\Entity\StatsMonthly;
use App\Entity\StatsWeekly;
use App\Entity\StatsDaily;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DateTime;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Connections;

class statsService extends Controller
{
    //CUSTOM PHP FUNCTIONS USED IN THIS CLASS
    public function checkNull($value)
    {
        if(is_null($value)) {
            $value = '0';
        }
        return $value;
    }

    public function statsServiceAction(Request $request, $slug)
    {
        $em = $this ->getDoctrine() ->getManager();
        $curryear = date("Y");
        $currmonth = date("m");
        $currweek = date("W");
        $currday = date("d");

        if($slug == 'daily') {
            $newDailystats = new StatsDaily();
            $statsentity = $newDailystats;
            $existingstats = $em->getRepository('App:StatsDaily')->findOneBy(['year' => $curryear, 'month' => $currmonth, 'day' => $currday]);
            $slug = 1;
            $where1 = "DATE_FORMAT(s.datecreated, '%e-%b-%Y') = DATE_FORMAT(now(), '%e-%b-%Y')";
            $where2 = "s.id LIKE '%'";
            $where3 = "DATE_FORMAT(un.optoutdate, '%e-%b-%Y') = DATE_FORMAT(now(), '%e-%b-%Y')";
            $where4 = "un.id LIKE '%'";
            $where5 = "DATE_FORMAT(FROM_UNIXTIME(c.sent), '%e-%b-%Y') = DATE_FORMAT(now(), '%e-%b-%Y')";
            $where6 = "c.id LIKE '%'";
            $where7 = "DATE_FORMAT(FROM_UNIXTIME(s.last_campaign), '%e-%b-%Y') = DATE_FORMAT(now(), '%e-%b-%Y')";
            $where8 = "s.id LIKE '%'";
        } elseif ($slug == 'weekly') {
            $newWeeklystats = new StatsWeekly();
            $statsentity = $newWeeklystats;
            $existingstats = $em->getRepository('App:StatsWeekly')->findOneBy(['year' => $curryear, 'week' => $currweek]);
            $slug = 2;
            $where1 = "week(s.datecreated) = week(now())";
            $where2 = "year(s.datecreated) = year(now())";
            $where3 = "week(un.optoutdate) = week(now())";
            $where4 = "year(un.optoutdate) = year(now())";
            $where5 = "week(FROM_UNIXTIME(c.sent)) = week(now())";
            $where6 = "year(FROM_UNIXTIME(c.sent)) = year(now())";
            $where7 = "week(FROM_UNIXTIME(s.last_campaign)) = week(now())";
            $where8 = "year(FROM_UNIXTIME(s.last_campaign)) = year(now())";
        } elseif ($slug == 'monthly') {
            $newMonthlystats = new StatsMonthly();
            $statsentity = $newMonthlystats;
            $existingstats = $em->getRepository('App:StatsMonthly')->findOneBy(['year' => $curryear, 'month' => $currmonth]);
            $slug = 3;
            $where1 = "month(s.datecreated) = month(now())";
            $where2 = "year(s.datecreated) = year(now())";
            $where3 = "month(un.optoutdate) = month(now())";
            $where4 = "year(un.optoutdate) = year(now())";
            $where5 = "month(FROM_UNIXTIME(c.sent)) = month(now())";
            $where6 = "year(FROM_UNIXTIME(c.sent)) = year(now())";
            $where7 = "month(FROM_UNIXTIME(s.last_campaign)) = month(now())";
            $where8 = "year(FROM_UNIXTIME(s.last_campaign)) = year(now())";
        } elseif ($slug == 'yearly') {
            $newYearlystats = new StatsYearly();
            $statsentity = $newYearlystats;
            $existingstats = $em->getRepository('App:StatsYearly')->findOneBy(['year' => $curryear]);
            $slug = 4;
            $where1 = "year(s.datecreated) = year(now())";
            $where2 = "s.id LIKE '%'";
            $where3 = "year(un.optoutdate) = year(now())";
            $where4 = "un.id LIKE '%'";
            $where5 = "year(FROM_UNIXTIME(c.sent)) = year(now())";
            $where6 = "c.id LIKE '%'";
            $where7 = "year(FROM_UNIXTIME(s.last_campaign)) = year(now())";
            $where8 = "s.id LIKE '%'";
        }

        //unsubscribers suplementary query
        $qbUN = $em ->createQueryBuilder();
        $qbUN
            ->select('un')
            ->from('App\Entity\SubscriberOptOutDetails', 'un')
            ->where('s.id = un.user')
            ->andWhere($where3)
            ->andWhere($where4);

        //total count of active subscribers to date
        $query = $em->createQuery('SELECT COUNT(p.id) 
                                   FROM App:SubscriberDetails p 
                                   WHERE NOT EXISTS (SELECT 1 FROM App:SubscriberOptOutDetails s WHERE p.id = s.user )');
        $totalsubscribers = $query ->getSingleScalarResult();

        //subscribers period
        $qb = $em ->createQueryBuilder();
        $qb
            ->select('COUNT(s.id)')
            ->from('App\Entity\SubscriberDetails', 's')
            ->where($where1)
            ->andWhere($where2);
        $subscribersperiod = $qb ->getQuery() ->getSingleScalarResult();

        //total unsubscribed
        $query1 = $em->createQuery('SELECT COUNT(p.id) 
                                   FROM App:SubscriberDetails p 
                                   WHERE EXISTS (SELECT 1 FROM App:SubscriberOptOutDetails s WHERE p.id = s.user )');
        $unsubscribers = $query1 ->getSingleScalarResult();

        //unsubscribers period
        $qb2 = $em ->createQueryBuilder();
        $qb2
            ->select('COUNT(s.id)')
            ->from('App\Entity\SubscriberDetails', 's')
            ->where($qb->expr()->exists($qbUN->getDQL()));
        $unsubscribedperiod = $qb2 ->getQuery() ->getSingleScalarResult();

        //total campaigns sent
        $query3 = $em->createQuery('SELECT COUNT(c.id) FROM App:Campaigns c');
        $totalcampaignssent = $query3 ->getSingleScalarResult();

        //campaigns sent period
        $qb4 = $em ->createQueryBuilder();
        $qb4
            ->select('count(c.id)')
            ->from('App\Entity\Campaigns', 'c')
            ->where($where5)
            ->andWhere($where6);
        $campaignssentperiod = $qb4 ->getQuery() ->getSingleScalarResult();

        //total emails sent
        $query5 = $em->createQuery('SELECT SUM(c.toSend) FROM App:Campaigns c');
        $totalemailssent = $this->checkNull($query5 ->getSingleScalarResult());

        //emails sent period
        $qb6 = $em ->createQueryBuilder();
        $qb6
            ->select('sum(c.toSend)')
            ->from('App\Entity\Campaigns', 'c')
            ->where($where5)
            ->andWhere($where6);
        $emailssentperiod = $qb6 ->getQuery() ->getSingleScalarResult();
        $emailssentperiod = $this->checkNull($emailssentperiod);

        //total batches sent
        $query7 = $em->createQuery('SELECT COUNT(DISTINCT c.batch_id) FROM App:Campaigns c');
        $batches = $query7 ->getSingleScalarResult();

        //batches sent for period
        $qb8 = $em ->createQueryBuilder();
        $qb8
            -> select('COUNT(DISTINCT c.batch_id)')
            -> from('App\Entity\Campaigns', 'c')
            -> where($where5)
            -> andwhere($where6)
        ;
        $batchesperiod = $qb8 ->getQuery() ->getSingleScalarResult();

        //opens total
        $query9 = $em->createQuery('SELECT c.opens FROM App:Campaigns c WHERE c.opens is not NULL');
        $opensarray = $query9 ->getArrayResult();
        if(is_array($opensarray)){
            $openstotal = 0;
            foreach ($opensarray as $opens) {
                foreach ($opens as $open) {
                    $opens_array = explode(',', $open);
                    $opens_array2 = array();
                    foreach($opens_array as $oa)
                    {
                        $oa = $oa.',';
                        //$oa = delete_between(':', ',', $oa);
                        $oa = preg_replace('/:[\s\S]+?,/', '', $oa);
                        array_push($opens_array2, $oa);
                    }
                    $opens_unique = count(array_unique($opens_array2));
                }
                $openstotal = $openstotal + $opens_unique;
            }
        } else {
            $openstotal = 0;
        }

        //opens for period
        $qb9 = $em ->createQueryBuilder();
        $qb9
            ->select('c.opens')
            ->from('App\Entity\Campaigns', 'c')
            ->where('c.opens is not NULL')
            ->andWhere($where5)
            ->andWhere($where6);
        $opensarray = $qb9 ->getQuery() ->getArrayResult();
        if(is_array($opensarray)){
            $opensperiod = 0;
            foreach ($opensarray as $opens) {
                foreach ($opens as $open) {
                    $opens_array = explode(',', $open);
                    $opens_array2 = array();
                    foreach($opens_array as $oa)
                    {
                        $oa = $oa.',';
                        //$oa = delete_between(':', ',', $oa);
                        $oa = preg_replace('/:[\s\S]+?,/', '', $oa);
                        array_push($opens_array2, $oa);
                    }
                    $opens_unique = count(array_unique($opens_array2));
                }
                $opensperiod = $opensperiod + $opens_unique;
            }
        } else {
            $opensperiod = 0;
        }

        //total clicks generated
        $query10 = $em->createQuery('SELECT l.clicks FROM App:Links l WHERE l.clicks is not NULL');
        $clicksarray = $query10 ->getArrayResult();
        $clickstotal = 0;
        if (is_array($clicksarray)) {
            foreach ($clicksarray as $clicks) {
                foreach ($clicks as $click) {
                    $clicks_array = explode(',', $click);
                    $clicks_unique = count(array_unique($clicks_array));
                    $clickstotal = $clickstotal + $clicks_unique;
                }
            }
        } else {
            $clickstotal = 0;
        }

        //clicks for period
        $qb11 = $em ->createQueryBuilder();
        $qb11
            ->select('l.clicks')
            ->from('App\Entity\Links', 'l')
            ->join('App\Entity\Campaigns', 'c', \Doctrine\ORM\Query\Expr\Join::WITH, 'l.campaignId = c.id')
            ->where('l.clicks is not NULL')
            ->andWhere($where5)
            ->andWhere($where6);
        $clicksarray = $qb11 ->getQuery() ->getArrayResult();

        $clicksperiod = 0;
        if (is_array($clicksarray)) {
            foreach ($clicksarray as $clicks) {
                foreach ($clicks as $click) {
                    $clicks_array = explode(',', $click);
                    $clicks_unique = count(array_unique($clicks_array));
                    $clicksperiod = $clicksperiod + $clicks_unique;
                }
            }
        } else {
            $clicksperiod = 0;
        }

        //bounces total
        $query12 = $em->createQuery('SELECT COUNT(s.id) FROM App:Subscribers s WHERE s.bounced = 1');
        $bounces = $query12 ->getSingleScalarResult();

        //bounces for period
        $qb13 = $em ->createQueryBuilder();
        $qb13
            ->select('COUNT(s.id)')
            ->from('App\Entity\Subscribers', 's')
            ->where('s.bounced = 1')
            ->andWhere($where7)
            ->andWhere($where8);
        $bouncesperiod = $qb13 ->getQuery() ->getSingleScalarResult();

        //complaints
        $query14 = $em->createQuery('SELECT COUNT(s.id) FROM App:Subscribers s WHERE s.complaint = 1');
        $complaints = $query14 ->getSingleScalarResult();

        //complaints period
        $qb15 = $em ->createQueryBuilder();
        $qb15
            ->select('COUNT(s.id)')
            ->from('App\Entity\Subscribers', 's')
            ->where('s.complaint = 1')
            ->andWhere($where7)
            ->andWhere($where8);
        $complaintsperiod = $qb15 ->getQuery() ->getSingleScalarResult();

        //spend
        $spend = $totalemailssent * 0.0001;

        //spend period
        $spendperiod = $emailssentperiod * 0.0001;

        //revenue
        $revenue = 0;

        //revenue period
        $revenueperiod = 0;

        //valid emails
        $qb17 = $em->createQueryBuilder();
        $qb17
            -> select('count(es.id)')
            -> from('App:EmailStatus', 'es')
            -> where('es.smtpcheck = 1')
        ;
        $validemails = $qb17 ->getQuery() ->getSingleScalarResult();

        //invalid but formatted emails
        $qb18 = $em->createQueryBuilder();
        $qb18
            -> select('count(es.id)')
            -> from('App:EmailStatus', 'es')
            -> where('es.smtpcheck = 2')
        ;
        $invalidform = $qb18 ->getQuery() ->getSingleScalarResult();

        //invalid but formatted emails
        $qb19 = $em->createQueryBuilder();
        $qb19
            -> select('count(es.id)')
            -> from('App:EmailStatus', 'es')
            -> where('es.smtpcheck = 3')
        ;
        $invalid = $qb19 ->getQuery() ->getSingleScalarResult();

        if (!$existingstats) {
            $statsentity ->setYear($curryear);
            $statsentity ->setMonth($currmonth);
            $statsentity ->setWeek($currweek);
            $statsentity ->setDay(date("d"));
            $statsentity ->setDate(new DateTime());
            $statsentity ->setSubscribers($totalsubscribers);
            $statsentity ->setSubscribersperiod($subscribersperiod);
            $statsentity ->setUnsubscribers($unsubscribers);
            $statsentity ->setUnsubscribersperiod($unsubscribedperiod);
            $statsentity ->setBatches($batches);
            $statsentity ->setBatchesperiod($batchesperiod);
            $statsentity ->setCampaignssent($totalcampaignssent);
            $statsentity ->setCampaignsperiod($campaignssentperiod);
            $statsentity ->setEmailssent($totalemailssent);
            $statsentity ->setEmailssentperiod($emailssentperiod);
            $statsentity ->setOpens($openstotal);
            $statsentity ->setOpensperiod($opensperiod);
            $statsentity ->setClicks($clickstotal);
            $statsentity ->setClicksperiod($clicksperiod);
            $statsentity ->setBounces($bounces);
            $statsentity ->setBouncesperiod($bouncesperiod);
            $statsentity ->setComplaints($complaints);
            $statsentity ->setComplaintsperiod($complaintsperiod);
            $statsentity ->setSpend($spend);
            $statsentity ->setSpendperiod($spendperiod);
            $statsentity ->setRevenue($revenue);
            $statsentity ->setRevenueperiod($revenueperiod);
            $statsentity ->setDatemodified(new DateTime());
            $statsentity ->setValidemails($validemails);
            $statsentity ->setValidbutmissing($invalidform);
            $statsentity ->setInvalidemails($invalid);
            $em->persist($statsentity);
            $em->flush();
        } else {
            $statsentity = $existingstats;
            $statsentity ->setYear($curryear);
            $statsentity ->setMonth($currmonth);
            $statsentity ->setWeek($currweek);
            $statsentity ->setDay(date("d"));
            $statsentity ->setDate(new DateTime());
            $statsentity ->setSubscribers($totalsubscribers);
            $statsentity ->setSubscribersperiod($subscribersperiod);
            $statsentity ->setUnsubscribers($unsubscribers);
            $statsentity ->setUnsubscribersperiod($unsubscribedperiod);
            $statsentity ->setBatches($batches);
            $statsentity ->setBatchesperiod($batchesperiod);
            $statsentity ->setCampaignssent($totalcampaignssent);
            $statsentity ->setCampaignsperiod($campaignssentperiod);
            $statsentity ->setEmailssent($totalemailssent);
            $statsentity ->setEmailssentperiod($emailssentperiod);
            $statsentity ->setOpens($openstotal);
            $statsentity ->setOpensperiod($opensperiod);
            $statsentity ->setClicks($clickstotal);
            $statsentity ->setClicksperiod($clicksperiod);
            $statsentity ->setBounces($bounces);
            $statsentity ->setBouncesperiod($bouncesperiod);
            $statsentity ->setComplaints($complaints);
            $statsentity ->setComplaintsperiod($complaintsperiod);
            $statsentity ->setSpend($spend);
            $statsentity ->setSpendperiod($spendperiod);
            $statsentity ->setRevenue($revenue);
            $statsentity ->setRevenueperiod($revenueperiod);
            $statsentity ->setDatemodified(new DateTime());
            $statsentity ->setValidemails($validemails);
            $statsentity ->setValidbutmissing($invalidform);
            $statsentity ->setInvalidemails($invalid);
            $em->flush();
        }

        # STATS FOR CAMPAIGN DETAILS ACTION (THIS REQUIRES PASSING BATCH ID OTHERWISE THIS WILL BE CALCULATED FOR ALL BATCHES EVERY TIME)
        //making final SQL
        $qb16 = $em->createQueryBuilder();
        $qb16
            -> select('DISTINCT 
                              ca.id as id,
                              ca.datecreated AS DateCreated,
                              COUNT(DISTINCT c.id) AS CountCampaigns,
                              COUNT(DISTINCT s.id) AS CountEmails,
                              c.opens AS CountOpens,
                              SUM(s.bounced) AS CountBounces,
                              SUM(s.bounce_soft) AS CountBouncesS,
                              SUM(s.complaint) AS CountComplaints,
                              SUM(lk.clicks) AS CountClicks,
                              0 AS Revenue')
            -> from('App:CampaignInputDetails', 'ca')
            -> leftJoin('App\Entity\Campaigns', 'c', \Doctrine\ORM\Query\Expr\Join::WITH,'ca.id = c.batch_id')
            -> leftJoin('App\Entity\Links', 'lk', \Doctrine\ORM\Query\Expr\Join::WITH, 'c.id = lk.campaignId')
            -> leftJoin('App\Entity\Lists', 'li', \Doctrine\ORM\Query\Expr\Join::WITH, 'c.toSendLists = li.id')
            -> leftJoin('App\Entity\Subscribers', 's', \Doctrine\ORM\Query\Expr\Join::WITH, 'li.id = s.list')
            -> groupBy('ca.id')
            -> orderBy('ca.id', 'ASC')
        ;
        $tbldata = $qb16 ->getQuery() ->getResult();

        foreach($tbldata as $campstats){
            $batchid = $campstats['id'];
            $campaigns = $campstats['CountCampaigns'];
            $emailssent = $campstats['CountEmails'];
            $openscnt = $campstats['CountOpens'];
            $bouncescnt = $campstats['CountBounces'];
            $sbouncescnt = $campstats['CountBouncesS'];
            $complaintscnt = $campstats['CountComplaints'];
            $clickscnt = $campstats['CountClicks'];
            $spend = $emailssent * 0.0001;
            //finding campaign details based on camp id
            $batch = $em->getRepository('App:CampaignInputDetails')->findOneBy(['id' => $batchid]);
            if ($batch) {
                $currbatch = $batch;
                $currbatch ->setCampaigns($campaigns);
                $currbatch ->setEmailssent($emailssent);
                $currbatch ->setBounces($bouncescnt);
                $currbatch ->setSbounces($sbouncescnt);
                $currbatch ->setComplaints($complaintscnt);
                $currbatch ->setOpens($openscnt);
                $currbatch ->setClicks($clickscnt);
                $currbatch ->setSpend($spend);
                $currbatch ->setRevenue(0);
                $em->persist($currbatch);
                $em->flush();
            }
        }

        $em ->clear();
        $em ->getConnection()->close();
    }

}