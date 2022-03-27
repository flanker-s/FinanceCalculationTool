<?php

namespace App\Models\Templates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'operation_type'];

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
