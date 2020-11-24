<?php

namespace App\Http\Controllers;

use Validator;
use App\Notify;
use App\Message;
use App\Service;
use App\MTMsisdn;
use App\OutRequest;
use App\Subscriber;
use Monolog\Logger;
use App\Unsubscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\File;

class TimeweController extends Controller
{
    public function notificationMo(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }

        $partnerRoleId = $partnerRole;

        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'text' => 'required',
            'msisdn' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            //  'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }

        $headers = array(
            "Content-Type: application/json",
            "external-tx-id: " . $this->gen_uuid()
        );

        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['tags'] = $request->tags;


        $ReqResponse['requestId'] = md5(uniqid(rand(), true));
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['message'] = 'Notification MO';
        $ReqResponse['responseData'] = json_decode("{}");


        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');
        $actionName = "Notification MO";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);

        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return json_encode($ReqResponse);
    }

    public function notificationMtDn(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }


        $partnerRoleId = $partnerRole;

        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'transactionUUID' => 'required',
            'userIdentifier' => 'required',
            'largeAccount' => 'required',
            'mnoDeliveryCode' => 'required',
            // 'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }



        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['userIdentifier'] = $request->userIdentifier;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode;
        $vars['tags'] = $request->tags;


        $ReqResponse['requestId'] = md5(uniqid(rand(), true));
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['message'] = 'Notification MT';
        $ReqResponse['responseData'] = json_decode("{}");



        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['response'] = $ReqResponse;
        $result['qatar_time'] = date('Y-m-d H:i:s');
        $actionName = "Notification MT DN";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);


        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return json_encode($ReqResponse);
    }

    public function notificationUserOptin(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }

        $partnerRoleId = $partnerRole;

        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'text' => 'required',
            'msisdn' => 'required',
            'entryChannel' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            // 'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }



        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['entryChannel'] = $request->entryChannel;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['tags'] = $request->tags;
        $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode ?? ''; // DELIVERED (success)   and NO_BALANCE  (fail)




        $ReqResponse['requestId'] = md5(uniqid(rand(), true));
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['message'] = 'Notification User Optin';
        $ReqResponse['responseData'] = json_decode("{}");

        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['response'] = $ReqResponse;
        $result['qatar_time'] = date('Y-m-d H:i:s');
        $actionName = "Notification User Optin";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);

        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return json_encode($ReqResponse);
    }

    public function notificationUserOptout(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }

        $partnerRoleId = $partnerRole;
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'msisdn' => 'required',
            'entryChannel' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            //  'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }

        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['text'] = $request->text;
        $vars['entryChannel'] = $request->entryChannel;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['tags'] = $request->tags;
        $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode ?? ''; // DELIVERED (success)   and NO_BALANCE  (fail)


        $ReqResponse['requestId'] =  md5(uniqid(rand(), true));
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['message'] = 'Notification User Optout';
        $ReqResponse['responseData'] = json_decode("{}");


        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['response'] = $ReqResponse;
        $result['qatar_time'] = date('Y-m-d H:i:s');
        $actionName = "Notification User Optout";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);

        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();




        $request->productId;   /// service id
        $service = Service::where('productId',  $request->productId)->first();

        if ($service) {
            $sub = Subscriber::where('msisdn', $request->msisdn)->where('serviceId', $service->id)->orderBy("created_at", "desc")->first();
            if ($sub) {
                $unsub  = new Unsubscriber;
                $unsub->msisdn = $sub->msisdn;
                $unsub->requestId =   $notify->id;
                $unsub->transactionId = $request->transactionUUID;
                $unsub->externalTxId = $headers_array['External-Tx-Id'];
                $unsub->serviceId = $service->id;
                $unsub->save();
                $sub->delete();
            }
        }

        return json_encode($ReqResponse);
    }

    public function notificationUserRenewed(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }

        $partnerRoleId = $partnerRole;
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'msisdn' => 'required',
            'entryChannel' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            'text' => 'required',
            //  'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        }



        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['text'] = $request->text;
        $vars['entryChannel'] = $request->entryChannel;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['text'] = $request->text;
        $vars['tags'] = $request->tags;
        $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode ?? ''; // DELIVERED (success)   and NO_BALANCE  (fail)

        // $subscriber = Subscriber::select('*')
        //     ->join('services', 'services.id', '=', 'subscribers.serviceId')
        //     ->where('msisdn', $request->msisdn)
        //     ->where('services', 'services.id', $request->productId)
        //     ->first();



        // Update susbcriber status after Renew api
        $request->productId;   /// service id
        $service = Service::where('productId',  $request->productId)->first();

        if ($service) {
            $subscriber = Subscriber::where('msisdn', $request->msisdn)->where('serviceId', $service->id)->orderBy("created_at", "desc")->first();
            if ($vars['mnoDeliveryCode'] == "DELIVERED") {
                $subscriber->final_status  = 1;
            } else {
                $subscriber->final_status  = 0;
            }
            $subscriber->save();
        }




        $ReqResponse['requestId'] =  md5(uniqid(rand(), true));
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['message'] = 'string';
        $ReqResponse['responseData'] = json_decode("{}");
        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['response'] = $ReqResponse;
        $result['qatar_time'] = date('Y-m-d H:i:s');
        $actionName = "Notification User Renewed";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);

        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return json_encode($ReqResponse);
    }

    public function userFirstCharging(Request $request, $partnerRole)
    {  // first time charging after subscriptionn


        require_once('uuid/UUID.php');
        $trxid = \UUID::v4();

        date_default_timezone_set('Asia/Qatar');
        $headers_array = [];
        $headers = apache_request_headers();
        foreach ($headers as $header => $value) {
            $headers_array[$header] = $value;
        }

        $partnerRoleId = $partnerRole;
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'pricepointId' => 'required',
            'mcc' => 'required',
            'mnc' => 'required',
            'msisdn' => 'required',
            'entryChannel' => 'required',
            'largeAccount' => 'required',
            'transactionUUID' => 'required',
            'text' => 'required',
            //  'tags' => 'required',
        ]);

        // if ($validator->fails()) {
        //     return $validator->errors()->toJson();
        // }



        $vars['productId'] = (int)$request->productId;
        $vars['pricepointId'] = (int)$request->pricepointId;
        $vars['mcc'] = $request->mcc;
        $vars['mnc'] = $request->mnc;
        $vars['msisdn'] = $request->msisdn;
        $vars['entryChannel'] = $request->entryChannel;
        $vars['largeAccount'] = $request->largeAccount;
        $vars['transactionUUID'] = $request->transactionUUID;
        $vars['text'] = $request->text;
        $vars['tags'] = $request->tags;
        $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode ?? ''; // DELIVERED (success)   and NO_BALANCE  (fail)


        $ReqResponse['responseData'] = json_decode("{}");
        $ReqResponse['message'] = 'PROCESSED';
        $ReqResponse['inError'] = false;
        $ReqResponse['requestId'] =  $trxid;
        $ReqResponse['code'] = 'SUCCESS';

        //log request and response
        $result = [];
        $result['headers'] = $headers_array;
        $result['request'] = $vars;
        $result['productId'] = $vars['productId'];
        $result['response'] = $ReqResponse;
        $result['qatar_time'] = date('Y-m-d H:i:s');
        $actionName = "Notification User First Charging";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $result);



        $notify = new Notify;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers_array));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();


        $services = Service::where('productID', $vars['productId'])->first();

        $subscriber = new Subscriber;
        $subscriber->msisdn  = $request->msisdn;
        $subscriber->requestId  = $notify->id;
        $subscriber->transactionId  = $request->transactionUUID;
        $subscriber->externalTxId  = $headers_array['External-Tx-Id'];
        $subscriber->serviceId  = $service->id;
        if ($vars['mnoDeliveryCode'] == "DELIVERED") {  // send Mt Messages with service content link
            $subscriber->final_status  = 1;
        } else {
            $subscriber->final_status  = 0;
        }
        $subscriber->save();



        $message = $this->todays_link($service->id);

        if ($vars['productId'] ==  10458) { // alasfy islamic service
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://islamic.digizone.com.kw/ooredoo_q
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/2EYUH20";
            $this->sendMt($sendMT);
        } elseif ($vars['productId'] ==  10461) {  // Rotana Flatter
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://rotana.digizone.com.kw/ooredoo_qatar_login
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/3exemCn";
            $this->sendMt($sendMT);
        } elseif ($vars['productId'] ==  10479) {  //  Flatter
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://filtersnew.digizone.com.kw/ooredoo_q
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/2DqqrNb";
            $this->sendMt($sendMT);
        } elseif ($vars['productId'] ==  10462) {  //  Greeting
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://greetingnew.ivascloud.com/ooredoo_q
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/3bpx0Mv";
            $this->sendMt($sendMT);
        } elseif ($vars['productId'] ==  10463) {  //  My Whatsapp
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://whatsappie.digizone.com.kw/ooredoo_q
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/3hWKO3o";
            $this->sendMt($sendMT);
        } elseif ($vars['productId'] ==  10480) {  //  Body talk
            $sendMT = new Request();
            $sendMT->msisdn = $vars['msisdn'];
            $sendMT->productId = $vars['productId'];
            // http://bodytalk.digizone.com.kw/ooredoo_q
            $sendMT->sms = $message->ShortnedURL ?? "https://bit.ly/2QSRlQK";
            $this->sendMt($sendMT);
        }


        return json_encode($ReqResponse);
    }



    public function rotana_flatter_get_link()
    {

        $URL = "https://rotana.digizone.com.kw/api/rotana_timwe_get_lastest_url";
        $result = $this->GetPageData($URL);
        $result =  json_decode($result);
        if (isset($result->link)) {
            return    $result->link;
        } else {
            return   'https://rotana.digizone.com.kw/rotanav2/734910';
        }
    }


    public static function GetPageData($URL)
    {

        $ch = curl_init();
        $timeout = 500;
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }






    public function subscriptionSuccess(Request $request)
    {

        $vars = $request->all();

        $service = Service::where('service_id', $vars->$serviceId)->first();

        if (empty($service)) {
            return 'service do not exist!';
        }

        $subscriber = new Subscriber;
        $subscriber->msisdn = $vars->msisdn;
        $subscriber->requestId = $vars->requestId;
        $subscriber->transactionId = $vars->transactionId;
        $subscriber->externalTxId = $vars->externalTxId;
        $subscriber->final_status = 1;
        $subscriber->serviceId = $service->id;
        $subscriber->save();

        return true;
    }
    public function unsubscribeSuccess(Request $request)
    {

        $vars = $request->all();

        $service = Service::where('service_id', $vars->$serviceId)->first();

        if (empty($service)) {
            return 'service do not exist!';
        }

        $subscriber = Subscriber::where('service_id', $service->id)->where('msisdn', $vars->msisdn)->first();
        $subscriber->final_status = 0;
        $subscriber->save();

        if (empty($subscriber)) {
            return 'user not subscribed';
        }

        $unsubscriber = new UnSubscriber;
        $unsubscriber->msisdn = $vars->msisdn;
        $unsubscriber->requestId = $vars->requestId;
        $unsubscriber->transactionId = $vars->transactionId;
        $unsubscriber->externalTxId = $vars->externalTxId;
        $unsubscriber->serviceId = $service->id;
        $unsubscriber->save();

        return true;
    }

    public function gen_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public function log($actionName, $URL, $parameters_arr)
    {
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d");
        $log = new Logger($actionName);

        if (!File::exists(storage_path('logs/' . $date . '/' . $actionName))) {
            File::makeDirectory(storage_path('logs/' . $date . '/' . $actionName), 0775, true, true);
        }

        $log->pushHandler(new StreamHandler(storage_path('logs/' . $date . '/' . $actionName . '/logFile.log', Logger::INFO)));
        $log->addInfo($URL, $parameters_arr);
    }

    public function generateKey($presharedKey)
    {
        date_default_timezone_set('Asia/Qatar');

        // dd(time());

        $presharedKey = $presharedKey; //PSK shared by TIMWE
        $phrasetoEncrypt = serviceId . "#" . round(microtime(true) * 1000); // Service Id shared by TIMWE

        // $encryptionAlgorithm = "AES/ECB/PKCS5Padding";
        $encrypted = "";

        if ($presharedKey != null && $phrasetoEncrypt != "") {
            $method = "aes-128-ecb";
            $encrypted = openssl_encrypt($phrasetoEncrypt, $method, $presharedKey, OPENSSL_PKCS1_PADDING);
            $result = base64_encode($encrypted);
            return $result;
        } else {
            return "String to encrypt, Key is required.";
        }
    }

    public function sendMt(Request $request)
    {
        date_default_timezone_set('Asia/Qatar');

        $channel = "sms";
        $partnerRoleId = partnerRoleId;

        require_once('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: " . apikeysendMt,
            "authentication: " . $this->generateKey(presharedkeysendMt),
            "external-tx-id: " . $trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["productId"] = $request->productId;
        $vars["pricepointId"] = MTFreePricepointId;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["text"] = $request->sms;
        $vars["msisdn"] = $request->msisdn;
        $vars["largeAccount"] = largeAccount;
        $vars["sendDate"] = "'.$sendDate.'";
        $vars["priority"] = "NORMAL";
        $vars["timezone"] = "Asia/Qatar";
        $vars["context"] = "STATELESS";
        $vars["moTransactionUUID"] = "";

        $JSON = json_encode($vars);

        $actionName = "Send MT";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/" . $channel . "/mt/" . $partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        $notify = new OutRequest;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        $ReqResponse['notify_id'] = $notify->id;

        return $ReqResponse;
    }

    public function subscriptionOptIn($partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require_once('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: " . apikeysubscription,
            "authentication: " . $this->generateKey(presharedkeysubscription),
            "external-tx-id: " . $trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["userIdentifier"] = "9741234567";
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = 10461;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
        $vars["largeAccount"] = largeAccount;
        $vars["subKeyword"] = "";
        // $vars["trackingId"] = "12637414527";
        // $vars["clientIP"] = "127.0.0.1";
        // $vars["campaignUrl"] = "";
        // $vars["optionalParams"] = "";

        $JSON = json_encode($vars);

        $actionName = "Subscription OptIn";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/subscription/optin/" . $partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        $notify = new OutRequest;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return $ReqResponse;
    }

    public function subscriptionConfirm($partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require_once('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: " . apikeysubscription,
            "authentication: " . $this->generateKey(presharedkeysubscription),
            "external-tx-id: " . $trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["userIdentifier"] = "9741234567";
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = 10461;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
        $vars["clientIp"] = "";
        $vars["transactionAuthCode"] = "8429";

        $JSON = json_encode($vars);

        $actionName = "subscription Confirm";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/subscription/optin/confirm/" . $partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        $notify = new OutRequest;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return $ReqResponse;
    }

    public function subscriptionOptOut($partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require_once('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: " . apikeysubscription,
            "authentication: " . $this->generateKey(presharedkeysubscription),
            "external-tx-id: " . $trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["userIdentifier"] = "9741234567";
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = 10461;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
        $vars["largeAccount"] = largeAccount;
        $vars["subKeyword"] = "SUB";
        // $vars["trackingId"] = "12637414527";
        // $vars["clientIP"] = "127.0.0.1";
        // $vars["controlKeyword"] = "";
        // $vars["controlServiceKeyword"] = "";
        // $vars["subId"] = "";
        // $vars["cancelReason"] = "";
        // $vars["cancelSource"] = "";

        $JSON = json_encode($vars);

        $actionName = "subscription OptOut";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/subscription/optout/" . $partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        $notify = new OutRequest;
        $notify->actionName = $actionName;
        $notify->url = $URL;
        $notify->headers = str_replace("'", "\'", json_encode($headers));
        $notify->request = str_replace("'", "\'", json_encode($vars));
        $notify->response = str_replace("'", "\'", json_encode($ReqResponse));
        $notify->save();

        return $ReqResponse;
    }

    public function SendRequest($URL, $JSON, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON);
        $sOutput = curl_exec($ch);
        curl_close($ch);

        return $sOutput;
    }

    public function send_today_link_per_each_service()
    {
        $services = Service::all();

        foreach($services as $service){

            $subscribers = Subscriber::where('serviceId', $service->id)->where('final_status',1)->get();

            foreach($subscribers as $subscriber){
                $message = $this->todays_link($service->id);
                if($message){

                    $sendMT = new Request();
                    $sendMT->msisdn = $subscriber->msisdn;
                    $sendMT->productID = $service->productID;
                    $sendMT->sms = $message->ShortnedURL;
                    $send_check = $this->sendMt($sendMT);

                    $MTMsisdn['msisdn'] = $subscriber->msisdn;
                    $MTMsisdn['service_id'] = $service->id;
                    $MTMsisdn['link'] = $message->ShortnedURL;
                    $MTMsisdn['send_status'] = $send_check['code'];
                    $MTMsisdn['request_id'] = $send_check['notify_id'];
                    $MTMsisdn['sent_mt_all'] =  $send_check;

                    MTMsisdn::create($MTMsisdn);
                }
            }

        }
        return 'Sent Succesfully!';
    }

    public function send_failed_MtMsisdn()
    {
        $services = Service::all();

        foreach($services as $service){

            $mtmsisdns = MTMsisdn::where('service_id', $service->id)->where('send_status','!=','SUCCESS')->whereDate('created_at',Carbon::now()->toDateString())->get();

            foreach($mtmsisdns as $mtmsisdn){

                $sendMT = new Request();
                $sendMT->msisdn = $mtmsisdns->msisdn;
                $sendMT->productID = $service->productID;
                $sendMT->sms = $mtmsisdns->link;
                $send_check = $this->sendMt($sendMT);
                $mtmsisdn->send_status = $send_check['code'];
                $mtmsisdn->request_id = $send_check['notify_id'];
                $mtmsisdn->save();

                $actionName = "Send MtMsisdn";
                $URL = url()->current();
                $this->log($actionName, $URL, $mtmsisdn);


            }
        }

        return 'Sent Succesfully!';
    }


    /**
     * @param integer $serviceId
     * @return boolean
     */
    public function todays_link($serviceId)
    {
        $message = Message::where('service_id', $serviceId)->where('date', date('Y-m-d'))->first();
        return $message ?? false;
    }

}
