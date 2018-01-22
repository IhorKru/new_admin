<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;


class emailCheckService extends PublisherController
{
    public function emailValidation($numemails) {
        # 1a. Definition of entities
        $subscriber = new SubscriberDetails();
        $emailStatus = new EmailStatus();
        $rootdir = getcwd();
        //selecting all subscribers from DB
        $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->campEligibilityCalc($numemails);
        if (is_array($subscribers)) {
            $subscribersB = array();
            $subscribersB = array_chunk($subscribers, 500, true);
            unset($subscribers);
        } # chunking massive array onto array of 500 users
        if (is_array($subscribersB)) {
            foreach ($subscribersB as $subscriberBS) {
                foreach ($subscriberBS as $subscriber) {
                    $email = $subscriber->getEmailaddress();
                    $validator = new EmailValidator();
                    $multipleValidations = new MultipleValidationWithAnd([
                        new RFCValidation(),
                        new DNSCheckValidation()
                    ]);
                    $validator->isValid($email, $multipleValidations);
                }
            }
        }
    }
}