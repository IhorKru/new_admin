<?php

namespace App\Services;

use App\Controller\PublisherController;
use App\Entity\Campaigns;
use App\Entity\Lists;
use App\Entity\SubscriberAddress;
use App\Entity\SubscriberADKCampErrors;
use App\Entity\SubscriberDetails;
//use AppBundle\Entity\SubscriberOptInDetails;
//use AppBundle\Entity\SubscriberOptOutDetails;
use App\Entity\Subscribers;
use App\Entity\SendyApps;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;

class adkService extends PublisherController
{
    public function adkServiceAction($numcampaigns, $timezone, $depdate)
    {
        # 1a. Configuration setup for connecting to ADK
            $list_id = '23413';
            $sub_id = 'test_sub_id';
            $token = '305c7c5be78b5c8dd583312fe20578ac';
            $url = 'http://integrated.adstation.com/1.3';
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        # 1b. Definition of entities
            $subscriber = new SubscriberDetails();
            $address = new SubscriberAddress();
            //$optindetails = new SubscriberOptInDetails();
            //$optoutdetails = new SubscriberOptOutDetails();
            $subscriber ->getAddressdetail() ->add($address);
            //$subscriber ->getOptindetails() ->add($optindetails);
            //$subscriber ->getOptoutdetails() ->add($optoutdetails);
        # 1c. Definitiaon of variables
            # 1d. Definition of repositories
            $em = $this ->getDoctrine() ->getManager();
            $ent = $this->getDoctrine() ->getRepository('App:SubscriberDetails');
            $templaterepo = $this->getDoctrine()->getRepository('App:Template');
            $adkcategoryrepo = $this->getDoctrine() ->getRepository('App:RefADKCategoryDetails');
            $sendyappdetails = $this->getDoctrine() ->getRepository('App:SendyApps');
            $campighdetails = $this->getDoctrine() ->getRepository('App:Campaigns');
        # 2a. Creating sub batches for
        $rootdir = getcwd();
        try {
            if (file_exists($rootdir . '\working\adk\adkresult.xml')) unlink($rootdir . '\working\adk\adkresult.xml');
            $querybatch = $em ->createQuery('SELECT MAX(c.id) FROM App:CampaignInputDetails c');
            $curbatch = $querybatch->getSingleScalarResult();
            $batcharray = array(); # master sub batch
            $batchsize = 5000;
            if($numcampaigns > $batchsize) {
                $cntbatch = round($numcampaigns/$batchsize,0,PHP_ROUND_HALF_DOWN);
                $rmd = $numcampaigns % $batchsize;
                for($x = 0; $x < $cntbatch; $x++) {
                    array_push($batcharray, $batchsize);
                }
                array_push($batcharray,$rmd);
            } else {
                $cntbatch = 1;
                $batchsize = $numcampaigns;
                for($x = 0; $x < $cntbatch; $x++) {
                    array_push($batcharray, $batchsize);
                }
            }
            # 2b selecting users and crunching big array of data onto arrays of 500 emails as per ADK requirement
            foreach ($batcharray as $sizecnt) {
                $subscribers = $this->getDoctrine()->getRepository('App:SubscriberDetails')->campEligibilityCalc($sizecnt);
                if (is_array($subscribers)) {
                    $subscribersB = array();
                    $subscribersB = array_chunk($subscribers, 500, true);
                    unset($subscribers);
                } # creating array of api requests to ADK
                if (is_array($subscribersB)) {
                    #processing first level batch
                    $xmlarray = array();
                    foreach ($subscribersB as $subscriberBS) {
                        $xml = '';
                        foreach ($subscriberBS as $subscriber) {
                            $email = $subscriber->getEmailaddress();
                            $gender = $subscriber->getGender();
                            $isocountry = $address->getIsocountrycode();
                            $metrocode = $address->getRefgeoid();
                            $postalcode = $address->getPostalcode();
                            $md5_email = md5(strtolower($email));
                            $email_hashes[$md5_email] = $email;
                            $email_domain = strtolower(preg_replace('/.*\@/', '', $email));
                            $xml .= "<email>"
                                . "<recipient>$md5_email</recipient>"
                                . "<list>$list_id</list>"
                                . "<domain>$email_domain</domain>"
                                . "<countrycode>$isocountry</countrycode>"
                                . "<metrocode>$metrocode</metrocode>"
                                . "<postalcode>$postalcode</postalcode>"
                                . "<gender>$gender</gender>"
                                . "<test>0</test>"//setting up if all clicks will be test ones or real ones
                                . "</email>";
                        }
                        #preparing xml string
                        $xml = '<request>' . $xml . '</request>';
                        $request = urlencode($xml);
                        $query = 'Accept-Encoding: gzip' . '&';
                        $query .= 'token=' . $token . '&';
                        $query .= 'subid=' . $sub_id . '&';
                        $query .= 'idomain=' . $idomain . '&';
                        $query .= 'cdomain=' . $cdomain . '&';
                        $query .= 'request=' . $request . '&';
                        $query .= 'test=0';//setting up if all clicks will be test ones or real ones
                        array_push($xmlarray, $query);
                    }
                }
                unset($subscribersB);
                ## batching $xmlarray onto smaller arrays
                $xmlarrayB = array();
                $xmlarrayB = array_chunk($xmlarray, 4, true);
                foreach ($xmlarrayB as $xmlarrayBA) {
                    $curly = array(); // array of curl handles
                    $result = array(); // data to be returned
                    $mh = curl_multi_init(); // multi handle
                    foreach ($xmlarrayBA as $id => $d) {
                        $curly[$id] = curl_init();
                        curl_setopt($curly[$id], CURLOPT_URL, $url);
                        curl_setopt($curly[$id], CURLOPT_POST, true);
                        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d);
                        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curly[$id], CURLOPT_TIMEOUT, 60);
                        curl_setopt($curly[$id], CURLOPT_SSLVERSION, 3);
                        curl_multi_add_handle($mh, $curly[$id]);
                    } // query data for each of sub queries on the $xmlarray
                    $running = null; // execute the handles
                    do {
                        curl_multi_exec($mh, $running);
                        curl_multi_select($mh);
                    } while ($running > 0);
                    foreach ($curly as $id => $c) {
                        $result[$id] = curl_multi_getcontent($c);
                        curl_multi_remove_handle($mh, $c);
                    }// get content and remove handles
                    $active = null;
                    //execute the handles
                    curl_multi_close($mh);
                    //putting content into file
                    file_put_contents($rootdir . '\working\adk\adkresult.xml', $result, FILE_APPEND);
                }
                unset($xmlarray);
                unset($xmlarrayB);
                ## PARSING XML RESPONCE
                # prepare our stream to be read with a 16mb buffer
                $errorstream = new Stream\File($rootdir . '\working\adk\adkresult.xml', 1024);
                # setting options for error walker
                $erroroptions = [
                    "uniqueNode" => "error"
                ];
                $errorparser = new Parser\UniqueNode($erroroptions);
                # create the streamer
                $errorstreamer = new XmlStringStreamer($errorparser, $errorstream);
                # parsing ADK errors
                $batchc = 50;
                $i = 1;
                while ($node = $errorstreamer->getNode()) {
                    $simpleXmlNode = simplexml_load_string($node);
                    $errornum = $simpleXmlNode->num;
                    $errordesc = $simpleXmlNode->str;
                    $requestid = $simpleXmlNode->requestid;
                    $errorrecipient = $email_hashes[(string)$simpleXmlNode->recipient];
                    #pushing errors to db
                    $errordetails = new SubscriberADKCampErrors();
                    $errordetails->setErrornum($errornum);
                    $errordetails->setErrordesc($errordesc);
                    $errordetails->setRequestid($requestid);
                    $errordetails->setRecipient($errorrecipient);
                    $errordetails->setDatemodified(new DateTime());
                    $em->persist($errordetails);
                    $i = $i + 1;
                    if (($i % $batchc) === 0) {
                        $em->flush($errordetails);
                        $em->clear(); // Detaches all objects from Doctrine!
                    }
                }
                $em->flush();
                $em->clear();
                # parsing valid responces
                $querybatch = $em ->createQuery('SELECT MAX(c.id) FROM App:CampaignInputDetails c');
                $curbatch = $querybatch->getSingleScalarResult();
                # prepare our stream to be read with a 16mb buffer
                $emailstream = new Stream\File($rootdir . '\working\adk\adkresult.xml', 1024);
                # setting options for email walker
                $emailoptions = [
                    "uniqueNode" => "email"
                ];
                $emailparser = new Parser\UniqueNode($emailoptions);
                # create the streamer
                $emailstreamer = new XmlStringStreamer($emailparser, $emailstream);
                # parsing ADK emails
                $batchp = 1500;
                $j = 1;
                while ($node = $emailstreamer->getNode()) {
                    libxml_use_internal_errors(true); // !!!
                    $simpleXmlNode = simplexml_load_string($node);
                    if ($simpleXmlNode !== false) {
                        $categoryid = $simpleXmlNode->categoryid;
                        $campaign = new Campaigns();
                        $campaign = $this->getDoctrine()->getRepository('App:Campaigns')->campSearch((string)$categoryid, $curbatch);
                        if(count($campaign) == 0) {
                            #creating campaign details
                            $creative = $simpleXmlNode ->creative;
                            $sendyfrom = $creative->friendlyfrom;
                            $friendlyfrom = $creative->friendlyfrom;
                            $sendytitle = $creative->subject;
                            $body = $creative->body;
                            $body = substr($body,2,-3);
                            if(substr($body,0,6) == '<html>') {
                                $bodyconv = (string)$body;
                                $crawler = new Crawler($bodyconv);
                                $link = $crawler->filterXPath('//a/@href')->text();
                                //$textbody = $subcreative->textbody;
                                //$htmlcreativelength = $subcreative->htmlcreativelength;
                                //$textcreativelength = $subcreative->textcreativelength;
                            };
                            $adkcategory = $adkcategoryrepo->findOneBy(['categoryid' => $categoryid]);
                            if(is_null($adkcategory)) {
                                $appid = '8';
                            } else {
                                $appid = $adkcategory ->getAppId();
                            }
                            $app = new SendyApps();
                            $app = $sendyappdetails->findOneBy(['id' => $appid]);
                            $appname = $app->getAppName();
                            $appfromname = $app ->getFromName();
                            $appfromemail = $app ->getFromEmail();
                            $appreplytoemail = $app ->getReplyTo();
                            //creating email template for old adk templates
                            if(substr($body,0,6) == '<html>') {
                                $template = $templaterepo->findOneBy(['app' => $app]);
                                $preemail = $template->getHtmlText();
                                $template = $this->get('twig')->createTemplate($preemail);
                                $body = $template->render(array(
                                    'link' => $link,
                                    'insertone' => $friendlyfrom,
                                    'sentemail' => $appfromemail,
                                    'resourcename' => $appname));
                            };
                            #creating subscriber lists
                            $newList = new Lists();
                            $newList ->setUserid('1');
                            $newList ->setApp($app);
                            $newList ->setName($sendyfrom);
                            $newList ->setOptIn('1');
                            $newList ->setConfirmUrl('http://mediaff.com');
                            $newList ->setSubscribedUrl($app ->getSubscribeUrl());
                            $newList ->setUnsubscribedUrl($app ->getUnsubscribeUrl());
                            $newList ->setThankyou('0');
                            //$newList ->setThankyouSubject('');
                            //$newList ->setThankyouMessage('');
                            $newList ->setGoodbye('0');
                            //$newList ->setGoodbyeSubject('');
                            //$newList ->setGoodbyeMessage('');
                            //$newList ->setConfirmationSubject('');
                            //$newList ->setConfirmationEmail('');
                            $newList ->setUnsubscribeAllList('1');
                            //$newList ->setCustomFields('');
                            $newList ->setPrevCount('0');
                            $newList ->setCurrentlyProcessing('0');
                            $newList ->setTotalRecords('0');
                            $em->persist($newList); //persisting data to list table
                            $em->flush($newList);
                            $latestlist = new Lists();
                            $latestlist = $em->getRepository('App:Lists')->selectLatestList();
                            #selecting subscribers
                            $adksubscremail = $email_hashes[(string)$simpleXmlNode->recipient];
                            $subscriber = $ent->findOneByEmailaddress($adksubscremail);
                            $firstname = $subscriber ->getFirstName();
                            $lastname = $subscriber ->getLastName();
                            //$subscriptiondate = $optindetails ->getOptindate();
                            #setting properties for each subscriber
                            $sendySubscriber = new Subscribers();
                            $sendySubscriber ->setUserid('1');
                            $sendySubscriber ->setEmailaddress($adksubscremail);
                            $sendySubscriber ->setName($firstname);
                            $sendySubscriber ->setCustomFields($lastname.'%s%');
                            $sendySubscriber ->setList($latestlist[0]);
                            $sendySubscriber ->setUnsubscribed('0');
                            $sendySubscriber ->setBounced('0');
                            $sendySubscriber ->setBounceSoft('0');
                            $sendySubscriber ->setComplaint('0');
                            $sendySubscriber ->setLastCampaign(strtotime($depdate));
                            $sendySubscriber ->setTimestamp(new DateTime());
                            //$sendySubscriber ->setJoinDate($subscriptiondate);
                            $sendySubscriber ->setConfirmed('1');
                            $sendySubscriber ->setMessageID('testmessage');
                            $em->persist($sendySubscriber);
                            #pusshing campaign details into DB
                            $sendyoffer = new Campaigns();
                            $sendyoffer ->setUserid('1');
                            $sendyoffer ->setApp($app);
                            $sendyoffer ->setFromName($appfromname);
                            $sendyoffer ->setFromEmail($appfromemail);
                            $sendyoffer ->setReplyTo($appreplytoemail);
                            $sendyoffer ->setTitle("[Name,fallback=], ".$sendytitle);
                            $sendyoffer ->setHtmlText($body);
                            $sendyoffer ->setToSendLists($latestlist[0]->getId());
                            $sendyoffer ->setWysiwyg('1');
                            $sendyoffer ->setLists($latestlist[0]->getId());
                            $sendyoffer ->setSendDate(strtotime($depdate));
                            $sendyoffer ->setTimezone($timezone);
                            $sendyoffer ->setBatchId($curbatch);
                            $sendyoffer ->setCategoryId((string)$categoryid);
                            $em->persist($sendyoffer); //persisting data to campaign table
                        } else {
                            //extracting list from campaign
                            $latestlist = $em->getRepository('App:Lists')->findOneBy(array('id' => $campaign[0]->getLists()));
                            $adksubscremail = $email_hashes[(string)$simpleXmlNode->recipient];
                            $subscriber = $ent->findOneByEmailaddress($adksubscremail);
                            $firstname = $subscriber ->getFirstName();
                            $lastname = $subscriber ->getLastName();
                            //$subscriptiondate = $optindetails ->getOptindate();
                            #setting properties for each subscriber
                            $sendySubscriber = new Subscribers();
                            $sendySubscriber ->setUserid('1');
                            $sendySubscriber ->setEmailaddress($adksubscremail);
                            $sendySubscriber ->setName($firstname);
                            $sendySubscriber ->setCustomFields($lastname.'%s%');
                            $sendySubscriber ->setList($latestlist);
                            $sendySubscriber ->setUnsubscribed('0');
                            $sendySubscriber ->setBounced('0');
                            $sendySubscriber ->setBounceSoft('0');
                            $sendySubscriber ->setComplaint('0');
                            $sendySubscriber ->setLastCampaign(strtotime($depdate));
                            $sendySubscriber ->setTimestamp(new DateTime());
                            //$sendySubscriber ->setJoinDate($subscriptiondate);
                            $sendySubscriber ->setConfirmed('1');
                            $sendySubscriber ->setMessageID('testmessage');
                            $em->persist($sendySubscriber);
                        };
                        $j = $j + 1;
                        if (($j % $batchp) === 0) {
                            $em->flush();
                            $em->clear(); // Detaches all objects from Doctrine!
                        }
                    } else
                    {
                        foreach(libxml_get_errors() as $error)
                        {
                            error_log('Error parsing XML file: ' . $error->message);
                        }
                    }
                    $em->flush();
                    $em->clear();
                }
                //unlink($rootdir . '\working\adk\adkresult.xml');
            }
        } catch (Exception $e) {
            unset($subscribers);
            unset($subscribersB);
            unset($xmlarray);
            unset($xmlarrayB);
            unlink($rootdir . '\working\adk\adkresult.xml');
        }
    }
}