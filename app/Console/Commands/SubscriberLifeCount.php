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
      OrangeSubscribe::chunk(10000, function($subscribers)
      {
        foreach ($subscribers as $subscriber) {
          $date1 = new \DateTime(date("Y-m-d"));
          $date2 = new \DateTime($subscriber->created_at->format("Y-m-d"));
          $diff = $date1->diff($date2);
          $subscriber->life_count = $diff->format("%a") > 3 ? $diff->format("%a") - 3 : 0;
          $subscriber->save();
        }
      });

    }
}
