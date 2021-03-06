<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\OrangeCharging;
use App\OrangeSubscribe;
use App\OrangeSubUnsub;
use App\OrangeUssd;
use App\OrangeWhitelist;
use App\Provision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Session;

class AdminOrangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orange_notifie(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $orange_notify = OrangeCharging::query()->orderBy('id', 'DESC');
        $without_paginate = 0;
        if ($request->has('msisdn') && $request->msisdn != '') {
            $orange_notify = $orange_notify->where('orange_chargings.msisdn', $request->msisdn);
            $without_paginate = 1;
        }

        if ($request->has('service_id') && $request->service_id != '') {
            $orange_notify = $orange_notify->where('orange_chargings.service_id', $request->service_id);
            $without_paginate = 1;
        }
        if ($request->has('action') && $request->action != '') {
          if($request->action == 'Success'){
            $orange_notify = $orange_notify->where(function($q){
              $q->where('orange_chargings.action', 'GRACE1');
              $q->orWhere('orange_chargings.action', 'OUTOFGRACE');
              $q->orWhere('orange_chargings.action', 'OPERATORSUBSCRIBE');
            });
          }else{
            $orange_notify = $orange_notify->where('orange_chargings.action', $request->action);
          }
            $without_paginate = 1;
        }

        if ($request->has('notification_result') && $request->notification_result != '') {
            if ($request->notification_result == 200) {
                $orange_notify = $orange_notify->where('orange_chargings.notification_result', $request->notification_result);
            } else {
                $orange_notify = $orange_notify->where('orange_chargings.notification_result', '!=', 200);
            }
            $without_paginate = 1;
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $orange_notify = $orange_notify->whereDate('orange_chargings.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_notify = $orange_notify->whereDate('orange_chargings.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }

        if ($without_paginate) {
            $orange_notify = $orange_notify->get();

        } else {
            $orange_notify = $orange_notify->paginate(10);
        }
        return view('backend.orange.index', compact('orange_notify', 'without_paginate'));

    }

    public function orange_notifie_request_and_response($id)
    {
        $show_request_orange_notify = OrangeCharging::findOrFail($id);
        return view('backend.orange.show_request', compact('show_request_orange_notify'));
    }

    public function orange_ussds(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $orange_ussds = OrangeUssd::query()->orderBy('id', 'DESC');
        $without_paginate = 0;
        if ($request->has('msisdn') && $request->msisdn != '') {
            $orange_ussds = $orange_ussds->where('orange_ussds.msisdn', $request->msisdn);
            $without_paginate = 1;
        }

        if ($request->has('session_id') && $request->session_id != '') {
            $orange_ussds = $orange_ussds->where('orange_ussds.session_id', $request->session_id);
            $without_paginate = 1;
        }

        if ($request->has('language') && $request->language != '') {
            $orange_ussds = $orange_ussds->where('orange_ussds.language', $request->language);
            $without_paginate = 1;
        }

        if ($request->has('host') && $request->host != '') {
            $orange_ussds = $orange_ussds->where('orange_ussds.host', $request->host);
            $without_paginate = 1;
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $orange_ussds = $orange_ussds->whereDate('orange_ussds.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_ussds = $orange_ussds->whereDate('orange_ussds.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }
        if ($without_paginate) {
            $orange_ussds = $orange_ussds->get();
        } else {
            $orange_ussds = $orange_ussds->paginate(10);
        }
        return view('backend.orange.orange_ussds', compact('orange_ussds', 'without_paginate'));
    }

    public function orange_ussds_request_and_response($id)
    {
        $show_request_orange_ussds = OrangeUssd::findOrFail($id);
        return view('backend.orange.show_request_orange_ussds', compact('show_request_orange_ussds'));
    }

    public function orange_webs(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $orange_webs = OrangeSubUnsub::query()->orderBy('id', 'DESC');
        $without_paginate = 0;
        if ($request->has('calling_party_id') && $request->calling_party_id != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.calling_party_id', $request->calling_party_id);
            $without_paginate = 1;
        }

        if ($request->has('spId') && $request->spId != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.spId', $request->spId);
            $without_paginate = 1;
        }

        if ($request->has('service_number') && $request->service_number != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.service_number', $request->service_number);
            $without_paginate = 1;
        }

        if ($request->has('selfcare_command') && $request->selfcare_command != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.selfcare_command', $request->selfcare_command);
            $without_paginate = 1;
        }

        if ($request->has('time_stamp') && $request->time_stamp != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.time_stamp', $request->time_stamp);
            $without_paginate = 1;
        }

        if ($request->has('on_bearer_type') && $request->on_bearer_type != '') {
            $orange_webs = $orange_webs->where('orange_sub_unsubs.on_bearer_type', $request->on_bearer_type);
            $without_paginate = 1;
        }

        if ($request->has('on_result_code') && $request->on_result_code != '') {
            if ($request->on_result_code == 0) {
                $orange_webs = $orange_webs->where('orange_sub_unsubs.on_result_code', $request->on_result_code);
            } else {
                $orange_webs = $orange_webs->where('orange_sub_unsubs.on_result_code', '!=', 0);
            }
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $orange_webs = $orange_webs->whereDate('orange_sub_unsubs.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_webs = $orange_webs->whereDate('orange_sub_unsubs.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }

        if ($without_paginate) {
            $orange_webs = $orange_webs->get();
        } else {
            $orange_webs = $orange_webs->paginate(10);
        }
        return view('backend.orange.orange_webs', compact('orange_webs', 'without_paginate'));
    }

    public function orange_webs_request_and_response($id)
    {
        $show_request_orange_webs = OrangeSubUnsub::findOrFail($id);
        return view('backend.orange.show_request_orange_webs', compact('show_request_orange_webs'));
    }

    public function orange_subscribes(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $orange_subscribes = OrangeSubscribe::query()->orderBy('id', 'DESC');
        $without_paginate = 0;
        if ($request->has('msisdn') && $request->msisdn != '') {
            $orange_subscribes = $orange_subscribes->where('orange_subscribes.msisdn', $request->msisdn);
            $without_paginate = 1;
        }

        if ($request->has('active') && $request->active != '') {
            $orange_subscribes = $orange_subscribes->where('orange_subscribes.active', $request->active);
            $without_paginate = 1;
        }

        if ($request->has('orange_channel_id') && $request->orange_channel_id != '') {
            $orange_subscribes = $orange_subscribes->where('orange_subscribes.orange_channel_id', $request->orange_channel_id);
            $without_paginate = 1;
        }

        if ($request->has('table_name') && $request->table_name != '') {
            $orange_subscribes = $orange_subscribes->where('orange_subscribes.table_name', $request->table_name);
            $without_paginate = 1;
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $orange_subscribes = $orange_subscribes->whereDate('orange_subscribes.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_subscribes = $orange_subscribes->whereDate('orange_subscribes.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }

        if ($without_paginate) {
            $orange_subscribes = $orange_subscribes->get();
        } else {
            $orange_subscribes = $orange_subscribes->paginate(10);
        }
        return view('backend.orange.orange_subscribes', compact('orange_subscribes', 'without_paginate'));
    }

    public function orange_provisions(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $orange_provisions = Provision::query()->orderBy('id', 'DESC');
        $without_paginate = 0;
        if ($request->has('spId') && $request->spId != '') {
            $orange_provisions = $orange_provisions->where('provisions.spId', $request->spId);
            $without_paginate = 1;
        }

        if ($request->has('timeStamp') && $request->timeStamp != '') {
            $orange_provisions = $orange_provisions->where('provisions.timeStamp', $request->timeStamp);
            $without_paginate = 1;
        }

        if ($request->has('transactionId') && $request->transactionId != '') {
            $orange_provisions = $orange_provisions->where('provisions.transactionId', $request->transactionId);
            $without_paginate = 1;
        }

        if ($request->has('msisdn') && $request->msisdn != '') {
            $orange_provisions = $orange_provisions->where('provisions.msisdn', $request->msisdn);
            $without_paginate = 1;
        }

        if ($request->has('serviceId') && $request->serviceId != '') {
            $orange_provisions = $orange_provisions->where('provisions.serviceId', $request->serviceId);
            $without_paginate = 1;
        }

        if ($request->has('operationType') && $request->operationType != '') {
            $orange_provisions = $orange_provisions->where('provisions.operationType', $request->operationType);
            $without_paginate = 1;
        }

        if ($request->has('createdTime') && $request->createdTime != '') {
            $orange_provisions = $orange_provisions->where('provisions.createdTime', $request->createdTime);
            $without_paginate = 1;
        }

        if ($request->has('resultCode') && $request->resultCode != '') {
            if ($request->orange_provisions == 00000000) {
                $orange_provisions = $orange_provisions->where('provisions.resultCode', $request->resultCode);
            } else {
                $orange_provisions = $orange_provisions->where('provisions.resultCode', '!=', 00000000);
            }
            $without_paginate = 1;
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $orange_provisions = $orange_provisions->whereDate('provisions.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_provisions = $orange_provisions->whereDate('provisions.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }

        if ($without_paginate) {
            $orange_provisions = $orange_provisions->get();
        } else {
            $orange_provisions = $orange_provisions->paginate(10);
        }
        return view('backend.orange.orange_provisions', compact('orange_provisions', 'without_paginate'));
    }

    public function orange_whitelists(Request $request)
    {
        if ($request->has('to_date') && $request->to_date != '') {
            $validator = Validator::make($request->all(), [
                'from_date' => '',
                'to_date' => 'required|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $orange_whitelists = OrangeWhitelist::query()->orderBy('id', 'DESC');
        $without_paginate = 0;

        if ($request->has('msisdn') && $request->msisdn != '') {
            $orange_whitelists = $orange_whitelists->where('orange_whitelists.msisdn', $request->msisdn);
            $without_paginate = 1;
        }
        if ($request->has('from_date') && $request->from_date != '') {
            $orange_whitelists = $orange_whitelists->whereDate('orange_whitelists.created_at', '>=', $request->from_date);
            $without_paginate = 1;
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $orange_whitelists = $orange_whitelists->whereDate('orange_whitelists.created_at', '<=', $request->to_date);
            $without_paginate = 1;
        }

        if ($without_paginate) {
            $orange_whitelists = $orange_whitelists->get();
        } else {
            $orange_whitelists = $orange_whitelists->paginate(10);
        }
        return view('backend.orange.orange_whitelists', compact('orange_whitelists', 'without_paginate'));
    }

    public function orange_provisions_request_and_response($id)
    {
        $show_request_orange_provisions = Provision::findOrFail($id);
        return view('backend.orange.show_request_orange_provisions', compact('show_request_orange_provisions'));
    }

    public function call_orange_statistics(Request $request)
    {

        $count_user_today = OrangeSubscribe::whereDate('created_at', Carbon::now()->toDateString())->count();

        $count_all_active_users = OrangeSubscribe::where('active', 1)->where('type',"!=",'whitelists')->count();

        $count_all_active_whitelist_users = OrangeSubscribe::where('active', 1)->where('type','whitelists')->count();

        $count_all_unsub_users = OrangeSubscribe::where('active', 2)->where('type','!=','whitelists')->count();

        $count_all_unsub_whitelist__users = OrangeSubscribe::where('active', 2)->where('type','whitelists')->count();

        $count_today_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('created_at', Carbon::now()->toDateString())->count();

        $count_all_pending_users = OrangeSubscribe::where('active', 0)->count();

        $count_of_total_free_users = OrangeSubscribe::where('free', 1)->count();

        $count_charging_users_not_free = OrangeSubscribe::where('active', 1)->where('free', 0)->count();

        $count_of_all_success_charging_today = OrangeCharging::whereDate('created_at', Carbon::now()->toDateString())->whereIn('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();

        $count_of_all_success_charging = OrangeCharging::whereIn('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();



        return view('backend.orange.call_orange_statistics', compact(
            'count_user_today',
            'count_all_active_users',
            'count_all_active_whitelist_users',
            'count_all_unsub_users',
            'count_all_unsub_whitelist__users',
            'count_all_pending_users',
            'count_of_total_free_users',
            'count_charging_users_not_free',
            'count_of_all_success_charging',
            'count_of_all_success_charging_today',
            'count_today_unsub_users'));
    }

    public function download_excel_orange_statistics()
    {
        $count_user_today = OrangeSubscribe::whereDate('created_at', Carbon::now()->toDateString())->count();
        $count_all_active_users = OrangeSubscribe::where('active', 1)->count();
        $count_today_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('created_at', Carbon::now()->toDateString())->count();
        $count_all_unsub_users = OrangeSubscribe::where('active', 2)->count();

        $count_all_pending_users = OrangeSubscribe::where('active', 0)->count();
        $count_of_total_free_users = OrangeSubscribe::where('free', 1)->count();
        $count_charging_users_not_free = OrangeSubscribe::where('active', 1)->where('free', 0)->count();
        $count_of_all_success_charging_today = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->whereDate('created_at', Carbon::now()->toDateString())->count();
        $count_of_all_success_charging = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();
        $count_all_whitelists = OrangeSubscribe::where('type', 'whitelists')->count();

        \Excel::create('orangestatistics-'.Carbon::now()->toDateString(), function($excel) use ($count_user_today, $count_all_active_users, $count_all_unsub_users,$count_all_pending_users,$count_of_total_free_users,$count_charging_users_not_free,$count_of_all_success_charging,$count_of_all_success_charging_today,$count_today_unsub_users,$count_all_whitelists) {
            $excel->sheet('Excel', function($sheet) use ($count_user_today, $count_all_active_users, $count_all_unsub_users ,$count_all_pending_users,$count_of_total_free_users,$count_charging_users_not_free,$count_of_all_success_charging,$count_of_all_success_charging_today,$count_today_unsub_users,$count_all_whitelists) {
                $sheet->loadView('backend.orange.download_excel_orange_statistics')->with("count_user_today", $count_user_today)->with("count_all_active_users", $count_all_active_users)->with("count_all_unsub_users", $count_all_unsub_users)->with("count_all_pending_users", $count_all_pending_users)->with("count_of_total_free_users", $count_of_total_free_users)->with("count_charging_users_not_free",$count_charging_users_not_free)->with("count_of_all_success_charging",$count_of_all_success_charging)->with("count_of_all_success_charging_today",$count_of_all_success_charging_today)->with("count_today_unsub_users",$count_today_unsub_users)->with("count_all_whitelists",$count_all_whitelists);
            });
        })->export('csv');
    }

    public function orange_statistics_by_form(Request $request)
    {

      if($request->has('from_date') && $request->from_date != ''){
        $date = $request->from_date;
        $equal = '=';
      }else{
        $date = Carbon::now()->toDateString();
        $equal = '=';
      }
        $count_user_today = OrangeSubscribe::whereDate('created_at',"=", $date)->count();

        $count_all_active_users = OrangeSubscribe::where('active', 1)->where('type',"!=",'whitelists')->whereDate('created_at',"<", $date)->count();

        $count_all_active_whitelist_users = OrangeSubscribe::where('active', 1)->where('type','whitelists')->whereDate('created_at',"<=", $date)->count();


        $count_today_unsub_users = OrangeSubUnsub::whereDate('created_at',"=", $date)->where('selfcare_command','UNSUBSCRIBE')->where('on_result_code',0)->count();

        $count_all_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('created_at',"<", $date)->count();
        $count_all_unsub_whitelist__users = OrangeSubscribe::where('active', 2)->where('type','whitelists')
        ->whereDate('created_at',"<", $date)->count();


        $count_all_pending_users = OrangeSubscribe::where('active', 0)->where('type' ,"!=" , "whitelists")->whereDate('created_at',"<=", $date)->count();
        $count_of_total_free_users = OrangeSubscribe::where('free', 1)->where('type' ,"!=" , "whitelists")->whereDate('created_at',"<=", $date)->count();



        $count_charging_users_not_free = OrangeSubscribe::where('active', 1)->where('free', 0)->whereDate('created_at',"<=", $date)->count();
        $count_of_all_success_charging_today = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->whereDate('created_at',"=", $date)->count();
        $count_of_all_success_charging = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->whereDate('created_at',"<", $date)->count();




        return view('backend.orange.orange_statistics_v2.orange_statistics_v2', compact(
            'count_user_today',
            'count_all_active_users',
            'count_all_active_whitelist_users',
            'count_all_unsub_users',
            'count_all_unsub_whitelist__users',
            'count_all_pending_users',
            'count_of_total_free_users',
            'count_charging_users_not_free',
            'count_of_all_success_charging',
            'count_of_all_success_charging_today',
            'count_today_unsub_users'));
    }

    public function download_excel_orange_statistics_v2(Request $request)
    {
      if($request->has('from_date') && $request->from_date != ''){
          $date = $request->from_date;
          $equal = '=';
        }else{
          $date = Carbon::now()->toDateString();
          $equal = '=';
        }
          $count_user_today = OrangeSubscribe::whereDate('created_at',"=", $date)->count();
          $count_all_active_users = OrangeSubscribe::where('active', 1)->whereDate('created_at',"<=", $date)->count();

          // $count_today_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('created_at', Carbon::now()->toDateString())->count();
          $count_today_unsub_users = OrangeSubUnsub::whereDate('created_at',"=", $date)->where('selfcare_command','UNSUBSCRIBE')->where('on_result_code',0)->count();

          $count_all_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('created_at',"<=", $date)->count();




          $count_all_pending_users = OrangeSubscribe::where('active', 0)->whereDate('created_at',"<=", $date)->count();
          $count_of_total_free_users = OrangeSubscribe::where('free', 1)->whereDate('created_at',"<=", $date)->count();
          $count_charging_users_not_free = OrangeSubscribe::where('active', 1)->where('free', 0)->whereDate('created_at',"<=", $date)->count();


          $count_of_all_success_charging_today = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->whereDate('created_at',"=", $date)->count();
          $count_of_all_success_charging = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->whereDate('created_at',"<", $date)->count();
          $count_all_whitelists = OrangeSubscribe::where('active', 1)->where('type', 'whitelists')->whereDate('created_at',"<=", $date)->count();


          \Excel::create('orangestatistics-'.$date, function($excel) use ($count_user_today, $count_all_active_users, $count_all_unsub_users,$count_all_pending_users,$count_of_total_free_users,$count_charging_users_not_free,$count_of_all_success_charging,$count_of_all_success_charging_today,$count_today_unsub_users, $count_all_whitelists) {
              $excel->sheet('Excel', function($sheet) use ($count_user_today, $count_all_active_users, $count_all_unsub_users ,$count_all_pending_users,$count_of_total_free_users,$count_charging_users_not_free,$count_of_all_success_charging,$count_of_all_success_charging_today,$count_today_unsub_users, $count_all_whitelists) {
                  $sheet->loadView('backend.orange.download_excel_orange_statistics')->with("count_user_today", $count_user_today)->with("count_all_active_users", $count_all_active_users)->with("count_all_unsub_users", $count_all_unsub_users)->with("count_all_pending_users", $count_all_pending_users)->with("count_of_total_free_users", $count_of_total_free_users)->with("count_charging_users_not_free",$count_charging_users_not_free)->with("count_of_all_success_charging",$count_of_all_success_charging)->with("count_of_all_success_charging_today",$count_of_all_success_charging_today)->with("count_today_unsub_users",$count_today_unsub_users)->with("count_all_whitelists",$count_all_whitelists);
              });
          })->export('csv');
    }

    public function orange_statistics_by_form_v2(Request $request)
    {

      if($request->has('from_date') && $request->from_date != ''){
        $date = $request->from_date;
        $equal = '=';
      }else{
        $date = Carbon::now()->toDateString();
        $equal = '=';
      }

        $time = strtotime("$date - 1 days") ;
        $yesterday =  date("Y-m-d" ,  $time ) ;

        $time_next = strtotime("$date + 1 days") ;
        $tomorrow =  date("Y-m-d" ,  $time_next ) ;

        $count_user_today = OrangeSubscribe::whereDate('created_at',"=", $date)->count();
      //  $count_charging_users_not_free = OrangeSubscribe::where('subscribe_due_date', $date)->count();
        $count_charging_users_not_free = OrangeCharging::whereDate('created_at',"=", $date)->count();
        $count_of_all_success_charging_today = OrangeCharging::whereDate('created_at',"=", $date)->whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();
        $count_all_active_users = OrangeSubscribe::whereDate('created_at',"=",  $yesterday )->count();
        // $count_today_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('updated_at',"=", $date)->count();
        $count_today_unsub_users = OrangeSubUnsub::whereDate('created_at',"=", $date)->where('selfcare_command','UNSUBSCRIBE')->where('on_result_code',0)->count();


        $count_all_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('type', "!=" ,'whitelists')->count();
        $count_total_all_active_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('type', "!=" ,'whitelists')->where('active', 1)->count();
        $count_all_pending_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('type', "!=" ,'whitelists')->where('active', 0)->count();
        $count_all_unsub_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('type', "!=" ,'whitelists')->where('active', 2)->count();





        $count_of_total_free_users = OrangeSubscribe::where('free', 1)->whereDate('created_at',"<=", $date)->count();
        $count_of_all_success_charging = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();

        return view('backend.orange.orange_statistics_v2.orange_statistics', compact(
            'count_user_today',
            'count_all_active_users',
            'count_all_unsub_users',
            'count_all_pending_users',
            'count_of_total_free_users',
            'count_charging_users_not_free',
            'count_of_all_success_charging',
            'count_of_all_success_charging_today',
          'count_today_unsub_users',
          'yesterday',
          'count_all_users',
          'count_total_all_active_users',
          'date'
          ));
    }

    public function download_excel_orange_statistics_by_form(Request $request)
    {
      if($request->has('from_date') && $request->from_date != ''){
        $date = $request->from_date;
        $equal = '=';
      }else{
        $date = Carbon::now()->toDateString();
        $equal = '=';
      }

        $time = strtotime("$date - 1 days") ;
        $yesterday =  date("Y-m-d" ,  $time ) ;

        $time_next = strtotime("$date + 1 days") ;
        $tomorrow =  date("Y-m-d" ,  $time_next ) ;

        $count_user_today = OrangeSubscribe::whereDate('created_at',"=", $date)->count();
        $count_charging_users_not_free = OrangeCharging::whereDate('created_at',"=", $date)->count();
        $count_of_all_success_charging_today = OrangeCharging::whereDate('created_at',"=", $date)
                                              ->whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();
        $count_all_active_users = OrangeSubscribe::whereDate('created_at',"=",  $yesterday )->count();
        // $count_today_unsub_users = OrangeSubscribe::where('active', 2)->whereDate('updated_at',"=", $date)->count();
        $count_today_unsub_users = OrangeSubUnsub::whereDate('created_at',"=", $date)->where('selfcare_command','UNSUBSCRIBE')->where('on_result_code',0)->count();


        $count_all_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->count();
        $count_total_all_active_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('active', 1)->count();
        $count_all_pending_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('active', 0)->count();
        $count_all_unsub_users = OrangeSubscribe::whereDate('created_at',"<=",  $yesterday )->where('active', 2)->count();

        $count_of_total_free_users = OrangeSubscribe::where('free', 1)->whereDate('created_at',"<=", $date)->count();
        $count_of_all_success_charging = OrangeCharging::whereIN('action', ['OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE'])->count();

        \Excel::create('alforsantatistics-two'.$date,
        function($excel)
          use (
              $count_user_today,
              $count_charging_users_not_free,
              $count_of_all_success_charging_today,
              $count_all_active_users, $count_today_unsub_users,
              $count_all_users,
              $count_total_all_active_users,
              $count_all_pending_users,
              $count_all_unsub_users,
              $count_of_total_free_users,
              $count_of_all_success_charging,
              $yesterday)
          {
            $excel->sheet('Excel',
            function($sheet)
            use (
              $count_user_today,
              $count_charging_users_not_free,
              $count_of_all_success_charging_today,
              $count_all_active_users,
              $count_today_unsub_users,
              $count_all_users,
              $count_total_all_active_users,
              $count_all_pending_users,
              $count_all_unsub_users,
              $count_of_total_free_users,
              $count_of_all_success_charging,
              $yesterday)
            {
              $sheet->loadView('backend.orange.download_excel_orange_statistics_by_form')
              ->with("count_user_today", $count_user_today)
              ->with("count_charging_users_not_free", $count_charging_users_not_free)
              ->with("count_of_all_success_charging_today", $count_of_all_success_charging_today)
              ->with("count_all_active_users", $count_all_active_users)
              ->with("count_today_unsub_users", $count_today_unsub_users)
              ->with("count_all_users", $count_all_users)
              ->with("count_total_all_active_users", $count_total_all_active_users)
              ->with("count_all_pending_users", $count_all_pending_users)
              ->with("count_all_unsub_users", $count_all_unsub_users)
              ->with("count_of_total_free_users", $count_of_total_free_users)
              ->with("yesterday", $yesterday)
              ->with("count_of_all_success_charging", $count_of_all_success_charging);
          });
      })->export('csv');
    }

    public function removeDuplicateMsisdn()
    {
      $whitelist_unique_numbers = [];
      $subscribe_unique_numbers = [];
      OrangeWhitelist::orderBy("created_at", "desc")->chunk(100, function ($whitelists) use ($whitelist_unique_numbers){
        foreach ($whitelists as $whitelist) {
            if(!in_array($whitelist->msisdn, $whitelist_unique_numbers)){
              array_push($whitelist_unique_numbers, $whitelist->msisdn);
              continue;
            }
            $whitelist->delete();
        }
      });

      OrangeSubscribe::orderBy("created_at", "desc")->chunk(100, function ($OrangeSubscribes) use ($subscribe_unique_numbers){
        foreach ($OrangeSubscribes as $OrangeSubscribe) {
            if(!in_array($OrangeSubscribe->msisdn, $subscribe_unique_numbers)){
              array_push($subscribe_unique_numbers, $OrangeSubscribe->msisdn);
              continue;
            }
            $OrangeSubscribe->delete();
        }
      });
    }

    public function DownloadSubscribe(Request $request)
    {
      set_time_limit(0);
      ini_set('memory_limit', -1);

      $downloadSubscribes = OrangeSubscribe::where('active', 1)->where('type' ,"!=" , "whitelists")->pluck('msisdn')->toArray();

      \Excel::create('DownloadSubscribe-'.Carbon::now()->toDateString(), function($excel) use ($downloadSubscribes) {
          $excel->sheet('Excel', function($sheet) use ($downloadSubscribes) {
            $sheet->loadView('backend.orange.download_subscribe')->with("downloadSubscribes",$downloadSubscribes);
          });
      })->export('csv');
    }

    public function DownloadSubscribeOne(Request $request)
    {
      set_time_limit(0);
      ini_set('memory_limit', -1);

      $downloadSubscribes = \DB::select("SELECT date(created_at) as date , count(created_at) as date_count FROM `orange_sub_unsubs` WHERE selfcare_command = 'SUBSCRIBE' AND on_bearer_type = 'WEB' AND on_result_code = 0 GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      \Excel::create('success_send_subscribers_to_orange-'.Carbon::now()->toDateString(), function($excel) use ($downloadSubscribes) {
          $excel->sheet('Excel', function($sheet) use ($downloadSubscribes) {
           $sheet->loadView('backend.orange.download_subscribe.download_subscribe_two')->with("downloadSubscribes",$downloadSubscribes);
          });
      })->export('csv');
    }

    public function DownloadSubscribeTwo(Request $request)
    {
      set_time_limit(0);
      ini_set('memory_limit', -1);

      $downloadSubscribes = \DB::select("SELECT date(created_at) as date , count(created_at) as date_count FROM `orange_sub_unsubs` WHERE selfcare_command = 'SUBSCRIBE' AND on_bearer_type = 'WEB'  GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      \Excel::create('send_subscribers_to_orange-'.Carbon::now()->toDateString(), function($excel) use ($downloadSubscribes) {
          $excel->sheet('Excel', function($sheet) use ($downloadSubscribes) {
           $sheet->loadView('backend.orange.download_subscribe.download_subscribe_two')->with("downloadSubscribes",$downloadSubscribes);
          });
      })->export('csv');
    }

    public function downloadNewSubscriber(Request $request)
    {
      set_time_limit(0);
      ini_set('memory_limit', -1);

      $downloadSubscribes = \DB::select("SELECT date(created_at) as date , count(created_at) as date_count FROM `orange_subscribes` GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      \Excel::create('new-subscriber-'.Carbon::now()->toDateString(), function($excel) use ($downloadSubscribes) {
          $excel->sheet('Excel', function($sheet) use ($downloadSubscribes) {
           $sheet->loadView('backend.orange.download_subscribe.download_subscribe_two')->with("downloadSubscribes",$downloadSubscribes);
          });
      })->export('csv');
    }

    public function getAllInfoAboutSubscriberPage()
    {
      return view("backend.orange.download_subscribe.all_info");
    }

    public function downloadAllInfoAboutSubscriber(Request $request)
    {
      $start = $request->from_date??"2021-04-01";
      $end   = $request->to_date??date('Y-m-d');
      $group_all_subscriber = [];

      $success_send_subscribers = \DB::select("SELECT date(created_at) as date , count(created_at) as success_count FROM `orange_sub_unsubs` WHERE selfcare_command = 'SUBSCRIBE' AND on_bearer_type = 'WEB' AND on_result_code = 0 GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      $all_send_subscribers = \DB::select("SELECT date(created_at) as date , count(created_at) as all_count FROM `orange_sub_unsubs` WHERE selfcare_command = 'SUBSCRIBE' AND on_bearer_type = 'WEB'  GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      $new_subscribers = \DB::select("SELECT date(created_at) as date , count(created_at) as new_count FROM `orange_subscribes` GROUP BY date(created_at) HAVING count(created_at) >= 1;");

      $all_charging = \DB::select("SELECT date(created_at) as date , count(created_at) as all_charging_count FROM `orange_chargings` GROUP BY date(created_at) HAVING count(created_at) >= 1");

      $success_charging = \DB::select("SELECT date(created_at) as date , count(created_at) as success_charging_count FROM `orange_chargings` WHERE action IN  ('OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE') GROUP BY date(created_at) HAVING count(created_at) >= 1");

      $period = new \DatePeriod(
        new \DateTime($start),
        new \DateInterval('P1D'),
        new \DateTime($end)
      );

      foreach ($period as $key => $value) {
        $all_index = array_search($value->format('Y-m-d'), array_column($all_send_subscribers, 'date'));
        $success_index = array_search( $value->format('Y-m-d'), array_column($success_send_subscribers, 'date'));
        $new_index = array_search($value->format('Y-m-d'), array_column($new_subscribers, 'date'));
        $all_charging_index = array_search($value->format('Y-m-d'), array_column($all_charging, 'date'));
        $success_charging_index = array_search($value->format('Y-m-d'), array_column($success_charging, 'date'));

        $group_all_subscriber[$key]['date'] = $value->format('Y-m-d');
        $group_all_subscriber[$key]['all_count'] = $all_index != false ? $all_send_subscribers[$all_index]->all_count : 0;
        $group_all_subscriber[$key]['success_count'] = $success_index != false ? $success_send_subscribers[$success_index]->success_count: 0;
        $group_all_subscriber[$key]['new_count'] = $new_index != false? $new_subscribers[$new_index]->new_count : 0;
        $group_all_subscriber[$key]['all_charging_count'] = $new_index != false? $all_charging[$all_charging_index]->all_charging_count : 0;
        $group_all_subscriber[$key]['success_charging_count'] = $new_index != false? $success_charging[$success_charging_index]->success_charging_count : 0;
      }

      \Excel::create('download-all-info-'.Carbon::now()->toDateString(), function($excel) use ($group_all_subscriber) {
        $excel->sheet('Excel', function($sheet) use ($group_all_subscriber) {
         $sheet->loadView('backend.orange.download_subscribe.download_all_info')->with("group_all_subscriber", $group_all_subscriber);
        });
      })->export('csv');
    }

  public function orangeStatisticsGraph(Request $request)
  {
    $request = $request;
    $graph_data = $this->orangeStatisticsGraphData($request);
    Session::put('graph_data', $graph_data);

    return view("backend.orange.orange_statistics_graph.all", compact('graph_data'));
  }

  public function orangeStatisticsGraphData($request)
  {
    $start_date = $request->from_date ?? date('Y-m-01');
    $end_date   = $request->to_date ?? date('Y-m-d');
    $group_all_subscriber = [];

    $new_subscribers = \DB::select("SELECT date(created_at) as date , count(created_at) as new_count FROM `orange_subscribes` GROUP BY date(created_at) HAVING count(created_at) >= 1;");
    $all_charging = \DB::select("SELECT date(created_at) as date , count(created_at) as all_charging_count FROM `orange_chargings` GROUP BY date(created_at) HAVING count(created_at) >= 1");
    $success_charging = \DB::select("SELECT date(created_at) as date , count(created_at) as success_charging_count FROM `orange_chargings` WHERE action IN  ('OUTOFGRACE','GRACE1','OPERATORSUBSCRIBE') GROUP BY date(created_at) HAVING count(created_at) >= 1");
    $daily_unsub_subscribers = \DB::select("SELECT date(created_at) as date, count(created_at) as daily_unsub_subscribers_count FROM `orange_sub_unsubs` WHERE selfcare_command='UNSUBSCRIBE' AND on_result_code=0 GROUP BY date(created_at) HAVING count(created_at) >= 1");

    $period = new \DatePeriod(
      new \DateTime($start_date),
      new \DateInterval('P1D'),
      new \DateTime($end_date)
    );

    foreach ($period as $key => $value) {
      $new_index = array_search($value->format('Y-m-d'), array_column($new_subscribers, 'date'));
      $all_charging_index = array_search($value->format('Y-m-d'), array_column($all_charging, 'date'));
      $success_charging_index = array_search($value->format('Y-m-d'), array_column($success_charging, 'date'));
      $daily_unsub_subscribers_index = array_search($value->format('Y-m-d'), array_column($daily_unsub_subscribers, 'date'));

      $group_all_subscriber[$key]['date'] = $value->format('Y-m-d');
      $group_all_subscriber[$key]['new_count'] = $new_index != false ? $new_subscribers[$new_index]->new_count : 0;
      $group_all_subscriber[$key]['all_charging_count'] = $all_charging_index != false ? $all_charging[$all_charging_index]->all_charging_count : 0;
      $group_all_subscriber[$key]['success_charging_count'] = $success_charging_index != false ? $success_charging[$success_charging_index]->success_charging_count : 0;
      $group_all_subscriber[$key]['billing_rate'] = ($group_all_subscriber[$key]['all_charging_count'] > 0) ? (round($group_all_subscriber[$key]['success_charging_count'] / $group_all_subscriber[$key]['all_charging_count'], 2)) : 0;
      $group_all_subscriber[$key]['daily_unsub_subscribers_count'] = $daily_unsub_subscribers_index != false ? $daily_unsub_subscribers[$daily_unsub_subscribers_index]->daily_unsub_subscribers_count : 0;
      $group_all_subscriber[$key]['cancel_rate'] = ($group_all_subscriber[$key]['new_count'] > 0) ? (round($group_all_subscriber[$key]['daily_unsub_subscribers_count'] / $group_all_subscriber[$key]['new_count'], 2)) : 0;
    }

    return $group_all_subscriber;
  }

  public function orangeStatisticsGraphDownloadToExcel()
  {
    $graph_excel_data = Session::get('graph_data');
    if (isset($graph_excel_data) && $graph_excel_data != null) {
      $excel_title = 'orange-statistics-' . Carbon::now()->toDateString();
      \Excel::create($excel_title, function ($excel) use ($graph_excel_data) {
        $excel->sheet('Excel', function ($sheet) use ($graph_excel_data) {
          $sheet->loadView('backend.orange.orange_statistics_graph.excel')->with("graph_excel_data", $graph_excel_data);
        });
      })->export('csv');
    }
  }

}
