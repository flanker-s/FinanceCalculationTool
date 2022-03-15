<?php

namespace App\Http\Controllers\Api\v1\Templates;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Templates\TemplateResource;
use App\Models\Templates\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TemplateResource::collection(Template::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $transactionTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(Template $transactionTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $transactionTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $transactionTemplate)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $transactionTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $transactionTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $transactionTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $transactionTemplate)
    {
        //
    }
}
