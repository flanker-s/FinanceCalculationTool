<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Defaults\Templates\IndexTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\ShowTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\StoreTemplateRequest;
use App\Http\Requests\Api\V1\Defaults\Templates\UpdateTemplateRequest;
use App\Http\Resources\Api\V1\Defaults\TemplateCollection;
use App\Http\Resources\Api\V1\Defaults\TemplateResource;
use App\Models\Defaults\Template;
use Illuminate\Http\Response;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexTemplateRequest $request
     * @return TemplateCollection
     */
    public function index(IndexTemplateRequest $request): TemplateCollection
    {
        $data = $request->validated();
        $query = Template::queryRequest($data);
        return new TemplateCollection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTemplateRequest $request
     * @return TemplateResource
     */
    public function store(StoreTemplateRequest $request): TemplateResource
    {
        $data = $request->validated();
        return new TemplateResource(Template::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param ShowTemplateRequest $request
     * @param int $id
     * @return TemplateResource
     */
    public function show(ShowTemplateRequest $request, int $id): TemplateResource
    {
        $data = $request->validated();
        $template = Template::queryRequest($data)->find($id);
        if(!$template) abort(404);
        return new TemplateResource($template);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTemplateRequest $request
     * @param int $id
     * @return TemplateResource
     */
    public function update(UpdateTemplateRequest $request, int $id): TemplateResource
    {
        $template = Template::find($id);
        if(!$template) abort(404);
        $template->update($request->validated());
        return new TemplateResource($template);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Template::destroy($id);
        return response('template deleted', 204);
    }
}
