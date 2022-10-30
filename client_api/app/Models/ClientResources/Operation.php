<?php

namespace App\Models\ClientResources;

use App\CustomPackages\QueryRequest\Traits\QueryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    use QueryRequest;

    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function templates(){
        return $this->hasManyThrough(Template::class, Category::class);
    }
}
