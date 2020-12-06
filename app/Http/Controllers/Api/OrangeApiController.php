<?php
namespace App\Http\Controllers\Api;

use App\OrangeNotify;
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

      if($subscriber){
        return 1;
      }

      return 0;
    }

    public function createSubscription(Request $request)
    {
      $msisdn = $request->msisdn;

      $notify = OrangeNotify::create([
        "req" => 'mondia test sub',
        "response" => 'mondia test sub',
        "action" => 'mondia test sub',
        "msisdn" => $msisdn,
        "service_id" => 'mondia',
        "notification_result" => 200
      ]);

      $checkStatusRequest = new Request;
      $checkStatusRequest->msisdn = $msisdn;

      $checkStatus = $this->checkStatus($checkStatusRequest);

      if($checkStatus){
        return 1;
      }

      $subscriber = OrangeSubscribe::create([
        'msisdn' => $request->msisdn,
        'active' => 1,
        'orange_notify_id' => $notify->id,
        'table_name' => 'orange_webs'
      ]);

      return 1;
    }

}
