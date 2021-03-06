<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/************* Start config Timwe******************/
/*
define('PartnerId', '2534');
define('partnerRoleId', '2614');
define('serviceId', '2724');
define('largeAccount', '92842');

define('MTFreePricepointId', '46742');
define('PricepintId10QAR', '46758');
define('PricepintId5QAR', '46743');
define('PricepintId2QAR', '46759');

define('apikeysendMt', '98c489a1415047c4b19ab30436289de2');
define('presharedkeysendMt', 'SkU0gO1lSHR7wdfP');

define('apikeysubscription', '8086e440d80847a6b534c88a6c33a172');
define('presharedkeysubscription', 'cutfvCPZrlzMo6t8');
*/
//************* end config Timwe******************/

/*
//Timwe Api
Route::get('generateKey', 'TimeweController@generateKey');
Route::get('{channel}/mt/{partnerRoleId}', 'TimeweController@sendMt');
Route::get('subscription/optin/{partnerRoleId}', 'TimeweController@subscriptionOptIn');
Route::get('subscription/confirm/{partnerRoleId}', 'TimeweController@subscriptionConfirm');
Route::get('subscription/optout/{partnerRoleId}', 'TimeweController@subscriptionOptOut');
Route::get('subscription/success', 'TimeweController@subscriptionSuccess');
Route::get('unsubscribe/success', 'TimeweController@unsubscribeSuccess');
Route::get('rotana_flatter_get_link', 'TimeweController@rotana_flatter_get_link');
Route::post('notification/mo/{partnerRole}', 'TimeweController@notificationMo');
Route::post('notification/mt/dn/{partnerRole}', 'TimeweController@notificationMtDn');
Route::post('notification/user-optin/{partnerRole}', 'TimeweController@notificationUserOptin');
Route::post('notification/user-optout/{partnerRole}', 'TimeweController@notificationUserOptout');
Route::post('notification/user-renewed/{partnerRole}', 'TimeweController@notificationUserRenewed');
Route::post('notification/user_first-charging/{partnerRole}', 'TimeweController@userFirstCharging');
Route::post('notification/first-charge/{partnerRole}', 'TimeweController@userFirstCharging');
Route::get('send_today_link_per_each_service', 'TimeweController@send_today_link_per_each_service');
*/

/********************end ******************* */





/**************Start Orange**************/
/*  //testing
define('spId', '002401');
define('password', '3uKc3f1W');
define('service', '0024010001');
define('productId', '1000000577');
define('partnerId', '1000000577');
*/


// production //
define('spId', '006738');
define('password', '3sJ4YiK4');
define('service', '0067380001');
define('productId', '1000000577');
define('partnerId', '1000000577');
define("sendKenelApi",'http://10.2.10.15:8310/~smsorange/api/orange_elkheer_egypt_send_message');
define("ORANGEGETTODAYCONTENTLINK",'https://orange-elkheer.com/orange_get_today_content_link');






Route::post('subscription', 'OrangeController@subscription');

Route::post('subscription_curl', 'OrangeController@subscription_curl');
Route::post('subscription_curl_emad', 'OrangeController@subscription_curl_emad');
Route::post('subscription_test', 'OrangeController@subscription_response_test');

Route::post('provision_curl', 'OrangeController@provision_curl');
Route::post('provision_test', 'OrangeController@provision_response_test');

Route::post('charging_notify', 'OrangeController@charging_notify');
Route::get('ussd_notify', 'OrangeController@ussd_notify');   //  #215#

Route::get('sms_notify', 'OrangeController@sms_notify');
Route::post('web_notify', 'OrangeController@web_notify');

Route::post('checkStatus', 'Api\OrangeApiController@checkStatus');
Route::post('orangeWeb', 'Api\OrangeApiController@orangeWeb');

Route::get('testemail', 'Api\OrangeApiController@testemail');

// import whitelist numbers from excel
// Route::get('orange_whitelist', 'OrangeController@orange_whitelist');  // run only one after confirm

Route::get('orange_send_today_content', 'OrangeController@orange_send_today_content');

Route::get('get_orange_subscribers_not_receive_today_content','OrangeController@get_orange_subscribers_not_receive_today_content');
Route::get('orange_send_daily_deduction', 'OrangeController@orange_send_daily_deduction');

Route::get('orange_daily_deduction_message', 'OrangeController@orange_send_daily_deduction_message');


/***************************************/


//============================================== elforsan ==============================================//
//---------------- ----------------------//
define('elforsan_password', '3sJ4YiK4');
define('elforsan_service', '23');
define('elforsan_productId', '1000004448');
define('elforsan_sourceId', '99');




Route::post('elforsan_provision', 'ElforsanController@elforsan_provision');
Route::post('elforsanOrangeWeb', 'ElforsanController@elforsanOrangeWeb');


