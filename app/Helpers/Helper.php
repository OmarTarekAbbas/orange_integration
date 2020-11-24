<?php
namespace App\Helpers;

use App\Setting;
use Illuminate\Support\Facades\Schema;

class Helper {

    public static function time() {

        $time = array(
            ''=>'',
            '12:00'=>'12:00 PM',
            '18:00'=>'6:00 PM',
            '21:00'=>'9:00 PM'
        );

        return $time ;

    }

    public static function get_setting($key)
    {
        if (Schema::hasTable('settings')) {
            $setting = Setting::where('key', $key)->first();

            if($setting){
                return $setting->value;
            }
            return false;
        }
    }

}
?>
