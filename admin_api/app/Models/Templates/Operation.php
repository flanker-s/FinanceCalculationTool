<?php

namespace App\Models\Templates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
