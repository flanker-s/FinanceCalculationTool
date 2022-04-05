<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Defaults\CategoryResource;
use App\Models\Defaults\Category;
use Illuminate\Http\Request;

class OperationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $operation
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($operationId)
    {
        $categories = Category::where('operation_id', $operationId)->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request, string $operationId)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'operation_id' => $operationId
        ]);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param string $operation
     * @param int $categoryId
     * @return CategoryResource
     */
    public function show(string $operationId, int $categoryId)
    {
        $category = Category::with('templates')->find($categoryId);
        if (!$category || $category->operation_id != $operationId) abort(404);
        return new CategoryResource($category);
    }
}
