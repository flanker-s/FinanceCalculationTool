<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
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
        return ['types' => [
            0 => 'income',
            1 => 'expanse'
        ]];
    }
    
    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        return Template::where('type', $type)->get();
    }
}
