<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return view('backend.settings.index',compact('settings'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('backend.settings.form',compact('setting'));
    }

    public function update(Request $request,$id)
    {
        $setting = Setting::findOrFail($id);
        $setting->value = $request->enable;
        $setting->save();
        return redirect('admin/setting');
    }

}
