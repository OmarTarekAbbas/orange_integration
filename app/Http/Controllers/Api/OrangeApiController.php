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

      if($subscriber){
        return 1;
      }

      return 0;
    }
}
