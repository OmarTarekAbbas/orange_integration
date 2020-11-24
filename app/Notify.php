<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notify';
    protected $fillable = ['actionName','url','headers', 'request', 'response'];
}
