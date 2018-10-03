<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\Campaigns;
use App\Entity\Lists;
use App\Entity\SubscriberAddress;
use App\Entity\SubscriberDetails;
use App\Entity\SubscriberOptInDetails;
use App\Entity\SubscriberOptOutDetails;
use App\Entity\Subscribers;
use DateTime;

class ecampService extends PublisherController
{
    private $app_id;
    private $templateid;
    private $numcampaigns;
    private $link1;
    private $timezone;
    private $depdate;

    public function ecampServiceAction($app_id, $numcampaigns, $link1, $timezone, $depdate)
    {
        #DEFININF VARIABLES
            $subscriber = new SubscriberDetails();
            $address = new SubscriberAddress();
            $optindetails = new SubscriberOptInDetails();
            $optoutdetails = new SubscriberOptOutDetails();
            $subscriber ->getAddressdetail() ->add($address);
            $subscriber ->getOptindetails() ->add($optindetails);
            $subscriber ->getOptoutdetails() ->add($optoutdetails);
        #SETTING UP REPOSITORIES
            $apprepo = $this->getDoctrine()->getRepository('AppBundle:SendyApps');
            $templaterepo = $this->getDoctrine()->getRepository('AppBundle:Template');
            $em = $this ->getDoctrine() ->getManager();
        #SELECTING SUBSCRIBERS ELIGIBLE FOR CAMPAIGN WHICH ARE
            ##-not unsubscribed from that specifict app
            ##-did not recieve an email from any of mediaff brand for the past 7 days
            ##-did not bounce more that 3 times
            ####selecting users that did not opt out from mailing resource
                $qb0 = $em ->createQueryBuilder();
                $qb0
                    -> select('opto')
                    -> from('AppBundle\Entity\SubscriberOptOutDetails', 'opto')
                    -> where('s.id = opto.user')
                    -> andwhere('opto.resourceid = :appid');
            ####selecting users with did not get email from us for 7 days + did not ever bounce hard
                $qb1 = $em ->createQueryBuilder();
                $qb1
                    -> select('send')
                    -> from('AppBundle\Entity\Subscribers', 'send')
                    -> join('AppBundle\Entity\Lists', 'l', \Doctrine\ORM\Query\Expr\Join::WITH, 'send.list = l.id')
                    -> join('AppBundle\Entity\Campaigns', 'camp', \Doctrine\ORM\Query\Expr\Join::WITH, 'l.id = camp.toSendLists')
                    -> where(':todaydate - camp.sendDate <= 7')
                    -> andwhere('send.bounced IS NULL')
                    -> andwhere('s.emailaddress = send.emailaddress')
                ;
            ####selecting users with specific bounce reasons from adk:
            #####
                $qb2 = $em ->createQueryBuilder();
                $qb2
                    -> select('adkerr')
                    -> from('AppBundle\Entity\SubscriberADKCampErrors', 'adkerr')
                    -> where('s.emailaddress = adkerr.recipient')
                ;
            ####final selection of users
            $qb = $em ->createQueryBuilder();
            $qb
                -> select('s')
                -> from('AppBundle\Entity\SubscriberDetails', 's')
                -> where($qb->expr()->not($qb->expr()->exists($qb0->getDQL())))
                -> andwhere($qb->expr()->not($qb->expr()->exists($qb1->getDQL())))
                -> andwhere($qb->expr()->not($qb->expr()->exists($qb2->getDQL())))
                -> setMaxResults($numcampaigns)
                -> setParameters(['appid' => $app_id, 'todaydate' => new DateTime()])
            ;
            $subscribers = $qb ->getQuery() ->getResult();

        #CREATING SENDY CAMPAIGN FOR ABOVE SELECTED SUBSCRIBERS
        if (is_array($subscribers)) {
            ###extracting required global data for campaign
                $app = $apprepo ->findOneBy(['id' => $app_id]);
            ###creating email template
                $template = $templaterepo->findOneBy(['app' => $app_id]);
                $preemail = $template->getHtmlText();
                $template = $this->get('twig')->createTemplate($preemail);
                $postemail = $template->render([
                    'link' => $link1,
                    'insertone' => $app ->getFromname(),
                    'sentemail' => $app ->getFromemail(),
                    'resourcename' => $app ->getAppname()]);
            ###creating subscriber lists
                $newList = new Lists();
                $queryli = $em ->createQuery('SELECT MAX(li.id) FROM AppBundle:Lists li');
                $listid = $queryli->getSingleScalarResult() + 1;
                #$newList ->setId($listid);
                $newList ->setApp($app_id);
                $newList ->setUserid('1');
                $newList ->setName("");
                $newList ->setOptIn('1');
                $newList ->setConfirmUrl('http://mediaff.com');
                $newList ->setThankyou('0');
                $newList ->setGoodbye('0');
                $newList ->setUnsubscribeAllList('1');
                $newList ->setPrevCount('0');
                $newList ->setCurrentlyProcessing('0');
                $newList ->setTotalRecords('0');
                $em->persist($newList);
                $em->flush();
            #creating sendy subscribers and adding them to the list
                foreach ($subscribers as $subscriber) {
                    $sendySubscriber = new Subscribers();
                    #$queryst = $em ->createQuery('SELECT MAX(st.id) FROM AppBundle:Subscribers st');
                    #$sendySubscriber ->setId($queryst->getSingleScalarResult() + 1);
                    $sendySubscriber ->setUserid('1');
                    $sendySubscriber ->setEmailaddress($subscriber ->getEmailaddress());
                    $sendySubscriber ->setName($subscriber ->getFirstname());
                    $sendySubscriber ->setCustomFields($subscriber ->getLastname().'%s%');
                    $sendySubscriber ->setList($listid);
                    $sendySubscriber ->setUnsubscribed('0');
                    $sendySubscriber ->setBounced('0');
                    $sendySubscriber ->setBounceSoft('0');
                    $sendySubscriber ->setComplaint('0');
                    $sendySubscriber ->setLastCampaign($depdate);
                    $sendySubscriber ->setTimestamp(new DateTime());
                    $sendySubscriber ->setJoinDate($optindetails ->getOptindate());
                    $sendySubscriber ->setConfirmed('1');
                    $sendySubscriber ->setMessageID('testmessage');
                    $em->persist($sendySubscriber);
                    $em->flush();
                }
            #creating campaign
                $sendyoffer = new Campaigns();
                #$query = $em ->createQuery('SELECT MAX(s.id) FROM AppBundle:Campaigns s');
                #$sendyoffer ->setId($query->getSingleScalarResult() + 1);
                $sendyoffer ->setUserid('1');
                $sendyoffer ->setApp($app_id);
                $sendyoffer ->setFromName($app ->getFromname());
                $sendyoffer ->setFromEmail($app ->getFromemail());
                $sendyoffer ->setReplyTo($app ->getReplyto());
                $sendyoffer ->setTitle("[Name,fallback=], ");
                $sendyoffer ->setLists($listid);
                $sendyoffer ->setToSendLists($listid);
                $sendyoffer ->setWysiwyg('1');
                $sendyoffer ->setHtmlText($postemail);
                $sendyoffer ->setSendDate(strtotime($depdate));
                $sendyoffer ->setTimezone($timezone);
                $em->persist($sendyoffer);
                $em->flush();
        }
        $resultquery = $em ->createQuery('SELECT COUNT(DISTINCT s.recipient) FROM AppBundle:SubscriberADKCampaign s');
        $result = $resultquery ->getSingleScalarResult();
        return array($result);
    }
}