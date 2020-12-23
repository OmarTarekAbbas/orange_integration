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





Route::post('subscription', 'OrangeController@subscription');

Route::post('subscription_curl', 'OrangeController@subscription_curl');
Route::post('subscription_curl_emad', 'OrangeController@subscription_curl_emad');
Route::post('subscription_test', 'OrangeController@subscription_response_test');

Route::post('provision_curl', 'OrangeController@provision_curl');
Route::post('provision_test', 'OrangeController@provision_response_test');

Route::post('charging_notify', 'OrangeController@charging_notify');
Route::get('ussd_notify', 'OrangeController@ussd_notify');

Route::get('sms_notify', 'OrangeController@sms_notify');
Route::post('web_notify', 'OrangeController@web_notify');

Route::post('checkStatus', 'Api\OrangeApiController@checkStatus');
Route::post('orangeWeb', 'Api\OrangeApiController@orangeWeb');


/***************************************/



