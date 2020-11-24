<?php
namespace App\Filters;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ServiceFilter implements Filter
{
    public function apply(Builder $builder, $filter)
    {

        return $builder->where('service_id',  $filter);

    }
}
