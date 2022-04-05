<?php

namespace App\Http\Controllers\Api\v1\Defaults;

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
           'name' => 'string'
        ]);
        $operations = Operation::filter($data);
        return OperationResource::collection($operations->get());
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return OperationResource
     */
    public function show(int $id)
    {
        $operation = Operation::find($id);
        if(!$operation) abort(404);
        return new OperationResource($operation);
    }
}
