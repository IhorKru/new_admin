<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\SubscriberDetails;
use App\Entity\EmailStatus;


class emailCheck extends PublisherController
{
    public function emailValidation() {
        # 1a. Definition of entities
        $subscriber = new SubscriberDetails();
        $emailStatus = new EmailStatus();
    }
}