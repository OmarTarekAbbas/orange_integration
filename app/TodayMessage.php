<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodayMessage extends Model
{
    protected $fillable = ['message', 'msisdn', 'type'];
}
