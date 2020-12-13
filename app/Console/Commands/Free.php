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
      $orange_subscribes = OrangeSubscribe::where('subscribe_due_date', date("Y-m-d"))->where('free', 1)->get();
      foreach($orange_subscribes as $subscriber){
        // should make subscription request on orange as free 2 days is ended

        $orangeWeb = new Request;
        $orangeWeb->service_id = service;
        $orangeWeb->msisdn = $subscriber->msisdn;
        $orangeWeb->command = 'Subscribe';
        $orangeWeb->bearer_type = 'WEB';

        $orange_subscription_code = app('App\Http\Controllers\Api\OrangeApiController')->orangeWeb($orangeWeb);

        $subscriber->free = 0;
        $subscriber->active = $orange_subscription_code == "0"?1:0;
        $subscriber->save();

      }
      echo 'subscribe_free done!';
    }
}
