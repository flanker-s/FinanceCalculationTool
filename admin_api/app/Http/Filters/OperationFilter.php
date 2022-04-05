<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class OperationFilter
{
    public function filterName(Builder $query, $value)
    {
        return $query->where('name', 'like', "%{$value}%");
    }
}
