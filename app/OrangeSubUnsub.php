<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangeSubUnsub extends Model
{
  protected $table = 'orange_sub_unsubs';
  protected $fillable = ['req','response','spId','sp_password','time_stamp','service_number','calling_party_id','selfcare_command','on_bearer_type','on_result_code'];
}
