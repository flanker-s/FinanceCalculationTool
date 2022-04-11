<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Defaults\Operations\IndexOperationRequest;
use App\Http\Requests\Api\V1\Defaults\Operations\ShowOperationRequest;
use App\Http\Resources\Api\v1\Defaults\OperationResource;
use App\Http\Resources\Api\v1\Defaults\TemplateResource;
use App\Models\Defaults\Operation;
use App\Models\Defaults\Template;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display all expenses.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexOperationRequest $request)
    {
        $data = $request->validated();
        $query = Operation::queryRequest($data);
        return OperationResource::collection($query->get());
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return OperationResource
     */
    public function show(ShowOperationRequest $request, int $id)
    {
        $data = $request->validated();
        $operation = Operation::queryRequest($data)->find($id);
        if(!$operation) abort(404);
        return new OperationResource($operation);
    }
}
