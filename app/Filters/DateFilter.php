<?php
namespace App\Filters;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter implements Filter
{
    public function apply(Builder $builder, $filter)
    {

        return $builder->whereDate('created_at',  $filter);

    }
}
