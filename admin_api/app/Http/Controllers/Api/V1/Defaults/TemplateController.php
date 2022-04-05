<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Defaults\TemplateResource;
use App\Models\Defaults\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'name' => 'string',
            'category_id' => '',
            'operation_id' => ''
        ]);
        $templates = Template::filter($data);
        return TemplateResource::collection($templates->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Api\v1\Defaults\TemplateResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        return new TemplateResource(Template::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TemplateResource
     */
    public function show(int $id)
    {
        $template = Template::find($id);
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
    public function update(Request $request, $id)
    {
        $template = Template::find($id);
        if(!$template) abort(404);
        $template->update($request->all());
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
