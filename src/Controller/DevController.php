<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 18/05/2017
 * Time: 17:01
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DevController Extends AbstractController
{
    /**
     * @Route("/fbrawdata", name="fbrawdata")
     */
    public function facebookAction(){
        return $this->render('Testing/testing.html.twig');
    }
}