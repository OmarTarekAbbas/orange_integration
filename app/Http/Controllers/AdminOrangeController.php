<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrangeNotify;
use Validator;
class AdminOrangeController extends Controller
{
    public function __construct() {
    $this->middleware('admin');
    }


    public function index(Request $request)
    {
        $orange_notify = OrangeNotify::query();
        $without_paginate = 0;
        if($request->has('msisdn') && $request->msisdn != ''){
            $orange_notify = $orange_notify->where('orange_notifies.msisdn',$request->msisdn);
            $without_paginate = 1;
        }

        if($request->has('service_id') && $request->service_id != ''){
            $orange_notify = $orange_notify->where('orange_notifies.service_id',$request->service_id);
            $without_paginate = 1;
        }

        if($request->has('action') && $request->action != ''){
            $orange_notify = $orange_notify->where('orange_notifies.action',$request->action);
            $without_paginate = 1;
        }

        if($request->has('notification_result') && $request->notification_result != '' ){
            $orange_notify = $orange_notify->where('orange_notifies.notification_result',$request->notification_result);
            $without_paginate = 1;
        }

        if($request->has('created') && $request->created != ''){
            $orange_notify = $orange_notify->whereDate('orange_notifies.created_at',$request->created);
            $without_paginate = 1;
        }

        if($without_paginate){
            $orange_notify = $orange_notify->get();
        }else{
            $orange_notify = $orange_notify->paginate(10);
        }
        return view('backend.orange.index',compact('orange_notify','without_paginate'));

    }

    public function request_id($id)
    {
        $show_request_orange_notify = OrangeNotify::findOrFail($id);
        return view('backend.orange.show_request',compact('show_request_orange_notify'));
    }

    public function response_id($id)
    {
        $show_response_orange_notify = OrangeNotify::findOrFail($id);
        return view('backend.orange.show_response',compact('show_response_orange_notify'));
    }


}
