<?php

namespace App\Http\Controllers;

use App\OrangeSms;
use App\OrangeWeb;
use App\Provision;
use Carbon\Carbon;
use App\OrangeUssd;
use Monolog\Logger;
use App\TodayMessage;
use App\OrangeCharging;
use App\OrangeSubUnsub;
use App\OrangeSubscribe;
use App\OrangeWhitelist;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\File;
use App\Constants\OrangeResponseStatus;
use App\Http\Controllers\Api\OrangeApiController;
use App\Http\Requests\Request as RequestsRequest;

class ElforsanController extends Controller
{

    public function elforsan_provision(Request $request)
    {

      date_default_timezone_set("UTC") ;
      $elforsan_spId = spId;
      $time_stamp = date('YmdHis');
      $sp_password = MD5($elforsan_spId.password.$time_stamp);

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
      $msisdn = '201223872695';

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
          "Content-Type: text/xml",
          "Content-Length: ".strlen($soap_request),
      );

    // $URL = "http://10.240.22.41:8310/smsgwws/ASP/";  // testing
     $URL = "http://10.240.22.62:8310/provisionService/services/provision";  // production

    //  $f = fopen('request.txt', 'w');
      $soap_do = curl_init();
      curl_setopt($soap_do, CURLOPT_URL, $URL);
      curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 1000000000000000000);
      curl_setopt($soap_do, CURLOPT_TIMEOUT, 1000000000000000000);
      curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
   //   curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($soap_do, CURLOPT_POST, true);
      curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
      curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
    //  curl_setopt($soap_do, CURLOPT_VERBOSE, 1);  // show curl connect
    //  curl_setopt($soap_do, CURLOPT_STDERR, $f);

      $output = curl_exec($soap_do);

      if(curl_errno($soap_do))
      print curl_error($soap_do);
  else
      curl_close($soap_do);

        $request_array = array(
            'resultCode' => ['start' => '<resultCode>', 'end' => '</resultCode>'],
            'resultDescription' => ['start' => '<resultDescription>', 'end' => '</resultDescription>'],
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




      $resultCode =   isset($post_array['resultCode'])?$post_array['resultCode']:"" ;
        return $resultCode ;
    }
}