<?php


namespace App\Http\Filters\Api\V1;


use Illuminate\Database\Eloquent\Builder;

class UserFilter
{
    public function filterName(Builder $query, $value)
    {
        return $query->where('name', 'like', "%{$value}%");
    }

    public function filterEmail(Builder $query, $value)
    {
        return $query->where('email', 'like', "%{$value}%");
    }
}
