<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\OrangeSubscribe;
use App\OrangeWhitelist;

class Whitelist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orange_whitelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Orange Whitelist';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      set_time_limit(0);
      $path= base_path(). "/OrangeWhitelist/Whitelisted_dials.xlsx";

      $data = \Excel::load($path)->get();

      foreach ($data as $value) {

        if (!empty($data) && $data->count()  && strlen($value->mob)  > 8 ) {
          $orange_whitelist_item = OrangeWhitelist::where('msisdn', "2".$value->mob)->first();
          if(!isset($orange_whitelist_item) || $orange_whitelist_item==null){
            $orange = new OrangeWhitelist;
            $orange->msisdn = "2".$value->mob;
            $orange->save();

            $orange_subscribe = new OrangeSubscribe;
            $orange_subscribe->msisdn = $orange->msisdn;
            $orange_subscribe->active = 1;  // charging modify
            $orange_subscribe->orange_channel_id = $orange->id;
            $orange_subscribe->table_name = "orange_whitelists";
            $orange_subscribe->free = 1;
            $orange_subscribe->service_id = productId;
            $orange_subscribe->type = "whitelists";
            $orange_subscribe->save();
          }
        }
      }
      echo "Ok";
    }

}
