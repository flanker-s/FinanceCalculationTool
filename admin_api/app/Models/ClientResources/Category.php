<?php

namespace App\Models\ClientResources;

use App\CustomPackages\QueryRequest\Traits\QueryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryRequest;

    protected $fillable = ['name', 'operation_id'];

    public function operation(){
        return $this->belongsTo(Operation::class);
    }

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
