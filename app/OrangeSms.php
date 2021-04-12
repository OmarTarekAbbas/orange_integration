<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeSms extends Model
{
  protected $fillable = ['msisdn', 'service_id'];
}
