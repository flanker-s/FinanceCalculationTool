<?php

namespace App\Http\Controllers\Api\V1\ClientResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ClientResources\Categories\IndexCategoryRequest;
use App\Http\Requests\Api\V1\ClientResources\Categories\ShowCategoryRequest;
use App\Http\Requests\Api\V1\ClientResources\Categories\StoreCategoryRequest;
use App\Http\Requests\Api\V1\ClientResources\Categories\UpdateCategoryRequest;
use App\Http\Resources\Api\V1\ClientResources\CategoryCollection;
use App\Http\Resources\Api\V1\ClientResources\CategoryResource;
use App\Models\ClientResources\Category;
use App\Models\ClientResources\Template;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexCategoryRequest $request
     * @return CategoryCollection
     */
    public function index(IndexCategoryRequest $request): CategoryCollection
    {
        $data = $request->validated();
        $query = Category::queryRequest($data);
        if(isset($request['paginate'])){
            return new CategoryCollection($query->paginate($request['paginate']));
        } else {
            return new CategoryCollection($query->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        return new CategoryResource(Category::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param ShowCategoryRequest $request
     * @param int $id
     * @return CategoryResource
     */
    public function show(ShowCategoryRequest $request, int $id): CategoryResource
    {
        $data = $request->validated();
        $category = Category::queryRequest($data)->find($id);
        if(!$category) abort(404);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, int $id): CategoryResource
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
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $category = Category::find($id);

        $operationId = $category->operation->id;
        $defaultCategory = Category::where('is_primary', true)->where('operation_id', $operationId)->first();
        Template::where('category_id', $id)->update(['category_id' => $defaultCategory->id]);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        Category::destroy($id);
        return response('category deleted', 204);
    }
}
