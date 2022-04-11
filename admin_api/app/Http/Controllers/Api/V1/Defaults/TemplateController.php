<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Defaults\Templates\IndexTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\ShowTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\StoreTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\UpdateTemplateRequest;
use App\Http\Resources\Api\v1\Defaults\TemplateResource;
use App\Models\Defaults\Template;
use Illuminate\Http\Request;
use App\CustomPackages\QueryRequest\KeyWords;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexTemplateRequest $request)
    {
        $data = $request->validated();
        $query = Template::queryRequest($data);
        return TemplateResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Api\v1\Defaults\TemplateResource
     */
    public function store(StoreTemplateRequest $request)
    {
        $data = $request->validated();
        return new TemplateResource(Template::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TemplateResource
     */
    public function show(int $id, ShowTemplateRequest $request)
    {
        $data = $request->validated();
        $template = Template::queryRequest($data)->find($id);
        if(!$template) abort(404);
        return new TemplateResource($template);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \App\Http\Resources\Api\v1\Defaults\TemplateResource
     */
    public function update(UpdateTemplateRequest $request, $id)
    {
        $template = Template::find($id);
        if(!$template) abort(404);
        $template->update($request->validated());
        return new TemplateResource($template);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Template::destroy($id);
        return response('item deleted', 204);
    }
}
