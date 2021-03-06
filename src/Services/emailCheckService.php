<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;
use NeverBounce\Single;
use NeverBounce\Auth;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Egulias\EmailValidator\Validation\SpoofCheckValidation;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;

class emailCheckService extends PublisherController
{
    private $numemails;

    public function emailCheckServiceAction($numemails) {
        $em = $this ->getDoctrine() ->getManager();
        $subscriber = new SubscriberDetails();
        $key = Auth::setApiKey('secret_0073808a6d223620faf3860f368a2199');
        /* 1. Creating sub batches */
        $batcharray = array();
        /* selecting batch size based on the overall count */
        $batchsize = 50;
        /* identifiing number of batches */
        if ($numemails > $batchsize) {
            $cntbatch = round($numemails/$batchsize, 0, PHP_ROUND_HALF_DOWN);
            $rmd = $numemails % $batchsize;
            for ($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
            array_push($batcharray, $rmd);
        } else {
            $cntbatch = 1;
            $batchsize = $numemails;
            for ($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
        }
        /*processing each batch*/
        foreach ($batcharray as $sizecnt) {
            unset($subscribers);
            $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->emailCleanRand($sizecnt);
            foreach ($subscribers as $subscriber) {
                $email = $subscriber->getEmailaddress();
                /*NEVERBOUNCE EMAIL CHECKER*/
                $verification = new Single();
                $singlecheck = $verification->check($email, true, true);
                $emailStatus = new EmailStatus();
                $emailStatus ->setUserid($subscriber->getId());
                $emailStatus ->setRfccheck(-1);
                $emailStatus ->setDnscheck(-1);
                $emailStatus ->setSpoofcheck(-1);
                $emailStatus ->setSmtpcheck(-1);
                $emailStatus ->setNbstatus($singlecheck->result_integer);
                $emailStatus ->setDateCreated(new DateTime());
                //var_dump($emailStatus);
                $em->persist($emailStatus);
                unset($emailStatus);
            }
            $em->flush();
            $em->clear();
            $em ->getConnection()->close();
        }
    }
}