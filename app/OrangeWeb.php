<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeWeb extends Model
{
    protected $table = 'orange_webs';
    protected $fillable = ['req','response','spId','sp_password','time_stamp','service_number','calling_party_id','selfcare_command','on_bearer_type','on_result_code'];
}
