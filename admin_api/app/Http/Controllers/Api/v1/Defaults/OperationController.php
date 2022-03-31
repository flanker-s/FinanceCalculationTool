<?php

namespace App\Http\Controllers\Api\v1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Defaults\OperationResource;
use App\Http\Resources\Api\v1\Defaults\TemplateResource;
use App\Models\Defaults\Operation;
use App\Models\Defaults\Template;

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
