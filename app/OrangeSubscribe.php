<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeSubscribe extends Model
{
    protected $table = 'orange_subscribes';
    protected $fillable = ['msisdn','active','orange_notify_id','table_name'];
}
