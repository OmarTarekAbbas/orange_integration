<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeUssd extends Model
{
    protected $table = 'orange_ussds';
    protected $fillable = ['req','response','language','msisdn','service_id','host'];
}
