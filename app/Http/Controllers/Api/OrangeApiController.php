<?php
namespace App\Http\Controllers\Api;

use App\OrangeWeb;
use App\OrangeSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class OrangeApiController extends Controller
{
    public function checkStatus(Request $request)
    {
        $msisdn = $request->msisdn;

        $subscriber = OrangeSubscribe::where('msisdn', $msisdn)->where('active', 1)->first();

        $action = 'CheckStatus';

        $url = url()->full();

        $log['msisdn'] = $msisdn;
        $log['subscriber'] = $subscriber;

        $this->log_action($action, $url, $log);

        if ($subscriber) {
            return 1;
        }

        return 0;
    }

    public function orangeWeb(Request $request)
    {
        date_default_timezone_set("UTC");

        $spId = spId;
        $time_stamp = date('YmdHis');
        $sp_password = MD5($spId . password . $time_stamp); // spPassword = MD5(spId + Password + timeStamp)

        $service = service;

        $msisdn = $request->msisdn;
        $command = $request->command;

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
            "SOAPAction: 'AspActionRequest'",
            "Content-length: " . strlen($soap_request),
        );

        $URL = url('api/subscription_test');

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

        $orange_web = new OrangeWeb;
        $orange_web->req = $soap_request;
        $orange_web->response = $output;
        $orange_web->spId = $spId;
        $orange_web->sp_password = $sp_password;
        $orange_web->time_stamp = $time_stamp;
        $orange_web->service_number = $service;
        $orange_web->calling_party_id = $msisdn;
        $orange_web->selfcare_command = $command;
        $orange_web->on_bearer_type = $bearer;
        $orange_web->on_result_code = $post_array['result_code'];

        $OrangeWeb = $orange_web->save();

        if ($post_array['result_code'] == 0) {
            $orange_subscribe = new OrangeSubscribe;
            $orange_subscribe->msisdn = $msisdn;
            $orange_subscribe->orange_notify_id = $orange_web->id;
            $orange_subscribe->table_name = 'orange_webs';
            if ($command == 'Subscribe') {
                $orange_subscribe->active = 1;
            } elseif ($command == 'Unsubscribe') {
                $orange_subscribe->active = 0;
            }

            $OrangeSubscribe = $orange_subscribe->save();
        }

        return $post_array['result_code'];
    }

}
