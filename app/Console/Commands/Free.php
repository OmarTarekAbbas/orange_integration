<?php

namespace App\Console\Commands;

use App\OrangeSubscribe;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class Free extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe_free';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ending free trial';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

          // send email
          $subject = 'Ivas Send Due Date subscribers to Elforsan service after 2 days';
          $email = 'emad@ivas.com.eg';
          $this->sendMail($subject, $email);

      $orange_subscribes = OrangeSubscribe::where('subscribe_due_date', date("Y-m-d"))->where('free', 1)->get();
      foreach($orange_subscribes as $subscriber){
        // should make subscription request on orange as free 2 days is ended

        $orangeWeb = new Request;
        $orangeWeb->service_id = productId;
        $orangeWeb->msisdn = $subscriber->msisdn;
        $orangeWeb->command = 'SUBSCRIBE';
        $orangeWeb->bearer_type = 'WEB';

        $orange_subscription_code = app('App\Http\Controllers\Api\OrangeApiController')->orangeWeb($orangeWeb);

      /* =================  Orange status code for sub / unsub api ===================
      0	success
      1	already subscribed
      2	not subscribed
      5	not allowed
      6	account problem
      31	Technical problem
      */

        $subscriber->free = 0;
        $subscriber->active = ( $orange_subscription_code == "0" || $orange_subscription_code == "1" ) ? 1:0;  // need to be handle  ( 0 or 1  =>active = 1)
        $subscriber->save();

        // send message to the user notify that free trials will end today
        $expire_message = "باقة الفرسان اللي انت مشترك فيها وبتجيلك كل يوم من أورانج هتتجدد من بكره ب 1 جنيه فى اليوم، واستهلاك الإنترنت سوف يخصم من الباقة الخاصة بك، ولإلغاء الإشتراك ارسل unsub_forsan إلى 6124 مجانا.";
        $orange_subscription_code = app('App\Http\Controllers\OrangeController')->sendMessageToUser($subscriber->msisdn,$expire_message);

      }
      echo 'subscribe_free done!';
    }


    public function sendMail($subject, $email) {

      // send mail
      $message = '<!DOCTYPE html>
        <html lang="en-US">
          <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          </head>
          <body>
            <h2>' . $subject . '</h2>
          </body>
        </html>';

      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From:  ' . $email;
      @mail($email, $subject, $message, $headers);
  }

}
