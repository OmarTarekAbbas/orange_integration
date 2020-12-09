<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeCharging extends Model
{
    protected $fillable = ['req','response','action','msisdn','service_id','notification_result'];
}
