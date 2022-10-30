<?php

namespace App\Models;

use App\CustomPackages\QueryRequest\Traits\QueryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    use QueryRequest;

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'ability_user',
            'ability_id',
            'user_id'
        );
    }
}
