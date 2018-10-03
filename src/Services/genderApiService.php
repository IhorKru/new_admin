<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\GenderName;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;
use GenderApi\Client as GenderApiClient;
use GenderApi\GenderApi;

class genderApiService extends PublisherController {
    private $numchecks;
    public $gender_id;
    public function genderApiServiceAction($numchecks) {
        //select distinct first names from the table according to the count selected
        $em = $this ->getDoctrine() ->getManager();
        $subscriber = new SubscriberDetails();
        //https://gender-api.com/en/
        $apiClient = new GenderApiClient('enRaeoVEKdoyDFBCkr');
        //https://genderapi.io/
        $genderApi = new GenderApi('5bb09bbaff8c27498f6c2601');
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
                $lastname = $subscriber->getLastname();
                //https://gender-api.com/en/
                try {
                    //check if we still have limit with vendor
                    $stats = $apiClient->getStats();
                    // Check your query limit
                    if (!$stats->isLimitReached()) {
                        $lookup = $apiClient->getByFirstNameAndLastNameAndCountry($firstname . ' ' . $lastname, 'US');
                        $returnedgender = $lookup->getGender();
                        $vendor = 'gender-api.com';
                    } else {
                        //https://genderapi.io/
                        //check if the limit is there for vendor
                        try {
                            $getResult = $genderApi->result($firstname);
                            $errnum = $getResult->{'errno'};
                            if(!$errnum) {
                                $returnedgender = $getResult->{'gender'};
                                $vendor = 'genderapi.io';
                            } elseif ($errnum == '93') {
                                die;
                            }
                        } catch (GenderApi\Exception $e2) {
                            //store.genderize.io
                            echo 'Exception: ' . $e2 ->getMessage();
                        }
                    }
                } catch (GenderApi\Exception $e) {
                    echo 'Exception: ' . $e->getMessage();
                }
                $namegender = new GenderName();
                if ($returnedgender == 'male') {
                    $gender_id = 1;
                } elseif ($returnedgender == 'female') {
                    $gender_id = 0;
                } elseif ($returnedgender == 'unknown' OR $returnedgender == 'null') {
                    $gender_id = 2;
                } else {
                    $gender_id = 3;
                }
                if ($vendor == 'gender-api.com') {
                    $namegender ->setFirstname($subscriber->getFirstname());
                    $namegender ->setFirstnameSanitized($lookup->getFirstName());
                    $namegender ->setGenderId((string)$gender_id);
                    $namegender ->setSamples($lookup->getSamples());
                    $namegender ->setAccuracy($lookup->getAccuracy());
                    $namegender ->setDateCreated(new DateTime());
                    $namegender ->setDateModified(new DateTime());
                    $namegender ->setVendor($vendor);
                } elseif ($vendor == 'genderapi.io') {
                    $namegender ->setFirstname($subscriber->getFirstname());
                    $namegender ->setFirstnameSanitized($getResult->{'q'});
                    $namegender ->setGenderId((string)$gender_id);
                    $namegender ->setSamples($getResult->{'total_names'});
                    $namegender ->setAccuracy($getResult->{'probability'});
                    $namegender ->setDateCreated(new DateTime());
                    $namegender ->setDateModified(new DateTime());
                    $namegender ->setVendor($getResult->{'server'});
                }
                $em->persist($namegender);
                unset($namegender);
            }
            $em->flush();
            $em->clear();
            $em->getConnection()->close();
        }
    }
}