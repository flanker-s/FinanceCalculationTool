<?php

namespace App\Models\Templates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
