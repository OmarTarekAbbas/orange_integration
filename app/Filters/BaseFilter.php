<?php
namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BaseFilter
{
    private $request;

    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    public function apply(Builder $builder, array $filters)
    {

        $filters = $this->filterFilters($filters);

        foreach ($filters as $key => $value){
            if(!$value instanceof Filter){
              continue;
            }
            if($this->request->has($key) && $this->request->$key != ''){
                $filter = $this->request->$key;
                $value->apply($builder, $filter);
            }
        }

        return $builder;

    }

    public function filterFilters(array $filters)
    {

        $filters = array_only($filters, array_keys($this->request->all()));

        return $filters;

    }
}
