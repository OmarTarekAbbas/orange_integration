<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\OrangeApiController;
use App\Http\Requests\Request as RequestsRequest;
use App\OrangeCharging;
use App\OrangeSubscribe;
use App\OrangeUssd;
use App\OrangeSms;
use App\OrangeWeb;
use App\OrangeSubUnsub;
use Illuminate\Http\Request;
use App\Provision;

class OrangeController extends Controller
{

    public function subscription_response_test(Request $request)
    {
        return '<?xml version="1.0" encoding="utf-8" ?>
        <soapenv:Envelope
        xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <soapenv:Body>
        <ns1:AspActionResult
        xmlns:ns1="http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl">
        <ON_Result_Code>0</ON_Result_Code>
        <ON_Bearer_Type>SMS</ON_Bearer_Type>
        </ns1:AspActionResult>
        </soapenv:Body>
        </soapenv:Envelope>';
    }

    public function provision_response_test(Request $request)
    {
        return '<?xml version="1.0" encoding="utf-8" ?>
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sen="http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL">
   <soapenv:Header/>
   <soapenv:Body>
      <sen:sendProvisionMsgResponse>
         <resultCode>00000000</resultCode>
         <resultDescription>Success</resultDescription>
         <msg><![CDATA[<?xml version="1.0" encoding="UTF-8"?><userInfo>  <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>
         <extensionInfo>
            <item>
               <key>k1</key>
               <value>value0</value>
            </item>
            <item>
               <key>k2</key>
               <value>value1</value>
            </item>
         </extensionInfo>
      </sen:sendProvisionMsgResponse>
   </soapenv:Body>
</soapenv:Envelope>';
    }

    public function provision_curl(Request $request)
    {
        /*  Provision request sample
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sen="http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL">
   <soapenv:Header>
      <v2:RequestSOAPHeader>
         <v2:spId>000201</v2:spId>
         <v2:spPassword>e6434ef249df55c7a21a0b45758a39bb</v2:spPassword>
         <v2:timeStamp>20100731064245</v2:timeStamp>
      </v2:RequestSOAPHeader>
   </soapenv:Header>
   <soapenv:Body>
      <sen:sendProvisionMsg>
         <transactionId>350000012014032909253000001</transactionId>
         <sourceId>bob</sourceId>
         <msisdn>1234567</msisdn>
         <serviceId>12231314</serviceId>
         <operationType>setUserInfo</operationType>
         <createdTime>20150116103330</createdTime>
         <msg><![CDATA[<?xml version="1.0" encoding="UTF-8"?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>
         <callBackData>abc</callBackData>
         <extensionInfo>
            <item>
               <key>k1</key>
               <value>value0</value>
            </item>
            <item>
               <key>k2</key>
               <value>value1</value>
            </item>
         </extensionInfo>
      </sen:sendProvisionMsg>
   </soapenv:Body>
</soapenv:Envelope>

        */
        date_default_timezone_set("UTC") ;
        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId.password.$time_stamp);

        $partnerId = partnerId;
        /*
                Transaction identifier of a session. It must be unique among the requests from the partner.
                the formula suggested: partnerId+timestamp+sequence
                partnerId is the identifier of the partner allocated by SDP.
                timeStamp is generated according the current UTC time and format as yyyyMMddHHmmss
                sequence is the serial number,  the range is from 00000 to 99999

                Example:
                35000001 20140329092530 00001

        */
        $transactionId = $partnerId.$time_stamp.rand(10000 , 99999);

        $service = service;
        $msisdn = '201208138169';

        $message = 'setUserInfo';

        $msg = "<![CDATA[<?xml version='1.0' encoding='UTF-8'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]>";

        $soap_request =
"<?xml version='1.0' encoding='UTF-8'?>
<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:sen='http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL'>
   <soapenv:Header>
      <v2:RequestSOAPHeader>
         <v2:spId>$spId</v2:spId>
         <v2:spPassword>$sp_password</v2:spPassword>
         <v2:timeStamp>$time_stamp</v2:timeStamp>
      </v2:RequestSOAPHeader>
   </soapenv:Header>
   <soapenv:Body>
      <sen:sendProvisionMsg>
         <transactionId>$transactionId</transactionId>
         <sourceId>bob</sourceId>
         <msisdn>$msisdn</msisdn>
         <serviceId>$service</serviceId>
         <operationType>$message</operationType>
         <createdTime>$time_stamp</createdTime>
         <msg>$msg</msg>
         <callBackData>abc</callBackData>
         <extensionInfo>
            <item>
               <key>k1</key>
               <value>value0</value>
            </item>
            <item>
               <key>k2</key>
               <value>value1</value>
            </item>
         </extensionInfo>
      </sen:sendProvisionMsg>
   </soapenv:Body>
</soapenv:Envelope>";

        $header = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: 'sendProvisionMsg'",
            "Content-length: " . strlen($soap_request),
        );

        $URL = url('api/provision_test');

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $URL);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

        $output = curl_exec($soap_do);

        curl_close($soap_do);

        $request_array = array(
            'result_code' => ['start' => '<resultCode>', 'end' => '</resultCode>'],
        );

        $string = $output;

        foreach ($request_array as $key => $value) {
            $start = $value['start'];
            $end = $value['end'];

            $startpos = strpos($string, $start) + strlen($start);
            if (strpos($string, $start) !== false) {
                $endpos = strpos($string, $end, $startpos);
                if (strpos($string, $end, $startpos) !== false) {
                    $post_array[$key] = substr($string, $startpos, $endpos - $startpos);
                } else {
                    $post_array[$key] = "";
                }
            }
        }

        $orange_provisions = new Request;
        $orange_provisions->req = $soap_request;
        $orange_provisions->response = $output;
        $orange_provisions->spId = $spId;
        $orange_provisions->spPassword = $sp_password;
        $orange_provisions->timeStamp = $time_stamp;
        $orange_provisions->transactionId = $transactionId;
        $orange_provisions->msisdn = $msisdn;
        $orange_provisions->serviceId = $service;
        $orange_provisions->operationType = $message;
        $orange_provisions->createdTime = $time_stamp;
        $orange_provisions->msg = $msg;
        $orange_provisions->resultCode = $post_array['result_code'];

        $Provision = $this->orange_provisions_store($orange_provisions);

        return  $output;

    }

    public function subscription_curl(Request $request)
    {

            /*      Subscription Request Sample

            POST /smsgwws/ASP/ HTTP/1.1
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

        date_default_timezone_set("UTC") ;

        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId.password.$time_stamp);  // spPassword = MD5(spId + Password + timeStamp)

        $service = service;
        $msisdn = '201208138169';
        $command = 'Subscribe';
       // $command = 'Unsubscribe';
        $bearer = 'SMS';

        $soap_request =
"<?xml version='1.0' encoding='UTF-8'?>
<soap:Envelope xmlns:soap='http://www.w3.org/2003/05/soap-envelope' xmlns:asp='http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl'>
<soap:Header>
<RequestSOAPHeader xmlns='http://www.huawei.com.cn/schema/common/v2_1'>
<spId>$spId</spId>
<spPassword>$sp_password</spPassword>
<timeStamp>$time_stamp</timeStamp>
</RequestSOAPHeader>
</soap:Header>
<soap:Body>
<asp:AspActionRequest>
<CC_Service_Number>$service</CC_Service_Number>
<CC_Calling_Party_Id>$msisdn</CC_Calling_Party_Id>
<ON_Selfcare_Command>$command</ON_Selfcare_Command>
<ON_Bearer_Type>$bearer</ON_Bearer_Type>
</asp:AspActionRequest>
</soap:Body>
</soap:Envelope>";

        $header = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
           "SOAPAction: 'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl/AspActionRequest'",    // AspActionRequest
            "Content-length: " . strlen($soap_request),
        );

        $URL = "http://10.240.22.41:8310/smsgwws/ASP";

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $URL);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);




        // to dump request
      $f = fopen('request.txt', 'w');
      curl_setopt_array($soap_do, array(
          CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_FOLLOWLOCATION => 1,
          CURLOPT_VERBOSE => 1,
          CURLOPT_STDERR => $f,
      ));


        $output = curl_exec($soap_do);

      //  var_dump($output) ;die;

        // test Orange link by curl
      //   if (curl_errno($soap_do)) {
      //     $error_msg = curl_error($soap_do);
      //  //  echo "error = ".$error_msg ; die;
      //     $output =  $error_msg ;
      // }
     // echo $error_msg ; die;
      //  Could not resolve host: smsgwpusms
      /*
      Yousef error :
wsdl error: Getting http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl - HTTP ERROR: Couldn't open socket connection to server http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl prior to connect().  This is often a problem looking up the hostname.


*/


        curl_close($soap_do);


        $request_array = array(
            'result_code' => ['start' => '<ON_Result_Code>', 'end' => '</ON_Result_Code>'],
            'bearer_type' => ['start' => '<ON_Bearer_Type>', 'end' => '</ON_Bearer_Type>']
        );

        $string = $output;

        foreach ($request_array as $key => $value) {
            $start = $value['start'];
            $end = $value['end'];

            $startpos = strpos($string, $start) + strlen($start);
            if (strpos($string, $start) !== false) {
                $endpos = strpos($string, $end, $startpos);
                if (strpos($string, $end, $startpos) !== false) {
                    $post_array[$key] = substr($string, $startpos, $endpos - $startpos);
                } else {
                    $post_array[$key] = "";
                }
            }
        }

        $orange_web = new request;
        $orange_web->req = $soap_request;
        $orange_web->response = $output;
        $orange_web->spId = $spId;
        $orange_web->sp_password = $sp_password;
        $orange_web->time_stamp = $time_stamp;
        $orange_web->service_number = $service;
        $orange_web->calling_party_id = $msisdn;
        $orange_web->selfcare_command = $command;
        $orange_web->on_bearer_type = $bearer;
        $orange_web->on_result_code = isset($post_array['result_code'])?$post_array['result_code']:"";

        $OrangeWeb = $this->orange_web_store($orange_web);

        if(isset($post_array['result_code']) &&  $post_array['result_code'] == 0){
            $orange_subscribe = new Request();
            $orange_subscribe->msisdn = $msisdn;
            $orange_subscribe->orange_channel_id = $OrangeWeb->id;
            $orange_subscribe->table_name = 'orange_webs';
            if($command == 'Subscribe'){
                $orange_subscribe->active = 1;
            }elseif($command == 'Unsubscribe'){
                $orange_subscribe->active = 0;
            }

            $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);
        }

        // return $post_array['result_code'];
        var_dump($output);

    }



    public function subscription_curl_emad(Request $request)
    {


      date_default_timezone_set("UTC") ;

      $spId = spId;
      $time_stamp = date('YmdHis');
      $sp_password = MD5($spId.password.$time_stamp);  // spPassword = MD5(spId + Password + timeStamp)

      $service = service;
      $msisdn = '201208138169';
      $command = 'Subscribe';
     // $command = 'Unsubscribe';
      $bearer = 'SMS';

      $soap_request =
"<?xml version='1.0' encoding='UTF-8'?>
<soap:Envelope xmlns:soap='http://www.w3.org/2003/05/soap-envelope' xmlns:asp='http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl'>
<soap:Header>
<RequestSOAPHeader xmlns='http://www.huawei.com.cn/schema/common/v2_1'>
<spId>$spId</spId>
<spPassword>$sp_password</spPassword>
<timeStamp>$time_stamp</timeStamp>
</RequestSOAPHeader>
</soap:Header>
<soap:Body>
<asp:AspActionRequest>
<CC_Service_Number>$service</CC_Service_Number>
<CC_Calling_Party_Id>$msisdn</CC_Calling_Party_Id>
<ON_Selfcare_Command>$command</ON_Selfcare_Command>
<ON_Bearer_Type>$bearer</ON_Bearer_Type>
</asp:AspActionRequest>
</soap:Body>
</soap:Envelope>";


      $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://10.240.22.41:8310/smsgwws/ASP',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $soap_request,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: text/xml'
  ),
));

$output = curl_exec($curl);

curl_close($curl);
//  echo $response;

$request_array = array(
  'result_code' => ['start' => '<ON_Result_Code>', 'end' => '</ON_Result_Code>'],
  'bearer_type' => ['start' => '<ON_Bearer_Type>', 'end' => '</ON_Bearer_Type>']
);

$string = $output;

foreach ($request_array as $key => $value) {
  $start = $value['start'];
  $end = $value['end'];

  $startpos = strpos($string, $start) + strlen($start);
  if (strpos($string, $start) !== false) {
      $endpos = strpos($string, $end, $startpos);
      if (strpos($string, $end, $startpos) !== false) {
          $post_array[$key] = substr($string, $startpos, $endpos - $startpos);
      } else {
          $post_array[$key] = "";
      }
  }
}

$orange_web = new request;
$orange_web->req = $soap_request;
$orange_web->response = $output;
$orange_web->spId = $spId;
$orange_web->sp_password = $sp_password;
$orange_web->time_stamp = $time_stamp;
$orange_web->service_number = $service;
$orange_web->calling_party_id = $msisdn;
$orange_web->selfcare_command = $command;
$orange_web->on_bearer_type = $bearer;
$orange_web->on_result_code = isset($post_array['result_code'])?$post_array['result_code']:"";

$OrangeWeb = $this->orange_web_store($orange_web);

if(isset($post_array['result_code']) &&  $post_array['result_code'] == 0){
  $orange_subscribe = new Request();
  $orange_subscribe->msisdn = $msisdn;
  $orange_subscribe->orange_channel_id = $OrangeWeb->id;
  $orange_subscribe->table_name = 'orange_webs';
  if($command == 'Subscribe'){
      $orange_subscribe->active = 1;
  }elseif($command == 'Unsubscribe'){
      $orange_subscribe->active = 0;
  }

  $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);
}

// return $post_array['result_code'];
var_dump($output) ;



    }

    public function subscription()
    {

    /*      Subscription Request Sample

    POST /smsgwws/ASP/ HTTP/1.1
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
        date_default_timezone_set("UTC") ;
        $client = new \nusoap_client('http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;

            $spId = spId;
            $timeStamp = date('YmdHis');
            $spPassword = MD5($spId.password.$timeStamp);


        $client->setHeaders('<spId>'.$spId .'</spId>
        <spPassword>'.$spPassword.'</spPassword>
        <timeStamp>'.$timeStamp.'</timeStamp>');

        // $error = $client->getError();

        $soapBody = array(
            "CC_Service_Number" => service,
            "CC_Calling_Party_Id" => "201208138169",
            "ON_Selfcare_Command" => "Subscribe",   // Subscribe     Unsubscribe
            "ON_Bearer_Type" => "SMS",
        );

        // if ($error) {
        //     echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        // }

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

    public function ussd_notify()
    {
        $header = apache_request_headers();

        foreach ($header as $headers => $value) {
            $request_array[$headers] = $value;
        }

     //  print_r($request_array); die;

        if(isset($request_array['User-MSISDN'])){
          $msisdn=   ltrim($request_array['User-MSISDN'], 'tel:+');
        }elseif(isset($request_array['User-Msisdn'])){
          $msisdn=   ltrim($request_array['User-Msisdn'], 'tel:+');
        }else{
          $msisdn= "" ;
        }


        if(isset($request_array['User-SessionId'])){
          $User_SessionId =  $request_array['User-SessionId'];
        }elseif(isset($request_array['User-Sessionid'])){
          $User_SessionId =  $request_array['User-Sessionid'];
        }else{
          $User_SessionId = "" ;
        }




        $response_msg = 'سوف يتم الاشتراك قريبا';

        $response_xml = '<?xml version="1.0" encoding="UTF - 8" ?><html><head><meta name="nav" content="end"></head><body>' . $response_msg . '</body></html>';

        $orange_ussd = new Request();
        $orange_ussd->req = json_encode($header);
        $orange_ussd->response = $response_xml;
        $orange_ussd->language = isset($request_array['User-Language'])?$request_array['User-Language']:"";
        $orange_ussd->msisdn = $msisdn;
        $orange_ussd->session_id = $User_SessionId;
        $orange_ussd->host =isset( $request_array['Host'])? $request_array['Host']:"";

        $OrangeUssd = $this->orange_ussd_store($orange_ussd);

        $orange_subscribe = new Request();
        $orange_subscribe->msisdn = $msisdn;
        $orange_subscribe->orange_channel_id = $OrangeUssd->id;
        $orange_subscribe->table_name = 'orange_ussds';
        $orange_subscribe->type = 'ussd';
        $orange_subscribe->bearer_type = 'USSD';
        $orange_subscribe->service_id = isset($request_array['Service-Id'])?$request_array['Service-Id']:0;

        $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);

        return $response_xml;

    }

    public function sms_notify(Request $request)
    {
         $orangeSms = new OrangeSms();
         $orangeSms->msisdn      = $request->msisdn;
         $orangeSms->message     = $request->message;
         $orangeSms->service_id  = $request->message;
         $orangeSms->save();

        $orange_subscribe = new Request();
        $orange_subscribe->msisdn = $request->msisdn;
        $orange_subscribe->table_name = 'orange_sms';
        $orange_subscribe->orange_channel_id = $orangeSms->id;
        $orange_subscribe->type = 'sms';
        $orange_subscribe->bearer_type = 'SMS';
        $orange_subscribe->service_id = $request->message;

        $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);
    }

    public function web_notify(Request $request)
    {
         $orangeWeb = new orangeWeb();
         $orangeWeb->msisdn      = $request->msisdn;
         $orangeWeb->service_id  = $request->service_id;
         $orangeWeb->save();

        $orange_subscribe = new Request();
        $orange_subscribe->msisdn = $request->msisdn;
        $orange_subscribe->table_name = 'orange_web';
        $orange_subscribe->orange_channel_id = $orangeWeb->id;
        $orange_subscribe->type = 'web';
        $orange_subscribe->bearer_type = 'WEB';
        $orange_subscribe->service_id = $request->service_id;

        $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);
        return  $OrangeSubscribe ;

    }

    public function charging_notify(Request $request)
    {

      /*
      //    Notify request sample //

      POST /BillingEngine/RenewalService HTTP/1.1
      SOAPAction: ""
      Content-Type: text/xml; charset=UTF-8
      Host: 10.57.221.2:80
      Connection: close
      Content-Length: 406

      <?xml version="1.0" encoding="utf-8" ?>
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
      </soapenv:Envelope>
      */

        $request_xml = file_get_contents('php://input');

        $request_array = array(
            'action' => ['start' => '<ns1:Action>', 'end' => '</ns1:Action>'],
            'msisdn' => ['start' => '<ns1:MSISDN>', 'end' => '</ns1:MSISDN>'],
            'service_id' => ['start' => '<ns1:ServiceID>', 'end' => '</ns1:ServiceID>'],
        );

        $string = $request_xml;

        foreach ($request_array as $key => $value) {
            $start = $value['start'];
            $end = $value['end'];

            $startpos = strpos($string, $start) + strlen($start);
            if (strpos($string, $start) !== false) {
                $endpos = strpos($string, $end, $startpos);
                if (strpos($string, $end, $startpos) !== false) {
                    $post_array[$key] = substr($string, $startpos, $endpos - $startpos);
                } else {
                    $post_array[$key] = "";
                }
            }
        }

        $response_xml = '<?xml version = "1.0" encoding ="utf-8"?>
        <soap:Envelope
            xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"
            xmlns:xsi = "http://www.w3.org/2001/XMLSchema-instance"
            xmlns:xsd = "http://www.w3.org/2001/XMLSchema">
            <soap:Body>
                <NotificationResponse
                    xmlns="http://tempuri.org/">
                    <NotificationResult>200</NotificationResult>
                </NotificationResponse>
            </soap:Body>
        </soap:Envelope>';

        $orange_notify = new Request();
        $orange_notify->req = $request_xml;
        $orange_notify->response = $response_xml;
        $orange_notify->action = $post_array['action'];
        $orange_notify->msisdn = $post_array['msisdn'];
        $orange_notify->service_id = $post_array['service_id'];
        $orange_notify->notification_result = 200;

        $OrangeNotify = $this->orange_notify_store($orange_notify);

        $orange_subscribe = new Request();
        $orange_subscribe->msisdn = $post_array['msisdn'];
        $orange_subscribe->orange_channel_id = $OrangeNotify->id;
        $orange_subscribe->table_name = 'orange_chargings';
        $orange_subscribe->service_id = $post_array['service_id'];
        $orange_subscribe->type = "charging";

        if ($post_array['action'] == "OPERATORSUBSCRIBE" || $post_array['action'] == "GRACE1" || $post_array['action'] == "OUTOFGRACE") {
            $orange_subscribe->active = 1;
        } elseif ($post_array['action'] == "GRACE2") {
            $orange_subscribe->active = 0;
        } elseif ($post_array['action'] == "TERMINATE" || $post_array['action'] == "OPERATORUNSUBSCRIBE") {
            $orange_subscribe->active = 2;
        }

        $OrangeSubscribe = $this->orange_subscribe_store($orange_subscribe);

        return $response_xml;

    }

    public function orange_notify_store(Request $request)
    {
        $orange_notify = new OrangeCharging;
        $orange_notify->req = $request->req;
        $orange_notify->response = $request->response;
        $orange_notify->action = $request->action;
        $orange_notify->msisdn = $request->msisdn;
        $orange_notify->service_id = $request->service_id;
        $orange_notify->notification_result = $request->notification_result;
        $orange_notify->save();
        return $orange_notify;
    }

    public function orange_web_store(Request $request)
    {
        $orange_web = new OrangeSubUnsub;
        $orange_web->req = $request->req;
        $orange_web->response = $request->response;
        $orange_web->spId = $request->spId;
        $orange_web->sp_password = $request->sp_password;
        $orange_web->time_stamp = $request->time_stamp;
        $orange_web->service_number = $request->service_number;
        $orange_web->calling_party_id = $request->calling_party_id;
        $orange_web->selfcare_command = $request->selfcare_command;
        $orange_web->on_bearer_type = $request->on_bearer_type;
        $orange_web->on_result_code = $request->on_result_code;
        $orange_web->save();
        return $orange_web;
    }

    public function orange_subscribe_store(Request $request)
    {
        $response = "";
        $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('service_id', $request->service_id)->first();

        if ($orange_subscribe) {
            $orange_subscribe->orange_channel_id = $request->orange_channel_id;
            $orange_subscribe->table_name = $request->table_name;
            $orange_subscribe->type = $request->type;


          if($orange_subscribe->active  == 2) { // unsub and needed to charge again
            $response = $this->directSubscribe($request);

            if($response == 0) {
              $orange_subscribe->active = 1;
            } else {
              $orange_subscribe->active = 0;
            }


          }
          $orange_subscribe->save();
        } else {
            $orange_subscribe = new OrangeSubscribe;
            $orange_subscribe->msisdn = $request->msisdn;
            $orange_subscribe->active = 1;
            $orange_subscribe->orange_channel_id = $request->orange_channel_id;
            $orange_subscribe->table_name = $request->table_name;
            $orange_subscribe->type = $request->type;
            if($request->type == "charging"){
              $orange_subscribe->subscribe_due_date = date("Y-m-d");
              $orange_subscribe->free = 0;
            } else {
              $orange_subscribe->subscribe_due_date = date("Y-m-d", strtotime(date('Y-m-d')." +2 days"));
              $orange_subscribe->free = 1;
            }
            $orange_subscribe->service_id = $request->service_id;
            $orange_subscribe->save();
        }
        return $response;
    }

    public function directSubscribe($request)
    {
      $orange_sub = new Request();
      $orange_sub->msisdn     = $request->msisdn;
      $orange_sub->command    =  'Subscribe';
      $orange_sub->service_id =  $request->service_id;
      $orange_sub->bearer_type=  $request->bearer_type ;

      $orandControl = new OrangeApiController();
      return $orandControl->orangeWeb($orange_sub);
    }

    public function orange_ussd_store(Request $request)
    {
        $orange_ussd = new OrangeUssd;
        $orange_ussd->req = $request->req;
        $orange_ussd->response = $request->response;
        $orange_ussd->language = $request->language;
        $orange_ussd->msisdn = $request->msisdn;
        $orange_ussd->session_id = $request->session_id;
        $orange_ussd->host = $request->host;
        $orange_ussd->save();
        return $orange_ussd;
    }

    public function orange_provisions_store(Request $request)
    {
        $orange_provisions = new Provision;
        $orange_provisions->req = $request->req;
        $orange_provisions->response = $request->response;
        $orange_provisions->spId = $request->spId;
        $orange_provisions->spPassword = $request->spPassword;
        $orange_provisions->timeStamp = $request->timeStamp;
        $orange_provisions->transactionId = $request->transactionId;
        $orange_provisions->msisdn = $request->msisdn;
        $orange_provisions->serviceId = $request->serviceId;
        $orange_provisions->operationType = $request->operationType;
        $orange_provisions->createdTime = $request->createdTime;
        $orange_provisions->msg = $request->msg;
        $orange_provisions->resultCode = $request->resultCode;
        $orange_provisions->save();
        return $orange_provisions;
    }

}
