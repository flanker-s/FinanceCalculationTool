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
     * @param string $operationType
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($operationType)
    {
        $categories = Category::where('operation_type', $operationType)->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request, string $operationType)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'operation_type' => $operationType
        ]);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param string $operationType
     * @param int $categoryId
     * @return CategoryResource
     */
    public function show(string $operationType, int $categoryId)
    {
        $category = Category::with('templates')->find($categoryId);
        if (!$category || $category->operation_type != $operationType) abort(404);
        return new CategoryResource($category);
    }
}
