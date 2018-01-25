<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 13/05/2017
 * Time: 20:42
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\CampaignInputDetails;
use App\Entity\Template;
use App\Entity\PartnerDetails;
use App\Entity\newEmailCheck;
use App\Form\CampaignInputType;
use App\Form\NewEmailType;
use App\Form\newPartnerType;
use App\Form\EmailValidationType;
use Symfony\Component\Process\Process;
use App\Entity\SubscriberDetails;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use DateTime;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Egulias\EmailValidator\Validation\SpoofCheckValidation;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;

class PublisherController extends Controller
{
    /**
     * @Route("/pubmaster/{slug}", name="pubmaster", defaults={"slug" = 2}, requirements={"slug": "\d+"})
     * @param $slug
     * @return Response
     */
    public function pubmasterAction($slug)
    {
        //getting slug value
        $table = $this->setTablePropsTwo($slug)[0];
        $where0 = $this->setTablePropsTwo($slug)[1];
        $where1 = $this->setTablePropsTwo($slug)[2];
        $where2 = $this->setTablePropsTwo($slug)[3];
        $where3 = $this->setTablePropsTwo($slug)[4];
        $period = $this->setTablePropsTwo($slug)[5];
        $timestamp = $this->setTablePropsTwo($slug)[6];
        $format = $this->setTablePropsTwo($slug)[7];
        $addperiod = $this->setTablePropsTwo($slug)[8];
        $em = $this ->getDoctrine() ->getManager(); //getting data for stats
        //getting data for
        $statsdata = $em->getRepository('App:StatsDaily')->calculateStats($table,$where0,$where1,$where2,$where3);
        $emaildata = array();
        for ($i = 0; $i < 7; $i++) {
            $gperiod=strftime($format,$timestamp);
            if ($slug == 1) {
                $where0 = "s.date = DATE_ADD(CURRENT_DATE(),'-".$i."','DAY')";
            } elseif ($slug == 2) {
                $where0 = "s.week = ".strftime('%W',$timestamp);
                if ($gperiod == 52) {
                    $where3 = "s.year = year(now())-1";
                }
            } elseif ($slug == 3) {
                $where0 = "s.month = ".strftime('%m',$timestamp);
                if ($gperiod == 12) {
                    $where3 = "s.year = year(now())-1";
                }
            } elseif ($slug == 4) {
                $where0 = "s.year = ".strftime('%G',$timestamp);
            }
            $emailssent=$em->getRepository('App:StatsDaily')->cntEmailsSentCp($table,$where0,$where3);//selectingcountofemailssentinthatspecificday
            $emaildata[] = ['period'=>$gperiod,'emailssent'=>$emailssent];
            $timestamp = strtotime($addperiod, $timestamp);
        }
        $emaildata = array_reverse($emaildata);
        return $this->render('BackEnd/Publisher/pubMasterDash.twig', ['statsdata' => $statsdata, 'period' => $period, 'emaildata' => $emaildata, 'where0' => $gperiod]);
        //return $emaildata;
    }

    /**
     * @Route("/campaignsdash/{slug}", name="campaignsdash", defaults={"slug" = 2})
     * @param $slug
     * @return Response
     */
    public function campaignsdashAction($slug){
        $revenue = 0;
        $table = $this->setTableProps($slug)[0];
        $where0 = $this->setTableProps($slug)[1];
        $what = 's.batchesperiod';
        $batchesperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of batches sent for the period
        $prevbatches = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.campaignsperiod';
        $campaignsperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count campaigns current period
        $prevcampaigns = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.emailssentperiod';
        $emailsperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of emails sent for the period
        $prevemailssent = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.opensperiod';
        $opensperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of opens for the period
        $prevopens = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.clicksperiod';
        $clicksperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of opens for the period
        $prevclicks = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.bouncesperiod';
        $bouncesperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of bounces for the period
        $prevbounces = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.complaintsperiod';
        $complaintsperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of complaints for the period
        $prevcomplaints = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $what = 's.spendperiod';
        $spendperiod = $this->getDoctrine()->getRepository('App:StatsDaily')->currentCp($what,$table,$where0);//count of complaints for the period
        $prevspend = $this->getDoctrine()->getRepository('App:StatsDaily')->historyLp($what,$table);//selecting 18 prev occurances of above data
        $tabledata = $this->getDoctrine()->getRepository('App:StatsDaily')->campDetailTable();//getting data for table

        //pushing variables to template
        return $this->render('BackEnd/Publisher/pubCampDash.html.twig',['batchesperiod'=>$batchesperiod,'prevbatches'=>$prevbatches,'campaignsperiod'=>$campaignsperiod,'prevcampaigns'=>$prevcampaigns,
            'emailsperiod'=>$emailsperiod, 'prevemailssent'=>$prevemailssent,'opensperiod'=>$opensperiod,'prevopens'=>$prevopens,'clicksperiod'=>$clicksperiod,'prevclicks'=>$prevclicks,'bouncesperiod'=>$bouncesperiod,
            'prevbounces'=>$prevbounces,'complaintsperiod'=>$complaintsperiod,'prevcomplaints'=>$prevcomplaints,'spendperiod'=>$spendperiod,'prevspend'=>$prevspend,'revenueperiod'=>$revenue, 'tabledata'=>$tabledata,
            'daily'=>$slug,'weekly'=>$slug,'monthly'=>$slug,'yearly'=>$slug]);
    }

    /**
     * @Route("/subscriberdash/{slug}", name="subscriberdash", defaults={"slug" = false})
     * @param $slug
     * @return Response
     */
    public function subscribersdashAction($slug){
        return $this->render('BackEnd/Publisher/pubSubscrDash.twig',['daily'=>$slug,'weekly'=>$slug,'monthly'=>$slug,'yearly'=>$slug]);
    }

    /**
     * @Route("/partnerdash/{slug}", name="partnerdash", defaults={"slug" = false})
     * @param $slug
     * @return Response
     */
    public function partnerdashAction($slug){
        return $this->render('BackEnd/Publisher/pubPartnerDash.html.twig',['daily'=>$slug,'weekly'=>$slug,'monthly'=>$slug,'yearly'=>$slug]);
    }

    /**
     * @Route("/{_locale}/newpubcampaign", name="newpubcampaign")
     * @param Request $request
     * @return Response
     */
    public function emailcampaignsAction(Request $request)
    {
        $locale = $request->getLocale();
        //setting up form entity
        $em = $this ->getDoctrine() ->getManager();
        $newCampaign = new CampaignInputDetails();
        $form = $this->createForm(CampaignInputType::class, $newCampaign, [
            'action' => $this -> generateUrl('newpubcampaign'),
            'method' => 'POST'
        ]);
        //processing form data
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $traffic_obj = $form['traffic_type']->getData();
                $traffic_type = $traffic_obj ->getID();
            $partner_obj = $form['partnername']->getData();
                $partner = $partner_obj ->getID();
            $geo = $form['geo']->getData();
            #if partner is not ADK, collect data from below fields
            if ($partner != 4) {
                $app_obj = $form['resourcename']->getData();
                $app_id = $app_obj ->getID();
                $templateid = $form['templatename']->getData();
                $link1 = $form['link1']->getData();
                $link2 = $form['link2']->getData();
            } elseif ($partner == 4) {
                $app_id = '1';
                $templateid = '1';
                $link1 = 'http://adknowledge.com';
                $link2 = 'http://adknowledge.com';
            }
            $numcampaigns = $form['numemails']->getData();
            $timezone = $form['timezone'] ->getData();
            $depdate = $form['datetosend'] ->getData();
            $datedepf = date_create($depdate . ':00');
            //pushing campaign details to db
            $newCampaign ->setTrafficType($traffic_type);
            $newCampaign ->setPartnername($partner);
            $newCampaign ->setGeo($geo);
            /** @noinspection PhpUndefinedVariableInspection */
            $newCampaign ->setResourcename($app_id);
            /** @noinspection PhpUndefinedVariableInspection */
            $newCampaign ->setTemplatename($templateid);
            /** @noinspection PhpUndefinedVariableInspection */
            $newCampaign ->setLink1($link1);
            /** @noinspection PhpUndefinedVariableInspection */
            $newCampaign ->setLink2($link2);
            $newCampaign ->setTimezone($timezone);
            $newCampaign ->setDatetosend($datedepf);
            $newCampaign ->setDatecreated(new DateTime());
            $newCampaign ->setCampaigns(0);
            $newCampaign ->setEmailssent(0);
            $newCampaign ->setBounces(0);
            $newCampaign ->setSbounces(0);
            $newCampaign ->setComplaints(0);
            $newCampaign ->setOpens(0);
            $newCampaign ->setClicks(0);
            $newCampaign ->setSpend(0);
            $newCampaign ->setRevenue(0);
            $em->persist($newCampaign);
            $em->flush();
            //initiating required action based on the partner
            session_write_close();
            if($partner === 4) {
                //closing down current session and progressing with script creation
                $rootDir = getcwd();
                //$command = 'php ../bin/console app:adkaction ' . $numcampaigns . ' ' . $timezone . ' ' . '"' . $depdate . '"';
                $adk_process = new Process(
                    'php ../bin/console app:adkaction ' . $numcampaigns . ' ' . $timezone . ' ' . '"' . $depdate . '"'
                );
                $adk_process->setWorkingDirectory($rootDir);
                $adk_process->setTimeout(null);
                $adk_process->start();
                if($adk_process->isRunning()){
                    while($adk_process->isRunning()){
                    }
                    //var_dump($command);
                }
            } else {
                $getcampaign = $this->get('gen.campaign');
                $subscriberst = $getcampaign -> ecampServiceAction($geo, $app_id, $templateid, $numcampaigns, $link1, $link2, $timezone, $depdate);
            }
        }
        return $this->render('BackEnd/Publisher/newPubCampaign.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/bar", name="progbar")
     * @Method({"GET", "POST"})
     */
    public function ajaxProcessAction()
    {
        $barresp = array();
        $cntsubscr = $this->getDoctrine()->getManager()->getRepository('App:Subscribers')->findMaxRow();
        $cnterrors = $this->getDoctrine()->getManager()->getRepository('App:SubscriberADKCampErrors')->findMaxRow();
        array_push($barresp,$cntsubscr);
        array_push($barresp,$cnterrors);
        $response = new Response(json_encode($barresp));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/campstats", name="campstats")
     * @Method({"GET", "POST"})
     */
    public function campaignStatsAction() {
        $em = $this ->getDoctrine() ->getManager();
        //getting campaigns per resource
        $resourcestats = $em->getRepository('App:Campaigns')->campaignsPerResource();
        //getting emails per resource
        $resourceemails = $em->getRepository('App:Campaigns')->emailsPerResource();
        //getting emails sent or scheduled to be sent within 24 hours
        $emailsused = $em->getRepository('App:Subscribers')->emailsSentPeriod();
        //calculate email limit
        $emaillimit = '50000';
        //global limit a day minus what is in the line or already sent today
        if ($emailsused <> 0) {
            $sendlimit = ($emailsused/$emaillimit) * 100;
        } else {
            $sendlimit = 0;
        }
        //responce
        $partner = "Live";
        $response = new Response();
        $response->setContent($this->renderView('BackEnd/Publisher/pubCampDetails.html.twig',[
            'resourcestats' => $resourcestats,
            'resourceemails' => $resourceemails,
            'partnername' => $partner,
            'emaillimit' => $sendlimit
        ]));
        return $response;
    }

    /**
     * @Route("/newemailtempl", name="newemailtempl")
     */
    public function newemailtemplAction(Request $request){
        $newTemplate = new Template();
        $em = $this ->getDoctrine() ->getManager();
        $form = $this->createForm(NewEmailType::class, $newTemplate, [
            'action' => $this -> generateUrl('newemailtempl'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $appobj = $form['app']->getData();
            $app = $appobj ->getID();
            $tempname = $form['template_name']->getData();
            $file = $form['htmltext']->getData();
            $htmlText = file_get_contents($file->getPathname());
            $queryli = $em ->createQuery('SELECT MAX(li.id) FROM App:Template li');
            $newTemplate ->setId($queryli->getSingleScalarResult() + 1);
            $newTemplate ->setUserid('1');
            $newTemplate ->setApp($app);
            $newTemplate ->setTemplateName($tempname);
            $newTemplate ->setHtmlText($htmlText);
            $em->persist($newTemplate);
            $em->flush();
            $tabledata = $this->getDoctrine()->getRepository('App:Template')->temaplteDetailsTable();//getting data for table
            return $this->render('BackEnd/Publisher/newEmailTempl.html.twig',[
                'form'=>$form->createView(),
                'tabledata'=>$tabledata
            ]);
        }
        $tabledata = $this->getDoctrine()->getRepository('App:Template')->temaplteDetailsTable();//getting data for table
        return $this->render('BackEnd/Publisher/newEmailTempl.html.twig',[
            'form'=>$form->createView(),
            'tabledata'=>$tabledata
        ]);
    }

    /**
     * @Route("/newpubnetwork", name="newpubnetwork")
     * @param Request $request
     * @return Response
     */
    public function newadnetworkAction(Request $request){
        $newPartner = new PartnerDetails();
        $em = $this ->getDoctrine() ->getManager();
        $form = $this->createForm(newPartnerType::class, $newPartner, [
            'action' => $this -> generateUrl('newpubnetwork'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $networkname = $form['partner_name']->getData();
            $traffictype = $form['traffic_type']->getData();
            $geo = $form['geo']->getData();
            $size = $form['size']->getData();
            $tire = $form['tire']->getData();
            $newPartner ->setPartnerName($networkname);
            $newPartner ->setTrafficType($traffictype);
            $newPartner ->setGeo($geo);
            $newPartner ->setSize($size);
            $newPartner ->setTire($tire);
            $newPartner ->setPartnerType("Ad Network");
            $newPartner ->setDateCreated(new DateTime());
            $em->persist($newPartner);
            $em->flush();
            $tabledata = $this->getDoctrine()->getRepository('App:PartnerDetails')->publisherDetailsTable();//getting data for table
            return $this->render('BackEnd/Publisher/newPubNetwork.html.twig',[
                'form'=>$form->createView(),
                'tabledata'=>$tabledata
            ]);
        }
        $tabledata = $this->getDoctrine()->getRepository('App:PartnerDetails')->publisherDetailsTable();//getting data for table
        return $this->render('BackEnd/Publisher/newPubNetwork.html.twig',[
            'form'=>$form->createView(),
            'tabledata'=>$tabledata
        ]);
    }

    /**
     * @Route("/{_locale}/emailcheck", name="emailcheck")
     * @param Request $request
     * @return Response
     */
    public function emailValidationAction(Request $request) {
        $locale = $request->getLocale();
        $numemails = 1200;
        $emailCheck = new newEmailCheck();
        $form = $this->createForm(EmailValidationType::class, $emailCheck, [
            'action' => $this -> generateUrl('emailcheck'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            session_write_close();
            $rootDir = getcwd();
            $email_process = new Process(
                'php ../bin/console app:checkemails ' . $numemails
            );
            $email_process->setWorkingDirectory($rootDir);
            $email_process->setTimeout(null);
            $email_process->start();
            if($email_process->isRunning()){
                while($email_process->isRunning()){
                }
                //var_dump($email_process);
            }
        }

        return $this->render('BackEnd/Publisher/pubEmailCheck.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    private function setTablePropsTwo($slug) {
        $currmonth = date("m");
        $currweek = date("W");
        if($slug == "1") { //daily stats
            $table = "App\Entity\StatsDaily";
            $where0 = "s.date = CURRENT_DATE()";
            $where1 = "s.date = CURRENT_DATE()-1";
            $where2 = "s.id LIKE '%'";
            $where3 = "s.id LIKE '%'";
            $period = 'daily';
            $timestamp = strtotime("Today");
            $format = '%d/%m(%a)';
            $addperiod = '-1 day';
        } elseif ($slug == "2") { //weekly stats
            $table = "App\Entity\StatsWeekly";
            $where0 = "s.week = week(now(),1)";
            if ($currweek == 1) {
                $where1 = "s.week = 52";
                $where2 = "s.year = year(now())-1";
                $where3 = "s.year = year(now())";
            } else {
                $where1 = "s.week = week(now(),1)-1";
                $where2 = "s.year = year(now())";
                $where3 = $where2;
            }
            $period = 'weekly';
            $timestamp = strtotime("This week");
            $format = '%W(%Y)';
            $addperiod = '-1 week';
        } elseif ($slug == "3") { //monthly stats
            $table = "App\Entity\StatsMonthly";
            $where0 = "s.month = month(now())";
            if($currmonth == 1) {
                $where1 = "s.month = 12";
                $where2 = "s.year = year(now())-1";
                $where3 = "s.year = year(now())";
            } else {
                $where1 = "s.month = month(now())-1";
                $where2 = "s.year = year(now())";
                $where3 = $where2;
            }
            $period = 'monthly';
            $timestamp = strtotime("This Month");
            $format = '%m(%Y)';
            $addperiod = '- 1 month';
        } elseif ($slug == "4") { //yearly stats
            $table = "App\Entity\StatsYearly";
            $where0 = "s.year = year(now())";
            $where1 = "s.year = year(now())-1";
            $where2 = "s.id LIKE '%'";
            $where3 = "s.id LIKE '%'";
            $period = 'annually';
            $timestamp = strtotime("This Year");
            $format = '%Y';
            $addperiod = '-1 year';
        } else {
            $table = "App\Entity\StatsWeekly";
            $where0 = "s.week = week(now(),1)";
            if ($currweek == 1) {
                $where1 = "s.week = 52";
                $where2 = "s.year = year(now())-1";
                $where3 = "s.year = year(now())";
            } else {
                $where1 = "s.week = week(now(),1)-1";
                $where2 = "s.year = year(now())";
                $where3 = $where2;
            }
            $period = 'weekly';
            $timestamp = strtotime("-1 month");
            $format = '%m(%Y)';
            $addperiod = '+1 week';
        }
        return [$table,$where0,$where1,$where2,$where3,$period,$timestamp,$format,$addperiod];
    } //getting details of the table that will be queried for index dash
    private function setTableProps($slug) {
        if($slug == "daily") { //daily stats
            $table = "App\Entity\StatsDaily";
            $where0 = "s.date = CURRENT_DATE()";
        } elseif ($slug == "weekly") { //weekly stats
            $table = "App\Entity\StatsWeekly";
            $where0 = "s.week = week(now(),1)";
        } elseif ($slug == "monthly") { //monthly stats
            $table = "App\Entity\StatsMonthly";
            $where0 = "s.month = month(now())";
        } elseif ($slug == "yearly") { //yearly stats
            $table = "App\Entity\StatsYearly";
            $where0 = "s.year = year(now())";
        } else {
            $table = "App\Entity\StatsWeekly";
            $where0 = "s.week = week(now(),1)";
        }
        return [$table, $where0];
    } //getting details of the table that will be queried for campaigns dash

}