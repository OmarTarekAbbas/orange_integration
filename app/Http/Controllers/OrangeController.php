<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrangeController extends Controller
{


/*POST /smsgwws/ASP/ HTTP/1.1
Content-Type: text/xml; charset=utf-8
Host: 10.240.22.40:8310
Content-Length: 671
Expect: 100-continue
<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope
xmlns:soap="http://www.w3.org/2003/05/soap-envelope"
xmlns:asp="http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl">
<soap:Header>
<RequestSOAPHeader
xmlns="http://www.huawei.com.cn/schema/common/v2_1">
<spId>000812</spId>
<spPassword>90ee4516894a1f0dae7e7c2c13e4c423</spPassword>
<timeStamp>20191128150121</timeStamp>
</RequestSOAPHeader>
</soap:Header>
<soap:Body>
<asp:AspActionRequest>
<CC_Service_Number>2142</CC_Service_Number>
<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>
<ON_Selfcare_Command>BILLINGSUBSCRIBE</ON_Selfcare_Command>
<ON_Bearer_Type>SMS</ON_Bearer_Type>
</asp:AspActionRequest>
</soap:Body>
</soap:Envelope>
*/
    public function subscription()
    {
        $client = new \nusoap_client('http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;

        $spId = "000812";
        $spPassword = "90ee4516894a1f0dae7e7c2c13e4c423";
        $timeStamp = date('YmdHis');

        $client->setHeaders('<spId>000812</spId>
        <spPassword>90ee4516894a1f0dae7e7c2c13e4c423</spPassword>
        <timeStamp>20191128150121</timeStamp>');

        $error = $client->getError();

        // $soapHeader = array(
        //     "RequestSOAPHeader" => array(
        //         array(
        //             "spId" => $spId,
        //             "spPassword" => $spPassword,
        //             "timeStamp" => $timeStamp
        //         ),
        //     ),
        // );

        $soapBody = array(
                    "CC_Service_Number" => 2142,
                    "CC_Calling_Party_Id" => "201208138169",
                    "ON_Selfcare_Command" => "BILLINGSUBSCRIBE",
                    "ON_Bearer_Type" => "SMS"
        );

        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        $result = $client->call("AspActionRequest", $soapBody);

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

    public function notify(Request $request)
    {
        dd($request->all());
        $request_ex = '';

        $doc = new \DOMDocument('1.0', 'utf-8');

        $doc->loadXML($request_ex);

        $action = $doc->getElementsByTagName("ns1:Action");

        $status = $action->item(0);

        dd($status);

    }

}
