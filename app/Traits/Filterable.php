<?php
namespace App\Traits;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Can be filtered
 */
trait Filterable
{
    public function scopeFilter(Builder $builder, $filters)
    {
        $filter = new BaseFilter(request());
        return $filter->apply($builder, $filters);
    }
}
