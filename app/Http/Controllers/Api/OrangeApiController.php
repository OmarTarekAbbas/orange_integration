<?php
namespace App\Http\Controllers\Api;

use App\OrangeSubUnsub;
use App\OrangeSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class OrangeApiController extends Controller
{
    public function checkStatus(Request $request)
    {
        $msisdn = $request->msisdn;
        $service_id = $request->service_id;

        $subscriber = OrangeSubscribe::where('msisdn', $msisdn)->where('service_id', $service_id)->where('active', 1)->first();

        $action = 'CheckStatus';

        $url = url()->full();

        $log['msisdn'] = $msisdn;
        $log['service_id'] = $service_id;

        if($subscriber){
          $log['subscriber'] = $subscriber->toArray();
        }else{
          $log['subscriber'] = $subscriber;
        }

        $this->log_action($action, $url, $log);

        if ($subscriber) {
            return $subscriber;
        }

        return 0;
    }

    public function orangeWeb(Request $request)
    {
       // send email
      $subject = 'Ivas Send Due Date subscribers to Orange after 6 days';
      $email = 'emad@ivas.com.eg';
      $this->sendMail($subject, $email);

      set_time_limit(1000000000000000000);

        date_default_timezone_set("UTC");

        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId.password.$time_stamp);  // spPassword = MD5(spId + Password + timeStamp)
        $productId = productId;

        $msisdn = $request->msisdn;
        $command = $request->command;
        $bearer = $request->bearer_type;

        $soap_request ='<?xml version="1.0" encoding="UTF-8" standalone="no"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:asp="http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl">
        <soap:Header>
        <RequestSOAPHeader xmlns="http://www.huawei.com.cn/schema/common/v2_1">
        <spId>'.$spId.'</spId>
        <spPassword>'.$sp_password.'</spPassword>
        <timeStamp>'.$time_stamp.'</timeStamp>
        </RequestSOAPHeader>
        </soap:Header>
        <soap:Body>
        <asp:AspActionRequest>
        <CC_Service_Number>'.$productId.'</CC_Service_Number>
        <CC_Calling_Party_Id>'.$msisdn.'</CC_Calling_Party_Id>
        <ON_Selfcare_Command>'.$command.'</ON_Selfcare_Command>
        <ON_Bearer_Type>'.$bearer.'</ON_Bearer_Type>
        </asp:AspActionRequest>
        </soap:Body>
        </soap:Envelope>';




        $header = array(
          "Content-Type: text/xml",
          "Content-Length: ".strlen($soap_request),
      );

    // $URL = "http://10.240.22.41:8310/smsgwws/ASP/";  // testing
     $URL = "http://10.240.22.62:8310/smsgwws/ASP/";  // production

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
            'result_code' => ['start' => '<ON_Result_Code>', 'end' => '</ON_Result_Code>'],
            'bearer_type' => ['start' => '<ON_Bearer_Type>', 'end' => '</ON_Bearer_Type>'],
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

        $orange_web = new OrangeSubUnsub;
        $orange_web->req = $soap_request;
        $orange_web->response = $output;
        $orange_web->spId = $spId;
        $orange_web->sp_password = $sp_password;
        $orange_web->time_stamp = $time_stamp;
        $orange_web->service_number = $productId;
        $orange_web->calling_party_id = $msisdn;
        $orange_web->selfcare_command = $command;
        $orange_web->on_bearer_type = $bearer;
        $orange_web->on_result_code = isset($post_array['result_code'])?$post_array['result_code']:"";

        $OrangeWeb = $orange_web->save();



     /* =================  Orange result_code for sub / unsub api ===================
      0	success
      1	already subscribed
      2	not subscribed
      5	not allowed
      6	account problem
      31	Technical problem
      */
        if(isset($post_array['result_code']) &&  $post_array['result_code'] == 0){
            if ($command == 'SUBSCRIBE') {
                $commandActive = 1;  // sub success
            } elseif ($command == 'UNSUBSCRIBE') {
                $commandActive = 2;  // unsub success
            }


            $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('service_id', $request->service_id)->first();
            if ($orange_subscribe) {
                $orange_subscribe->active = $commandActive;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->type = "WEB";
                $orange_subscribe->save();
            } else {
                $orange_subscribe = new OrangeSubscribe;
                $orange_subscribe->msisdn = $msisdn;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->free = 1;
                $orange_subscribe->active = 1;
                $orange_subscribe->type = "WEB";
                $orange_subscribe->subscribe_due_date = date("Y-m-d", strtotime(date('Y-m-d')." +6 days"));
                $orange_subscribe->service_id = $request->service_id;
                $orange_subscribe->save();
            }
        }

      $result_code =   isset($post_array['result_code'])?$post_array['result_code']:"" ;
        return $result_code ;
    }


    public function sendMail($subject, $email) {

      // send mail
      $message = '<!DOCTYPE html>
        <html lang="en-US">
          <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          </head>
          <body>
            <h2>' . $subject . '</h2>
          </body>
        </html>';

      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From:  ' . $email;
      @mail($email, $subject, $message, $headers);
  }

}
