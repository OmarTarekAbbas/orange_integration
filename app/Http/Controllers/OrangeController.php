<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrangeController extends Controller
{
    public function subscription()
    {
        $client = new \nusoap_client('http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;

        $spId = "000812";
        $spPassword = "90ee4516894a1f0dae7e7c2c13e4c423";
        $timeStamp = date('YmdHis');

        $error = $client->getError();

        $soapHeader = array(
            "RequestSOAPHeader" => array(
                array(
                    "spId" => $spId,
                    "spPassword" => $spPassword,
                    "timeStamp" => $timeStamp
                ),
            ),
        );

        $soapBody = array(
            "asp:AspActionRequest" => array(
                array(
                    "CC_Service_Number" => 2142,
                    "CC_Calling_Party_Id" => "201208138169",
                    "ON_Selfcare_Command" => "BILLINGSUBSCRIBE",
                    "ON_Bearer_Type" => "SMS"
                ),
            ),
        );

        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        $result = $client->call("GetSmsIN", array(
            "soap:Header" => $soapHeader,
            "soap:Body" => $soapBody,
        ));

        if ($client->fault) {
            echo "<h2>Fault</h2><pre>";
            print_r($result);
            echo "</pre>";
        } else {
            $error = $client->getError();
            if ($error) {
                echo "<h2>Error</h2><pre>" . $error . "</pre>";
            } else {
                echo "<h2>Main</h2>";
                print_r($result); // MOResult
            }
        }

        // show soap request and response
        echo "<h2>Request</h2>";
        echo "<pre>" . $client->request . "</pre>";
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';

        echo "<h2>Response</h2>";
        echo "<pre>" . $client->response . "</pre>";
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->responseData, ENT_QUOTES) . '</pre>';
    }

    public function notify()
    {

        $request_ex = '<?xml version="1.0" encoding="utf-8" ?>
        <soapenv:Envelope
        xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <soapenv:Body>
        <ns1:Notification
        xmlns:ns1="http://tempuri.org/">
        <ns1:Action>OPERATORSUBSCRIBE</ns1:Action>
        <ns1:MSISDN>201272033505</ns1:MSISDN>
        <ns1:ServiceID>1000003886</ns1:ServiceID>
        </ns1:Notification>
        </soapenv:Body>
        </soapenv:Envelope>';

        $doc = new \DOMDocument('1.0', 'utf-8');

        $doc->loadXML($request_ex);

        $action = $doc->getElementsByTagName("ns1:Action");

        $status = $action->item(0);

        dd($status);

    }

}
