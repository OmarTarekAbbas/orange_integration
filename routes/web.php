<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    //return view('welcome');
    return redirect('admin/mt');
});
Route::get('admin/allmts','MtController@allmts');
Route::get('home',function() {
    return redirect('admin/allmts');
});
Route::get('checkDuplicated','ServicesController@checkDuplicated');
Route::get('sch','ServicesController@MTSchedule');
Route::get('sch_approve','ServicesController@ApproveAllTodayContent');
Route::get('sch12','ServicesController@MTSchedule12');
Route::get('sch6','ServicesController@MTSchedule6');
Route::get('sch9','ServicesController@MTSchedule9');
Route::get('test','ServicesController@TodayMessagesStatus');

Route::get('sch2', 'ServicesController@MTfailResend');
//Route::get('allmts','MtController@index');
Route::get('admin','MtController@adminindex');
Route::resource('admin/user','UsersController');
Route::get('admin/mt/filter','MtController@filter');
Route::get('admin/mt/search','MtController@search');
Route::resource('admin/mt','MtController');
Route::post('admin/mt/delete/all','MtController@delete_all');

Route::get('admin/mt/approve/{id}','MtController@approve');
Route::get('admin/mt/search','MtController@search');
Route::get('check','MtController@checkmessage');
Route::get('service','MtController@select_service');
Route::post('service','MtController@selectServiceCache');
Route::get('sync','BackendController@sync');
Route::get('syncy','MtController@shortURLs');
Route::get('get/{id}', 'MtController@Download');
Route::get('Bla7','ServicesController@replaceURLS');
Route::get('removeSpaces','ServicesController@removeSpaces');
Route::get('approveAllComing','ServicesController@approveAllComing');


Route::get('admin/toSendTomorrow','ServicesController@toSendTomorrow');
Route::get('admin/notSendTomrrow','ServicesController@notSendTomrrow');


Route::resource('admin/services','AdminServicesController');
Route::get('admin/mtmsisdnhistory','BackendController@MT_Msisdn_History');
Route::post('admin/services/delete/all','AdminServicesController@delete_all');
Route::get('admin/services/{id}/show','AdminServicesController@show');

Route::resource('admin/country','AdminCountryController');
Route::resource('admin/operator','AdminOperatorController');

// Start orange Routes...
Route::get('admin/orange_notifie','AdminOrangeController@orange_notifie');
Route::get('admin/orange_ussds','AdminOrangeController@orange_ussds');
Route::get('admin/orange_webs','AdminOrangeController@orange_webs');
Route::get('admin/orange_subscribes','AdminOrangeController@orange_subscribes');
Route::get('admin/orange_provisions','AdminOrangeController@orange_provisions');
Route::get('admin/orange_notifie/request_and_response/{id}','AdminOrangeController@orange_notifie_request_and_response');
Route::get('admin/orange_ussds/request_and_response/{id}','AdminOrangeController@orange_ussds_request_and_response');
Route::get('admin/orange_webs/request_and_response/{id}','AdminOrangeController@orange_webs_request_and_response');
Route::get('admin/orange_provisions/request_and_response/{id}','AdminOrangeController@orange_provisions_request_and_response');
// End orange Routes...

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('admin/setting','SettingsController');
Route::post('admin/setting/{id}','SettingsController@update');

define('ENABLE', Helper::get_setting('approve_enable'));


