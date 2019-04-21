<?php

namespace App\Services\hckz;

use App\Controller\PublisherController;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Liurldata;

class GetgbdflData extends PublisherController {

    public function apiSCBGBDFLtestServiceAction ($cntiin) {
        //constants identification
        $userid = '3d4f80d7-b7d7-4a45-9570-e43d4660f6fa';
        $clientid = 'e4be6659-29d9-4ee5-ae40-5d4a7e01bafb';
        $password = 'Homecredit_123';
        //variable defenition*/
        $iin = '700521700054';
        $consent = 'true';
        //####################### SOAP TRIAL 1
        $rootdir = getcwd();
        $wsdl = $rootdir . '/public/working/wsdl/scbgbdfl.wsdl';
        $opts = array(
            'ssl'  =>array('verify_peer' =>false,'verify_peer_name' =>false,'allow_self_signed' => true)
        );
        $client = new \SoapClient($wsdl, [
            'login'    => $clientid,
            'password' => $password,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'soap_version'=> SOAP_1_1,
            'style' => SOAP_RPC,
            'use' => SOAP_ENCODED,
            'trace' => true,
            'exceptions' => true,
            'stream_context' => stream_context_create($opts)]
        );
        //var_dump($client->__getFunctions());
        //var_dump($client->__getTypes());
        $params = array (
            "iin" => $iin,
            "consentConfirmed" => $consent
        );
        
        $auth = "<userId>$userid</userId>";
        $auth_block = new \SoapVar( $auth, XSD_ANYXML, NULL, NULL, NULL, NULL );
    
        $header = new \SoapHeader( 'http://schemas.xmlsoap.org/soap/envelope/', 'Header', $auth_block);
        $client->__setSoapHeaders( $header );

        try {
            $response = $client->getPerson($params);
        } catch (SoapFault $fault) {
            var_dump(get_class($exception));
            var_dump($exception);
        }
        //var_dump($response);
        //parsing gbdfl data into table
        echo $response->return->Person->responseData->data->persons->person->iin;
        echo $response->return->Person->responseData->data->persons->person->surname;
        echo $response->return->Person->responseData->data->persons->person->name;
        echo $response->return->Person->responseData->data->persons->person->patronymic;
        echo $response->return->Person->responseData->data->persons->person->birthDate;
        echo $response->return->Person->responseData->data->persons->person->deathDate;

            echo $response->return->Person->responseData->data->persons->person->gender->code;
            echo $response->return->Person->responseData->data->persons->person->gender->nameRu;
            echo $response->return->Person->responseData->data->persons->person->gender->nameKz;
            echo $response->return->Person->responseData->data->persons->person->gender->changeDate;

            echo $response->return->Person->responseData->data->persons->person->nationality->code;
            echo $response->return->Person->responseData->data->persons->person->nationality->nameRu;
            echo $response->return->Person->responseData->data->persons->person->nationality->nameKz;
            echo $response->return->Person->responseData->data->persons->person->nationality->changeDate;

            echo $response->return->Person->responseData->data->persons->person->citizenship->code;
            echo $response->return->Person->responseData->data->persons->person->citizenship->nameRu;
            echo $response->return->Person->responseData->data->persons->person->citizenship->nameKz;
            echo $response->return->Person->responseData->data->persons->person->citizenship->changeDate;

            echo $response->return->Person->responseData->data->persons->person->lifeStatus->code;
            echo $response->return->Person->responseData->data->persons->person->lifeStatus->nameRu;
            echo $response->return->Person->responseData->data->persons->person->lifeStatus->nameKz;
            echo $response->return->Person->responseData->data->persons->person->lifeStatus->changeDate;

            echo $response->return->Person->responseData->data->persons->person->deathCertificate->number;
            echo $response->return->Person->responseData->data->persons->person->deathCertificate->issueOrganisation;

            echo $response->return->Person->responseData->data->persons->person->birthPlace->country->code;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->country->nameRu;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->country->nameKz;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->country->changeDate;

            echo $response->return->Person->responseData->data->persons->person->birthPlace->district->code;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->district->nameRu;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->district->nameKz;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->district->changeDate;

            echo $response->return->Person->responseData->data->persons->person->birthPlace->region->code;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->region->nameRu;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->region->nameKz;
            echo $response->return->Person->responseData->data->persons->person->birthPlace->region->changeDate;

            echo $response->return->Person->responseData->data->persons->person->birthPlace->city;
            
            echo $response->return->Person->responseData->data->persons->person->regAddress->country->code;
            echo $response->return->Person->responseData->data->persons->person->regAddress->country->nameRu;
            echo $response->return->Person->responseData->data->persons->person->regAddress->country->nameKz;
            echo $response->return->Person->responseData->data->persons->person->regAddress->country->changeDate;

            echo $response->return->Person->responseData->data->persons->person->excludeStatus->excludeReason->code;
            echo $response->return->Person->responseData->data->persons->person->excludeStatus->excludeReason->nameRu;
            echo $response->return->Person->responseData->data->persons->person->excludeStatus->excludeReason->nameKz;
            echo $response->return->Person->responseData->data->persons->person->excludeStatus->excludeReason->changeDate;
            echo $response->return->Person->responseData->data->persons->person->excludeStatus->excludeDate;

            //get document details
            foreach($response->return->Person->responseData->data->persons->person->documents->document as $document) {
                echo $document->type->code;
                echo $document->type->nameRu;
                echo $document->type->nameKz;
                echo $document->type->changeDate;
                echo $document->number;
                echo $document->beginDate;
                echo $document->endDate;
                echo $document->issueOrganization->code;
                echo $document->issueOrganization->nameRu;
                echo $document->issueOrganization->nameKz;
                echo $document->issueOrganization->changeDate;
                echo $document->status->code;
                echo $document->status->nameRu;
                echo $document->status->nameKz;
                echo $document->status->changeDate;
                echo $document->surname;
                echo $document->name;
                echo $document->patronymic;
                echo $document->birthDate;
            }
    }
}