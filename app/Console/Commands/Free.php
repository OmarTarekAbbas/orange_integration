<?php

namespace App\Console\Commands;

use App\OrangeSubscribe;
use Illuminate\Console\Command;

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
        $subscriber->free = 0;
        $subscriber->save();
      }
      return 'done!';
    }
}
