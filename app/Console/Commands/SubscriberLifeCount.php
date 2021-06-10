<?php

namespace App\Console\Commands;

use App\OrangeSubscribe;
use Illuminate\Console\Command;

class SubscriberLifeCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriber:lifecount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update life count for all subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $subscribers = OrangeSubscribe::all();
      foreach ($subscribers as $key => $subscriber) {
        $datetime1 = strtotime($subscriber->created_at->format("Y-m-d"));
        $datetime2 = strtotime(date("Y-m-d"));
        $secs = $datetime2 - $datetime1;// == return sec in difference
        $days = $secs / 86400;
        $subscriber->life_count = $days;
        $subscriber->save();
      }
    }
}
