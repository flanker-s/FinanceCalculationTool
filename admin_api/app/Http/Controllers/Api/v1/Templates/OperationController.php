<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\OperationResource;
use App\Http\Resources\Api\v1\Templates\TemplateResource;
use App\Models\Templates\Operation;
use App\Models\Templates\Template;

class OperationController extends Controller
{
    /**
     * Display all expenses.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OperationResource::collection(Operation::all());
    }

    /**
     * Display the specified resource.
     *
     * @param string $operation
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show(int $operationId)
    {
        $templates = Template::whereHas('category', function ($query) use ($operationId) {
            $query->where('operation_id', $operationId);
        })->paginate(10);
        if (!$templates) abort(404);
        return TemplateResource::collection($templates);
    }
}
