<?php


namespace App\Http\Filters\Api\V1\Defaults;


use Illuminate\Database\Eloquent\Builder;

class CategoryFilter
{
    public function filterName(Builder $query, $value): Builder
    {
        return $query->where('name', 'like', "%{$value}%");
    }

    public function filterOperationId(Builder $query, $value): Builder
    {
        return $query->where('operation_id', $value);
    }
}
