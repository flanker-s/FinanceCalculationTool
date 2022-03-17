<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\CategoryResource;
use App\Models\Templates\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CategoryResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(int $id)
    {
        return new CategoryResource(Category::with('templates')->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return CategoryResource
     */
    public function update(Request $request, int $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //TODO: add soft delete
        Category::destroy($id);
        return response('item deleted', 204);
    }
}
