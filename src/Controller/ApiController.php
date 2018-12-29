<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 27/05/2017
 * Time: 22:08
 */

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api")
     * @return Response
     */
    public function apiAction () {
       
    }

}