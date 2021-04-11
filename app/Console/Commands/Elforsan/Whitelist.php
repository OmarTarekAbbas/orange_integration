<?php

namespace App\Console\Commands\Elforsan;

use Illuminate\Console\Command;
use App\OrangeSubscribe;
use App\OrangeWhitelist;

class Whitelist extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'elforsan_whitelist';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Store Elforsan Whitelist';

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
    set_time_limit(0);

    $path = base_path() . "/ElforsanWhitelist/ElforsanWhitelist.xlsx";

    $data = \Excel::load($path)->get();

    \Excel::filter('chunk')->load($path)->chunk(1000, function ($results) {
      if (!empty($results) && $results->count()) {
        foreach ($results as $value) {
          if (strlen($value->mob)  > 8) {
            $orange_whitelist_item = OrangeWhitelist::where('msisdn', "2" . $value->mob)->first();
            if (!isset($orange_whitelist_item)) {
              $orange = new OrangeWhitelist;
              $orange->msisdn = "2" . $value->mob;
              $orange->save();
            } else {
              $orange = $orange_whitelist_item;
            }


            $orange_subscribe_item = OrangeSubscribe::where('msisdn', "2" . $value->mob)->first();
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
