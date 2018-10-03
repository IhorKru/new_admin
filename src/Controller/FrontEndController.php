<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     */
    public function indexAction () {
        return $this->render('FrontEnd/index.html.twig');
    }
}