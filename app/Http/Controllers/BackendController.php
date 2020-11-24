<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\MTMsisdn;
use Carbon\Carbon;
use App\Http\Requests;
use App\Filters\DateFilter;
use Illuminate\Http\Request;
use App\Filters\MsisdnFilter;
use App\Filters\StatusFilter;
use App\Filters\ServiceFilter;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function send_mt()
    {
        return view('backend.send_mt');
    }

    public function filters()
    {
        $filters = [
          'service_id' => new ServiceFilter,
          'date' => new DateFilter,
          'status' => new StatusFilter,
          'msisdn' => new MsisdnFilter,
        ];

        return $filters;
    }

    public function MT_Msisdn_History(Request $request)
    {
        $msisdns = new MTMsisdn;

        $filters = $this->filters();

        $msisdns = $msisdns->filter($filters);

        $msisdns = $msisdns->paginate(20);

        return view('backend.mtmsisdn.allmts' , compact('msisdns'));
    }

    public function sync()
    {
        $Req = Request::capture();
        Message::create($Req->all());
        return 'Done !!';
    }

    public function shortURLs(){
        $Messages = Message::where('date','>',Carbon::now()->format('Y-m-d'))->get();
        foreach ($Messages as $Message){
            echo $Message->MTURL.'|' .$Message->service_id.'<br>';
        }

    }

}
