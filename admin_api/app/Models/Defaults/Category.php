<?php

namespace App\Models\Defaults;

use App\CustomPackages\Filter\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = ['name', 'operation_id'];

    public function operation(){
        return $this->belongsTo(Operation::class);
    }

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
