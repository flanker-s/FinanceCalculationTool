<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Defaults\Categories\IndexCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\ShowCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\StoreCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\UpdateCategoryRequest;
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
    public function index(IndexCategoryRequest $request)
    {
        $data = $request->validated();
        $query = Category::queryRequest($data, KeyWords::FILTER,  KeyWords::INCLUDE);
        return CategoryResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        return new CategoryResource(Category::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(ShowCategoryRequest $request, int $id)
    {
        $data = $request->validated();
        $category = Category::queryRequest($data, KeyWords::INCLUDE)->find($id);
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
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = Category::find($id);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        $category->update($request->validated());
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
