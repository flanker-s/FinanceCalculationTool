<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\TemplateResource;
use App\Models\Templates\Category;
use App\Models\Templates\Template;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display all expenses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'data' => [
                0 => 'expense',
                1 => 'income'
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        return TemplateResource::collection(Template::whereHas('category', function($query) use($type){
            $query->where('type', $type);
        })->paginate(10));
    }
}
