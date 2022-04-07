<?php


namespace App\CustomPackages\QueryRequest\Traits;

use App\CustomPackages\Filter\Traits\Filterable;
use App\CustomPackages\QueryRequest\KeyWords;
use Illuminate\Database\Eloquent\Builder;

trait QueryRequest
{
    use Filterable;

    public function scopeQueryRequest(Builder $query, $request, ...$params) : Builder
    {
        if(in_array(KeyWords::FILTER, $params) && isset($request[KeyWords::FILTER])){
            $query->filter($request[KeyWords::FILTER]);
        }
        if(in_array(KeyWords::INCLUDE, $params) && isset($request[KeyWords::INCLUDE])){
            foreach ($request[KeyWords::INCLUDE] as $include) {
                $query->with($request[KeyWords::INCLUDE]);
            }
        }
        return $query;
    }
}
