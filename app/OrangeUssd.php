<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeUssd extends Model
{
    protected $table = 'orange_ussds';
    protected $fillable = ['req','response','language','msisdn','session_id','host'];
}
