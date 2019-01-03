<?php

namespace App\Services\hckz;

use App\Controller\PublisherController;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;

class gbdflTest extends PublisherController {

    public function apiSCBGBDFLtestServiceAction ($cntiin) {
        //constants identification
        $userid = '3d4f80d7-b7d7-4a45-9570-e43d4660f6fa';
        $clientid = 'e4be6659-29d9-4ee5-ae40-5d4a7e01bafb';
        $password = 'Homecredit_123';
        $urltest = 'https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService';
        $urlprod = 'https://scbws.mkb.kz/gbdServices/PersonDetailsImplService';
        $rootdir = getcwd();
        //variable defenition
        $iin = '700521700054';
        
        /*$xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:data="http://data.gbd.chdb.scb.kz">
                                <soapenv:Header>
                                <userId>3d4f80d7-b7d7-4a45-9570-e43d4660f6fa</userId>
                                </soapenv:Header>
                                <soapenv:Body>
                                <data:getPerson>
                                    <!--Optional:-->
                                    <iin>' . $iin . '</iin>
                                    <!--Optional:-->
                                    <consentConfirmed>true</consentConfirmed>
                                </data:getPerson>
                                </soapenv:Body>
                            </soapenv:Envelope>';
        $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService/getPerson", 
                        "Content-length: ".strlen($xml_post_string),
                        ); //SOAPAction: your op URL
        // PHP cURL  for https connection with auth
        $url = $urltest .'?wsdl';
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERPWD, $clientid.":".$password); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //print_r($response);
        /*$client = new \SoapClient('https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService?wsdl', 
                                    array(
                                        'login'    => "e4be6659-29d9-4ee5-ae40-5d4a7e01bafb",
                                        'password' => "Homecredit_123"
                                    )
                                );*/
                                $opts = array(
                                    'ssl' => array('verify_peer' => false, 'verify_peer_name' => false)
                                  );
                                  
        $client = new \SoapClient(null,
                                array(
                                    'location' => 'https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService/getPerson',
                                    'uri' => 'https://testscbws.mkb.kz/gbdServices/PersonDetailsImplService?wsdl',
                                    'login'    => "e4be6659-29d9-4ee5-ae40-5d4a7e01bafb",
                                    'password' => "Homecredit_123",
                                    'trace'          => 1,
                                    'exceptions'     => 0,
                                    'stream_context' => stream_context_create($opts)
                                )
                            );
        $result = $client->__soapCall('getPerson', array(
                                                        'parameters' => array(
                                                                            'iin' => '700521700054',
                                                                            'consentConfirmed' => 'true'
                                                                        )));
        //file_put_contents($rootdir . '\working\adk\adkresult.xml', $result, FILE_APPEND);
        print_r($rootdir);
    }
}