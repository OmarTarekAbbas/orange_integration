<?php

namespace App\Http\Controllers;

use App\OrangeSubscribe;
use App\OrangeSubUnsub;
use App\Provision;
use Illuminate\Http\Request;
use App\Constants\OrangeResponseStatus;

class ElforsanController extends Controller
{

    public function elforsan_provision(Request $request)
    {

        date_default_timezone_set("UTC");
        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId . elforsan_password . $time_stamp);

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
        $transactionId = $spId . $time_stamp . rand(10000, 999999);

        $service = elforsan_service;
        // $msisdn = '1277433337';
        // $msisdn = $request->msisdn;
        $msisdn = ltrim($request->msisdn, "20"); // 12xx format

        $operationType = 'addMins';
        $elforsan_sourceId = elforsan_sourceId;

/*

Product ID: 1000004448
Provisioning Service ID: 23, & below is the API details

URL: /provisionService/services/provision
IP: same IP used now for Orange Elkheir
Port: 8310
SPID:006738
Password: (Authentication password + SPID + Timestamp all encrypted using MD-5)
Source ID: 99
TransactionId : SPID+Timestamp+sequence number from 000000 to 999999

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sen="http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL" xmlns:v2="http://www.huawei.com.cn/schema/common/v2_1">
<soapenv:Header>
<v2:RequestSOAPHeader>
<v2:spId>005622</v2:spId>
<v2:spPassword>C22F55D321ED0F6C43C9B9E846EF1A23</v2:spPassword>
<v2:timeStamp>20190717133649</v2:timeStamp>
</v2:RequestSOAPHeader>
</soapenv:Header>
<soapenv:Body>
<sen:sendProvisionMsg>
<transactionId>00562220190717133649221960</transactionId>
<sourceId>55</sourceId>
<msisdn>1277036896</msisdn>
<serviceId>23</serviceId>
<operationType>addMins</operationType>
<createdTime>20190717133649</createdTime>
<msg>
</msg>
</sen:sendProvisionMsg>
</soapenv:Body>
</soapenv:Envelope>

 */

        $soap_request = '<?xml version="1.0" encoding="UTF-8" ?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sen="http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL" xmlns:v2="http://www.huawei.com.cn/schema/common/v2_1">
<soapenv:Header>
<v2:RequestSOAPHeader>
<v2:spId>' . $spId . '</v2:spId>
<v2:spPassword>' . $sp_password . '</v2:spPassword>
<v2:timeStamp>' . $time_stamp . '</v2:timeStamp>
</v2:RequestSOAPHeader>
</soapenv:Header>
<soapenv:Body>
<sen:sendProvisionMsg>
<transactionId>' . $transactionId . '</transactionId>
<sourceId>' . $elforsan_sourceId . '</sourceId>
<msisdn>' . $msisdn . '</msisdn>
<serviceId>' . $service . '</serviceId>
<operationType>' . $operationType . '</operationType>
<createdTime>' . $time_stamp . '</createdTime>
<msg>
</msg>
</sen:sendProvisionMsg>
</soapenv:Body>
</soapenv:Envelope>';

        $header = array(
            "Content-Type: text/xml",
            "Content-Length: " . strlen($soap_request),
        );

        // $URL = "http://10.240.22.41:8310/smsgwws/ASP/";  // testing
        $URL = "http://10.240.22.62:8310/provisionService/services/provision"; // production

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

        if (curl_errno($soap_do)) {
            print curl_error($soap_do);
        } else {
            curl_close($soap_do);
        }

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

        $resultCode = isset($post_array['resultCode']) ? $post_array['resultCode'] : "";

        $orange_provisions = new Request;
        $orange_provisions->req = $soap_request;
        $orange_provisions->response = $output;
        $orange_provisions->spId = $spId;
        $orange_provisions->spPassword = $sp_password;
        $orange_provisions->timeStamp = $time_stamp;
        $orange_provisions->transactionId = $transactionId;
        $orange_provisions->msisdn = $request->msisdn;
        $orange_provisions->serviceId = $service;
        $orange_provisions->operationType = $operationType;
        $orange_provisions->createdTime = $time_stamp;
        $orange_provisions->msg = "";
        $orange_provisions->resultCode = $resultCode;

        $Provision = $this->orange_provisions_store($orange_provisions);

        return $resultCode;
    }

    /*
    // Orange Api to sub or unsub according to command
    1-for cron : it make direct sub and expire free after user enjoy 6days from ivas and 1 day from orange side  => and so command = SUBSCRIBE
    2-for Orange portal to make unsub direct to orange and update status according orange result       => and so command = UNSUBSCRIBE
    3-for ussd_notify  ||  sms_notify  ||  web_notify   =>  when user expire free or unsub before      => and so command = SUBSCRIBE
     */
    public function elforsanOrangeWeb(Request $request)
    {

        set_time_limit(100000);
        date_default_timezone_set("UTC");

        $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('free', 1)->where('service_id', $request->service_id)->first();
        if ($orange_subscribe && $request->command == "UNSUBSCRIBE") { // user still free and need to unsub
            $orange_subscribe->active = 2; // unsub
            $orange_subscribe->free = 0; // unsub
            $orange_subscribe->save();
            return 0;
        }

        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId . elforsan_password . $time_stamp); // spPassword = MD5(spId + elforsan_password + timeStamp)
        $productId = elforsan_productId;

        $msisdn = $request->msisdn;
        $command = $request->command;
        $bearer = $request->bearer_type;

        $soap_request = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:asp="http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl">
        <soap:Header>
        <RequestSOAPHeader xmlns="http://www.huawei.com.cn/schema/common/v2_1">
        <spId>' . $spId . '</spId>
        <spPassword>' . $sp_password . '</spPassword>
        <timeStamp>' . $time_stamp . '</timeStamp>
        </RequestSOAPHeader>
        </soap:Header>
        <soap:Body>
        <asp:AspActionRequest>
        <CC_Service_Number>' . $productId . '</CC_Service_Number>
        <CC_Calling_Party_Id>' . $msisdn . '</CC_Calling_Party_Id>
        <ON_Selfcare_Command>' . $command . '</ON_Selfcare_Command>
        <ON_Bearer_Type>' . $bearer . '</ON_Bearer_Type>
        </asp:AspActionRequest>
        </soap:Body>
        </soap:Envelope>';

        $header = array(
            "Content-Type: text/xml",
            "Content-Length: " . strlen($soap_request),
        );

        // $URL = "http://10.240.22.41:8310/smsgwws/ASP/";  // testing
        $URL = "http://10.240.22.62:8310/smsgwws/ASP/"; // production

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

        if (curl_errno($soap_do)) {
            print curl_error($soap_do);
        } else {
            curl_close($soap_do);
        }

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
        $orange_web->on_result_code = isset($post_array['result_code']) ? $post_array['result_code'] : "";

        $OrangeWeb = $orange_web->save();

        /* =================  Orange result_code for sub / unsub api ===================
        0    success
        1    already subscribed
        2    not subscribed
        5    not allowed
        6    account problem = no balance
        31    Technical problem
         */
        if (isset($post_array['result_code']) && $post_array['result_code'] == 0) {
            if ($command == 'SUBSCRIBE') {
                $commandActive = 1; // sub success
                $free = 1;
            } elseif ($command == 'UNSUBSCRIBE') {
                $commandActive = 2; // unsub success
                $free = 0;
            }

            $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('service_id', $request->service_id)->first();
            if ($orange_subscribe) {
                $orange_subscribe->active = $commandActive;
                $orange_subscribe->free = $free;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->type = strtolower($bearer);
                $orange_subscribe->save();
            } else { // will not accured
                $orange_subscribe = new OrangeSubscribe;
                $orange_subscribe->msisdn = $msisdn;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->free = $free;
                $orange_subscribe->active = $commandActive;
                $orange_subscribe->type = strtolower($bearer);
                $orange_subscribe->subscribe_due_date = date("Y-m-d", strtotime(date('Y-m-d') . " +2 days"));
                $orange_subscribe->service_id = $request->service_id;
                $orange_subscribe->save();
            }
        }

        $result_code = isset($post_array['result_code']) ? $post_array['result_code'] : "";
        return $result_code;
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

    public function testLogin(Request $request)
    {
        if ($request->user_name == user_name && $request->password == test_pasword) {
            session()->put("test_login", $request->user_name);
            return redirect()->route("orange.form");
        }
        return back()->with("faild", "These credentials do not match our records");
    }

    public function directSubOrangeWeb(Request $request)
    {
        if (!(session()->has("test_login") && session("test_login") == user_name)) {
            return redirect()->route("orange.login");
        }

        // default values
        $bearer = "WEB";
        $service_id = productId  ;
        $phone_number = ltrim($request->msisdn, 0);
        $request->msisdn = "20$phone_number";
        $msisdn = "20$phone_number";
        $command = $request->command;


        $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('free', 1)->where('service_id', $service_id)->first();
        if ($orange_subscribe && $request->command == "UNSUBSCRIBE") { // user still free and need to unsub
            $orange_subscribe->active = 2; // unsub
            $orange_subscribe->free = 0; // unsub
            $orange_subscribe->save();
            $flash_message = "لقد تم الغاء الاشتراك بنجاح ";
            return back()->with("success", $flash_message);
        }

        set_time_limit(100000);
        date_default_timezone_set("UTC");

        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId . password . $time_stamp); // spPassword = MD5(spId + Password + timeStamp)
        $productId = productId;

        $msisdn = $request->msisdn;
        $command = $request->command;

        $soap_request = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:asp="http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl">
        <soap:Header>
        <RequestSOAPHeader xmlns="http://www.huawei.com.cn/schema/common/v2_1">
        <spId>' . $spId . '</spId>
        <spPassword>' . $sp_password . '</spPassword>
        <timeStamp>' . $time_stamp . '</timeStamp>
        </RequestSOAPHeader>
        </soap:Header>
        <soap:Body>
        <asp:AspActionRequest>
        <CC_Service_Number>' . $productId . '</CC_Service_Number>
        <CC_Calling_Party_Id>' . $msisdn . '</CC_Calling_Party_Id>
        <ON_Selfcare_Command>' . $command . '</ON_Selfcare_Command>
        <ON_Bearer_Type>' . $bearer . '</ON_Bearer_Type>
        </asp:AspActionRequest>
        </soap:Body>
        </soap:Envelope>';

        $header = array(
            "Content-Type: text/xml",
            "Content-Length: " . strlen($soap_request),
        );

        // $URL = "http://10.240.22.41:8310/smsgwws/ASP/";  // testing
        $URL = "http://10.240.22.62:8310/smsgwws/ASP/"; // production

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

        if (curl_errno($soap_do)) {
            print curl_error($soap_do);
        } else {
            curl_close($soap_do);
        }

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
        $orange_web->on_result_code = isset($post_array['result_code']) ? $post_array['result_code'] : "";

        $OrangeWeb = $orange_web->save();

        /* =================  Orange result_code for sub / unsub api ===================
        0    success
        1    already subscribed
        2    not subscribed
        5    not allowed
        6    account problem = no balance
        31    Technical problem
         */
        if (isset($post_array['result_code']) && $post_array['result_code'] == 0) {
            if ($command == 'SUBSCRIBE') {
                $commandActive = 1; // sub success
                $free = 1;
                $flash_message = "لقد تم الاشتراك بنجاح";
            } elseif ($command == 'UNSUBSCRIBE') {
                $commandActive = 2; // unsub success
                $free = 0;
                $flash_message = "لقد تم الغاء الاشتراك بنجاح ";
            }

            $orange_subscribe = OrangeSubscribe::where('msisdn', $request->msisdn)->where('service_id', $service_id)->first();
            if ($orange_subscribe) {
                $orange_subscribe->active = $commandActive;
                $orange_subscribe->free = $free;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->type = strtolower($bearer);
                $orange_subscribe->save();
            } else { // will not accured
                $orange_subscribe = new OrangeSubscribe;
                $orange_subscribe->msisdn = $msisdn;
                $orange_subscribe->orange_channel_id = $orange_web->id;
                $orange_subscribe->table_name = 'orange_sub_unsubs';
                $orange_subscribe->free = $free;
                $orange_subscribe->active = $commandActive;
                $orange_subscribe->type = strtolower($bearer);
                $orange_subscribe->subscribe_due_date = date("Y-m-d", strtotime(date('Y-m-d') . " +2 days"));
                $orange_subscribe->service_id = $service_id;
                $orange_subscribe->save();
            }
        }


        $result_code =   isset($post_array['result_code']) ? $post_array['result_code'] : "error" ;
        if(isset($flash_message) && $flash_message != ''){
          session()->flash('success', $flash_message);
        } else {
          session()->flash('warning', OrangeResponseStatus::getLabel($result_code));
        }
        return back();
      }



    public function checkStatus(){
      if(!(session()->has("test_login") && session("test_login") == user_name)) {
        return redirect()->route("orange.login");
      }

      return view('orange.check_status');
    }

    public function checkStatusAction(Request $request)
    {

        $service_id = productId  ;
        $phone_number = ltrim($request->msisdn, 0);
        $msisdn = "20$phone_number";

        $subscriber = OrangeSubscribe::where('msisdn', $msisdn)->where('service_id', $service_id)->first();

        if(isset($subscriber) && $subscriber!=null){
          $subscriber = $subscriber;
        }else{
          $subscriber = [];
        }

        //register log
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

        return view('orange.check_status', compact('subscriber'));
    }

  public function alforsan_export_today_active_phonenumbers()
  {
    set_time_limit(0);
    ini_set('memory_limit', -1);

    $file = 'alforsan_' . date("d-m-Y") . '.txt';
    $file_object = fopen($file, "w") or die("Unable to open file!");
    fwrite($file_object, "phone_number \n");
    $this->alforsan_send_today_content_export_phonenumbers($file_object);
    fclose($file_object);

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/plain");
    readfile($file);

    echo "Today Content Phonenumbers Exported Successfully.";
  }

  public function alforsan_send_today_content_export_phonenumbers($file_object)
  {
    OrangeSubscribe::where("active", 1)->chunk(50000, function ($orange_subscribes) use ($file_object) {

      foreach ($orange_subscribes as $orange_subscribe) {

        //create file of phone numbers
        fwrite($file_object, ltrim($orange_subscribe->msisdn, '2') . "\n");
      }
    });

    return true;
  }

  public function alforsan_get_today_content()
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => ORANGEGETTODAYCONTENTLINK,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 100,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET'
    ));
    $orange_today_link = curl_exec($curl);
    curl_close($curl);

    return  $orange_today_link ? $orange_today_link : URL_ELFORSAN;
  }

  public function alforsan_send_daily_deduction_message(){
    return "سوف يتم خصم 1 جنيه  فى اليوم، واستهلاك الإنترنت سوف يخصم من الباقة الخاصة بك، ولإلغاء الإشتراك ارسل 0215 إلى 6124 مجانا.";
  }

}
