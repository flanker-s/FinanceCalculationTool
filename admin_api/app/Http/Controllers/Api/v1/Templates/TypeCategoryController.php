<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\CategoryResource;
use App\Models\Templates\Category;
use Illuminate\Http\Request;

class TypeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        return Category::where('type', $type)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function show($type, $categoryId)
    {
        $category = Category::find($categoryId);
        if($category && $category->type == $type)
        {
            return new CategoryResource($category);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
