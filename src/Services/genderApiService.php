<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;
use App\Controller\verifyEmail;
use DateTime;
use GenderApi\Client as GenderApiClient;


class genderApiService extends PublisherController
{
    private $numchecks;

    public function nameCheckServiceAction($numemails) 
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
                $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->emailCleanRand($sizecnt);
                foreach ($subscribers as $subscriber) {
                    $firstname = $subscriber->getFirstname();
                    try {
                        // Query a single name
                        $lookup = $apiClient->getByFirstName('elisabeth');
                        if ($lookup->genderFound()) {
                            echo $lookup->getGender();      // female
                        }
                        // Query a full name and improve the result by providing a country code
                        $lookup = $apiClient->getByFirstNameAndLastNameAndCountry('Thomas Johnson', 'US');
                        if ($lookup->genderFound()) {
                            echo $lookup->getGender();      // male
                            echo $lookup->getFirstName();   // Thomas
                            echo $lookup->getLastName();    // Johnson
                        }
                    } catch (GenderApi\Exception $e) {
                        // Name lookup failed due to a network error or insufficient requests
                        // left. See https://gender-api.com/en/api-docs/error-codes
                        echo 'Exception: ' . $e->getMessage();
                    }
                }
            }
    }
}