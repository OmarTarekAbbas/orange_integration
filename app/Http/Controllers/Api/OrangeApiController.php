<?php
namespace App\Http\Controllers\Api;

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
}
