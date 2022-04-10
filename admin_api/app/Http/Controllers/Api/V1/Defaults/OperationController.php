<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
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
    public function index(Request $request)
    {
        $data = $request->validate([
            KeyWords::FILTER => 'array',
            KeyWords::INCLUDE => 'array'
        ]);
        $query = Operation::queryRequest($data, KeyWords::FILTER,  KeyWords::INCLUDE);
        return OperationResource::collection($query->get());
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return OperationResource
     */
    public function show(Request $request, int $id)
    {
        $operation = Operation::queryRequest($request, KeyWords::INCLUDE)->find($id);
        if(!$operation) abort(404);
        return new OperationResource($operation);
    }
}
