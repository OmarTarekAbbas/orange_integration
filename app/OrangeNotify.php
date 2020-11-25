<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeNotify extends Model
{
    protected $table = 'orange_notifies';
    protected $fillable = ['req','response','action','msisdn','service_id','notification_result'];
}
