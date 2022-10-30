<?php

namespace App\Http\Controllers\Api\V1\ClientResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ClientResources\Operations\IndexOperationRequest;
use App\Http\Requests\Api\V1\ClientResources\Operations\ShowOperationRequest;
use App\Http\Resources\Api\V1\ClientResources\OperationCollection;
use App\Http\Resources\Api\V1\ClientResources\OperationResource;
use App\Models\ClientResources\Operation;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexOperationRequest $request
     * @return OperationCollection
     */
    public function index(IndexOperationRequest $request): OperationCollection
    {
        $data = $request->validated();
        $query = Operation::queryRequest($data);
        return new OperationCollection($query->get());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowOperationRequest $request
     * @param int $id
     * @return OperationResource
     */
    public function show(ShowOperationRequest $request, int $id): OperationResource
    {
        $data = $request->validated();
        $operation = Operation::queryRequest($data)->find($id);
        if(!$operation) abort(404);
        return new OperationResource($operation);
    }
}
