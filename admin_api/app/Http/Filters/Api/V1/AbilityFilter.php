<?php


namespace App\Http\Filters\Api\V1;


use Illuminate\Database\Eloquent\Builder;

class AbilityFilter
{
    public function filterName(Builder $query, $value): Builder
    {
        return $query->where('name', 'like', "%{$value}%");
    }
}
