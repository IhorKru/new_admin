<?php

namespace App\Services\hckz;

use App\Controller\PublisherController;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;

class apiSCBGBDFLtestService extends PublisherController {

    public function apiSCBGBDFLtestServiceAction ($cntiin) {
        //constants identification
        $userid = '3d4f80d7-b7d7-4a45-9570-e43d4660f6fa';
        $clientid = 'e4be6659-29d9-4ee5-ae40-5d4a7e01bafb';
        $password = 'Homecredit_123';
        $url = 'https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService';

        //variable defenition
        $iin = '700521700054';
        $opts = array(
            'ssl' => array(
                'ciphers' => 'RC4-SHA',
                'verify_peer' => false,
                'verify_peer_name' => false
                )
        );
        $options = array(
            'login' => $clientid,
            'password' => $password,
            'encoding' => 'UTF-8',
            'verifypeer' => false,
            'verifyhost' => false,
            'soap_version' => SOAP_1_2,
            'trace' => 1,
            'exceptions' => 1,
            'connection_timeout' => 180,
            'stream_context' => stream_context_create($opts)
        );
        $wsdlUrl = $url . '?WSDL';
        $client = new \SoapClient($wsdlUrl, $options);
    }
}