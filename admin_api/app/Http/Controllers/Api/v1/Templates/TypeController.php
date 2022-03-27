<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\TemplateResource;
use App\Models\Templates\Template;

class TypeController extends Controller
{
    /**
     * Display all expenses.
     *
     * @return string[][]
     */
    public function index()
    {
        return [
            'data' => [
                0 => 'expense',
                1 => 'income'
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param string $operationType
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show(string $operationType)
    {
        $templates = Template::whereHas('category', function ($query) use ($operationType) {
            $query->where('operation_type', $operationType);
        })->paginate(10);
        if (!$templates) abort(404);
        return TemplateResource::collection($templates);
    }
}
