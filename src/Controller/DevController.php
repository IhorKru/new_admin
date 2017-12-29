<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 18/05/2017
 * Time: 17:01
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DevController Extends Controller
{
    /**
     * @Route("/fbrawdata", name="fbrawdata")
     */
    public function facebookAction(){
        return $this->render('Testing/testing.html.twig');
    }
}