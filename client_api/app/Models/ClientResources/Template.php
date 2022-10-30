<?php

namespace App\Models\ClientResources;

use App\CustomPackages\QueryRequest\Traits\QueryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class Template extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToThrough;
    use QueryRequest;

    protected $fillable = ['name', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function operation(){
        return $this->belongsToThrough(Operation::class, Category::class);
    }
}
