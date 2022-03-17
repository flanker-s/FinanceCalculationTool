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
     * @param string $type
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($type)
    {
        $categories = Category::where('type', $type)->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'type' => $type
        ]);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param string $type
     * @param int $categoryId
     * @return CategoryResource
     */
    public function show(string $type, int $categoryId)
    {
        $category = Category::with('templates')->find($categoryId);
        if (!$category || $category->type != $type) abort(404);
        return new CategoryResource($category);
    }
}
