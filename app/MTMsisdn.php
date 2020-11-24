<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class MTMsisdn extends Model
{
    use Filterable;

    protected $table = 'mt_msisdns';
    protected $fillable = ['msisdn', 'service_id', 'link', 'send_status', 'request_id'];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id', 'id');
    }
}
