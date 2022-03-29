<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\CategoryResource;
use App\Models\Templates\Category;
use Illuminate\Http\Request;

class OperationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $operation
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($operation)
    {
        $categories = Category::where('operation', $operation)->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request, string $operation)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'operation' => $operation
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
    public function show(string $operation, int $categoryId)
    {
        $category = Category::with('templates')->find($categoryId);
        if (!$category || $category->operation != $operation) abort(404);
        return new CategoryResource($category);
    }
}
