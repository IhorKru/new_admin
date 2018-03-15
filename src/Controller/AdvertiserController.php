<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 07/05/2017
 * Time: 16:03
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\newAdOfferDetails;
use App\Form\newAdOfferType;
use App\Entity\PartnerDetails;
use App\Form\newPartnerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use DateTime;

class AdvertiserController extends Controller
{
    /**
     * @Route("/adsdashboard/{slug}", name="adsdashboard", defaults={"slug" = false}, requirements={"slug": "\d+"})
     * @param $slug
     * @return Response
     */
    public function adDashboardAction ($slug) {
        return $this->render('BackEnd/Advertiser/adMasterDash.html.twig');
    }
    /**
     * @Route("/adsoffersdashboard", name="adsoffersdashboard", defaults={"slug" = false}, requirements={"slug": "\d+"})
     * @param $slug
     * @return Response
     */
    public function adsoffersdashboardAction ($slug) {
        return $this->render('BackEnd/Advertiser/adOfferDash.html.twig');
    }
    /**
     * @Route("/adoffers", name="adoffers")
     */
    public function adOfferAction () {
        $tabledata = $this->getDoctrine()->getRepository('App:newAdOfferDetails')->offerDetailsTable();//getting data for table
        return $this->render('BackEnd/Advertiser/adOffers.html.twig', [
            'tabledata' =>$tabledata
        ]);
    }
    /**
     * @Route("/newadnetwork", name="newadnetwork")
     * @param Request $request
     * @return Response
     */
    public function newAdNetworkAction (Request $request) {
        $em = $this ->getDoctrine() ->getManager();
        $newPartner = new PartnerDetails();
        $form = $this->createForm(newPartnerType::class, $newPartner, [
            'action' => $this -> generateUrl('newadnetwork'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $partnername = $form['partner_name']->getData();
            $partnertype = $form['partner_type']->getData();
            $traffictype = $form['traffic_type']->getData();
            $geo = $form['geo']->getData();
            $size = $form['size']->getData();
            $tire = $form['tire']->getData();
            $newPartner ->setPartnerName($partnername);
            $newPartner ->setPartnerType($partnertype);
            $newPartner ->setTrafficType($traffictype);
            $newPartner ->setGeo($geo);
            $newPartner ->setSize($size);
            $newPartner ->setTire($tire);
            $newPartner ->setDateCreated(new DateTime());
            $em->persist($newPartner);
            $em->flush();
            $tabledata = $this->getDoctrine()->getRepository('App:PartnerDetails')->adnetworkDetailsTable();//getting data for table
            return $this->render('BackEnd/Advertiser/newAdNetwork.html.twig',[
                'form'=>$form->createView(),
                'tabledata'=>$tabledata
            ]);
        }
        $tabledata = $this->getDoctrine()->getRepository('App:PartnerDetails')->adnetworkDetailsTable();//getting data for table
        return $this->render('BackEnd/Advertiser/newAdNetwork.html.twig',[
            'form'=>$form->createView(),
            'tabledata'=>$tabledata
        ]);
    }
    /**
     * @Route("/newoffer", name="newoffer")
     * @param Request $request
     * @return Response
     */
    public function newOfferAction (Request $request) {
        $em = $this ->getDoctrine() ->getManager();
        $newAdOffer = new newAdOfferDetails();
        $form = $this->createForm(newAdOfferType::class, $newAdOffer, [
            'action' => $this -> generateUrl('newoffer'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $offername = $form['offer_name']->getData();
            $partnername = $form['partner']->getData();
            $url = $form['url']->getData();
            $geo = $form['geo']->getData();
            $desc = $form['offer_desc']->getData();
            $status = $form['offer_status']->getData();
            $newAdOffer ->setOfferName($offername);
            $newAdOffer ->setPartner($partnername);
            $newAdOffer ->setUrl($url);
            $newAdOffer ->setGeo($geo);
            $newAdOffer ->setOfferDesc($desc);
            $newAdOffer ->setOfferStatus($status);
            $newAdOffer ->setDateModified(new DateTime());
            $em->persist($newAdOffer);
            $em->flush();
            return $this->render('BackEnd/Advertiser/newAdOffer.html.twig',[
                'form'=>$form->createView()
            ]);
        }
        return $this->render('BackEnd/Advertiser/newAdOffer.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}