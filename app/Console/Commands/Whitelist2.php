<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\OrangeSubscribe;
use App\OrangeWhitelist;

class Whitelist2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orange_whitelist_2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Orange Whitelist';

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
      $path = base_path() . "/OrangeWhitelist/whitelist_2/whitelist_2.xlsx";

      \Excel::filter('chunk')->load($path)->chunk(1000, function ($results) {
        if (!empty($results) && $results->count()) {
          foreach ($results as $value) {
            if (strlen($value->phone_number)  > 8) {
              $orange_whitelist_item = OrangeWhitelist::where('msisdn', "2" . $value->phone_number)->first();
              if (!isset($orange_whitelist_item)) {
                $orange = new OrangeWhitelist;
                $orange->msisdn = "2" . $value->phone_number;
                $orange->save();
              } else {
                $orange = $orange_whitelist_item;
              }


              $orange_subscribe_item = OrangeSubscribe::where('msisdn', "2" . $value->phone_number)->first();
              if (!isset($orange_subscribe_item)) {
                $orange_subscribe = new OrangeSubscribe;
                $orange_subscribe->msisdn = $orange->msisdn;
                $orange_subscribe->active = 1;  // charging modify
                $orange_subscribe->orange_channel_id = $orange->id;
                $orange_subscribe->table_name = "orange_whitelists";
                $orange_subscribe->free = 1;
                $orange_subscribe->service_id = productId;
                $orange_subscribe->type = "whitelists";
                $orange_subscribe->save();
              } else {
                $orange_subscribe_item->orange_channel_id = $orange->id;
                $orange_subscribe_item->save();
              }
            }
          }
        }
      });

      echo "Ok";
    }
}
