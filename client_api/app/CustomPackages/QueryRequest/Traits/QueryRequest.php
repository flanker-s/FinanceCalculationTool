<?php


namespace App\CustomPackages\QueryRequest\Traits;

use App\CustomPackages\Filter\Traits\Filterable;
use App\CustomPackages\QueryRequest\KeyWords;
use Illuminate\Database\Eloquent\Builder;

trait QueryRequest
{
    use Filterable;

    public function scopeQueryRequest(Builder $query, $request): Builder
    {
        if (isset($request[KeyWords::FILTER])) {
            $query->filter($request[KeyWords::FILTER]);
        }
        if (isset($request[KeyWords::INCLUDE])) {
            $query->with($request[KeyWords::INCLUDE]);
        }
        if (isset($request[KeyWords::SORT])) {
            $sort = explode('-', $request[KeyWords::SORT]);
            $query->orderBy($sort[0], $sort[1]);
        }
        return $query;
    }
}
