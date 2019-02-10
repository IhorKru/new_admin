<?php

namespace App\Services\hckz;

use App\Controller\PublisherController;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Liurldata;

class GetWebsiteContent extends PublisherController {
//#####################################################3getting data from websites
        /*$em = $this ->getDoctrine() ->getManager();
        $arrContextOptions=array(
            "ssl"=>array(
                  "verify_peer"=>false,
                  "verify_peer_name"=>false,
              ),
        );  
        function get_title($url){
            error_reporting(0);
            try {
                //check if htt is present within domain name
                $str = file_get_contents($url,false,stream_context_create($arrContextOptions));
                if(strlen($str)>0){
                  $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                  preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
                  return $title[1];
                }
            } catch (Exception $e) {
                return $e;
            }
        }
        //getting value of meta tags
        function get_keywords($url){
            error_reporting(0);
            try {
                //check if htt is present within domain name
                // Assuming the above tags are at 
                // https://w3guy.com/win-jump-start-php-book/
                $tags = get_meta_tags($url);
                // Note: the array keys are the respective meta tag name attribute 
                // and are all lowercase
                return $tags['keywords'];
                //echo $tags['description']; // Win a free e-book copy of sitepoint's Jump Start PHP Book
                //echo $tags['keywords'];     // Book Review,Giveaways,Download Jump Start PHP,freebies,giveaway
                //echo $tags['twitter:creator'];       // @tech4sky
                //echo $tags['generator'];  // WordPress 3.8
            } catch (Exception $e) {
                return $e;
            }
        }

        //getting value of meta tags
        function get_description($url){
            error_reporting(0);
            try {
                $tags = get_meta_tags($url);
                return $tags['description'];
            } catch (Exception $e) {
                return $e;
            }
        }

        $urls = [
            
        ];
        
        foreach ($urls as $url) {
            $urldetails = new Liurldata();
            $urldetails ->setUrl($url);
            $urldetails ->setTitle(get_title($url));
            $urldetails ->setKeywords(get_keywords($url));
            $urldetails ->setDescription(get_description($url));
            $urldetails ->setDateadded(new DateTime());
            $em->persist($urldetails);

            $j = $j + 1;
            if (($j % 10) === 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }
        $em->flush();
        $em->clear(); // Detaches all objects from Doctrine!

        /*foreach ($urls as $url) {        
            $prefix = substr($url, 0, 3);
            if($prefix == 'htt' && strpos($url, '://') !== false) {
                $urldetails = new Liurldata();
                $urldetails ->setUrl($url);
                $urldetails ->setTitle(get_title($url));
                $urldetails ->setDateadded(new DateTime());
                $em->persist($urldetails);
            } else {
                $urldetails = new Liurldata();
                $urldetails ->setUrl($url);
                $urldetails ->setTitle(get_title($url));
                $urldetails ->setDateadded(new DateTime());
                $em->persist($urldetails);
            }
            $j = $j + 1;
            if (($j % 100) === 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }*/
}