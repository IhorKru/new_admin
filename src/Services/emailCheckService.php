<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;

class emailCheckService extends PublisherController
{
    private $numemails;

    public function emailCheckServiceAction($numemails) {
        $em = $this ->getDoctrine() ->getManager();
        $emailStatus = new EmailStatus();
        $subscriber = new SubscriberDetails();
        # 1. Creating sub batches
        $batcharray = array(); # master sub batch
        $batchsize = 100;
        if($numemails > $batchsize) {
            $cntbatch = round($numemails/$batchsize,0,PHP_ROUND_HALF_DOWN);
            $rmd = $numemails % $batchsize;
            for($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
            array_push($batcharray,$rmd);
        } else {
            $cntbatch = 1;
            $batchsize = $numemails;
            for($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
        }
        foreach ($batcharray as $sizecnt) {
            $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->emailClean($sizecnt);
            foreach ($subscribers as $subscriber) {
                $email = $subscriber->getEmailaddress();
                $userid = $subscriber->getId();
                $vmail = new verifyEmail();
                $vmail->setStreamTimeoutWait(20);
                //$vmail->Debug = TRUE;
                //$vmail->Debugoutput= 'html';
                $vmail->setEmailFrom('viska@viska.is');
                if ($vmail->check($email)) {
                    $smtpstatus =  1;
                } elseif (verifyEmail::validate($email)) {
                    $smtpstatus = 2;
                } else {
                    $smtpstatus = 3;
                }
                $emailStatus ->setUserid($userid);
                $emailStatus ->setRfccheck(-1);
                $emailStatus ->setDnscheck(-1);
                $emailStatus ->setSpoofcheck(-1);
                $emailStatus ->setSmtpcheck($smtpstatus);
                $emailStatus ->setDateCreated(new DateTime());
                $em->persist($emailStatus);
                $em->flush();
                $em->clear();
            }
        }
    }
}