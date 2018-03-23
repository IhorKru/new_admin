<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;
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
        //var_dump($batcharray);
        foreach ($batcharray as $sizecnt) {
            unset($subscribers);
            $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->emailClean($sizecnt);
            foreach ($subscribers as $subscriber) {
                $email = $subscriber->getEmailaddress();
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
                //eguilar email check
                /*$validator = new EmailValidator();
                $multipleValidations = new MultipleValidationWithAnd([
                    new RFCValidation(),
                    new DNSCheckValidation(),
                    new SpoofCheckValidation(),
                ]);
                $validator->isValid($email, $multipleValidations);*/
                $emailStatus = new EmailStatus();
                $emailStatus ->setUserid($subscriber->getId());
                $emailStatus ->setRfccheck(-1);
                $emailStatus ->setDnscheck(-1);
                $emailStatus ->setSpoofcheck(-1);
                $emailStatus ->setSmtpcheck($smtpstatus);
                $emailStatus ->setDateCreated(new DateTime());
                //var_dump($emailStatus);
                $em->persist($emailStatus);
                unset($emailStatus);
            }
            $em->flush();
            $em->clear();
            #$em ->getConnection()->close();
        }
    }
}