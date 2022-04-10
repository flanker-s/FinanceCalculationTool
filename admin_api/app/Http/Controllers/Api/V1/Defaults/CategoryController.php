<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Defaults\CategoryResource;
use App\Models\Defaults\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            KeyWords::FILTER => 'array',
            KeyWords::INCLUDE => 'array'
        ]);
        $query = Category::queryRequest($data, KeyWords::FILTER,  KeyWords::INCLUDE);
        return CategoryResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'operation_id' => 'required',
        ]);
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(Request $request, int $id)
    {
        $category = Category::queryRequest($request, KeyWords::INCLUDE)->find($id);
        if(!$category) abort(404);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return CategoryResource
     */
    public function update(Request $request, int $id)
    {
        $category = Category::find($id);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = Category::find($id);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        Category::destroy($id);
        return response('item deleted', 204);
    }
}
