<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\Operator;
use App\Activation;
use App\Charge;
use App\LogMessage;
use App\MTMsisdn;
use Carbon\Carbon;
use App\Subscriber;
use App\Unsubscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AdminServicesController extends Controller
{

    private $rules;

    public function __construct()
    {
        $this->middleware('auth');
        $this->rules = [
            'title' => 'required',
            'productID' => 'required',
            'lang' => 'required',
            'type' => 'required',
            'operator_id' => 'required|numeric',
            'size' => 'numeric|min:0',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(20);
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = NULL;
        $operators = Operator::all();
        return view('backend.services.form', compact('service', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $service = new Service($request->all());
        $service->save();
        $request->session()->flash('success', 'Service Added successfully');
        return redirect('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        $subscribers = Subscriber::where("serviceid", $service->id)->count();
        $subscribers_active = Subscriber::where("serviceid", $service->id)->where('final_status',1)->count();
        $subscribers_not_active = Subscriber::where("serviceid", $service->id)->where('final_status',0)->count();
        $unsubscribers = Unsubscribe::where('serviceid', $service->id)->count();
        $mt_msisdn_SUCCESS = MTMsisdn::where("service_id", $service->id)->where('send_status','SUCCESS')->whereDate('created_at',Carbon::now()->toDateString())->count();
        $mt_msisdn_Failed = MTMsisdn::where("service_id", $service->id)->where('send_status','Failed')->whereDate('created_at',Carbon::now()->toDateString())->count();
        return view('backend.services.show', compact('service', 'subscribers', 'unsubscribers','subscribers_active','subscribers_not_active','mt_msisdn_SUCCESS','mt_msisdn_Failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $operators = Operator::all();

        return view('backend.services.form', compact('service', 'operators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $oldService = Service::findOrFail($id);
        $service = $request->all();
        $oldService->update($service);
        session()->flash('success', 'Service Updated successfully');
        return redirect('admin/services');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if ($service) {
            session()->flash('success', 'Service Deleted successfully');
            $service->delete();
            return back();
        } else {
            session()->flash('success', 'faild delete service');
            return back();
        }
    }

    public function delete_all(Request $request)
    {
        foreach ($request->service_ids as $service_id) {
            $service = Service::find($service_id);
            $service->delete();
        }
        session()->flash('success', 'Service Deleted successfully');
        return back();
    }
}
