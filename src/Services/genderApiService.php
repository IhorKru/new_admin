<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\GenderName;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;
use GenderApi\Client as GenderApiClient;

class genderApiService extends PublisherController
{
    private $numchecks;
    public $gender_id;

    public function genderApiServiceAction($numchecks) 
    {
        //select distinct first names from the table according to the count selected
        $em = $this ->getDoctrine() ->getManager();
        $subscriber = new SubscriberDetails();
        $apiClient = new GenderApiClient('enRaeoVEKdoyDFBCkr');
        /* 1. Creating sub batches */
        $batcharray = array();
        /* selecting batch size based on the overall count */
        $batchsize = 10;
        /* identifiing number of batches */
        if ($numchecks > $batchsize) {
            $cntbatch = round($numchecks/$batchsize, 0, PHP_ROUND_HALF_DOWN);
            $rmd = $numchecks % $batchsize;
            for ($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
            array_push($batcharray, $rmd);
        } else {
            $cntbatch = 1;
            $batchsize = $numchecks;
            for ($x = 0; $x < $cntbatch; $x++) {
                array_push($batcharray, $batchsize);
            }
        }
        //checking names
        foreach ($batcharray as $sizecnt) {
            unset($subscribers);
            $subscribers = $this->getDoctrine()->getRepository('App:GenderName')->genderCheck($sizecnt);
            foreach ($subscribers as $subscriber) {
                $firstname = $subscriber->getFirstname();
                //$firstname = 'Tomas';
                $lastname = $subscriber->getLastname();
                try {
                    $lookup = $apiClient->getByFirstNameAndLastNameAndCountry($firstname . ' ' . $lastname, 'US');
                } catch (GenderApi\Exception $e) {
                    echo 'Exception: ' . $e->getMessage();
                }

                $namegender = new GenderName();
                $returnedgender = $lookup->getGender();
                if ($returnedgender == 'male') {
                    $gender_id = 1;
                } elseif ($returnedgender == 'female') {
                    $gender_id = 0;
                } elseif ($returnedgender == 'unknown') {
                    $gender_id = 2;
                } else {
                    $gender_id = 3;
                }

                var_dump($subscriber->getFirstname());
                var_dump($lookup->getFirstName());
                var_dump((string)$gender_id);
                var_dump($lookup->getSamples());
                var_dump($lookup->getAccuracy());
                var_dump($lookup->genderFound());
                var_dump($returnedgender);
                
                $namegender ->setFirstname($subscriber->getFirstname());
                $namegender ->setFirstnameSanitized($lookup->getFirstName());
                $namegender ->setGenderid((string)$gender_id);
                $namegender ->setSamples($lookup->getSamples());
                $namegender ->setAccuracy($lookup->getAccuracy());
                $namegender ->setDateCreated(new DateTime());
                $namegender ->setDateModified(new DateTime());
                $em->persist($namegender);
                unset($namegender);
            }
            $em->flush();
            $em->clear();
            $em->getConnection()->close();
        }
    }
}