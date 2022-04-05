<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Defaults\TemplateResource;
use App\Models\Defaults\Category;
use App\Models\Defaults\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $operation
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($operationId)
    {
        $templates = Template::whereHas('category', function($query) use ($operationId){
            $query->where('operation_id', $operationId);
        })->get();
        return TemplateResource::collection($templates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return TemplateResource
     */
    public function store(Request $request, string $operationId)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::where([
            ['isPrimary', '=', true],
            ['operation_id', '=', $operationId]
            ])->first();
        $template = Template::create([
            'name' => $request->name,
            'category_id' => $category->id
        ]);
        return new TemplateResource($template);
    }

    /**
     * Display the specified resource.
     *
     * @param string $operation
     * @param int $templateId
     * @return TemplateResource
     */
    public function show(string $operationId, int $templateId)
    {
        $template = Template::find($templateId);
        if(!$template || $template->category->operation_id != $operationId){
            abort(404);
        }
        return new TemplateResource($template);
    }
}
