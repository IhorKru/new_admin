<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\Campaigns;
use App\Entity\Lists;
use App\Entity\SubscriberAddress;
use App\Entity\SubscriberADKCampErrors;
use App\Entity\SubscriberDetails;
use App\Entity\Subscribers;
use App\Entity\SendyApps;

class emailCheck extends PublisherController
{
    public function emailValidation() {
        # 1a. Definition of entities
        $subscriber = new SubscriberDetails();

    }
}