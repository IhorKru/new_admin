<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 27/05/2017
 * Time: 22:08
 */

namespace App\Controller;
use React\Http\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    //identify request (collect all requests comming into api
    //extract parameters from the request
        //partnerid
        //offerid
        //reade request header
            //geo
            //device type
    //find offer based on offer id
    //find partner based on partner id
    //check if all is matching from the header
    //record a click
    //redirect to offer
    /**
     * @Route("/api")
     * @param Request $request
     */
    public function apiAction ($request) {
        //select url to be redirected to
    }

}