<?php
namespace App\Filters;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter implements Filter
{
    public function apply(Builder $builder, $filter)
    {
        switch ($filter) {
            case 1:
                return $builder->where('send_status', 'SUCCESS');

            default:
                return $builder->whereNotIn('send_status', ['SUCCESS']);
        }
    }
}
