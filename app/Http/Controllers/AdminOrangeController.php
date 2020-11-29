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
        $orange_notify = OrangeNotify::all();
        return view('backend.activations.index',compact('orange_notify'));

    }


}
