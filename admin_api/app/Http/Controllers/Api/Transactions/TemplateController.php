<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Template;
use GrahamCampbell\ResultType\Success;
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
        $templates = [
            'incomes' => Template::where('type', '=', 'income')->get(), 
            'expenses' => Template::where('type', '=', 'expense')->get(), 
        ];
        return $templates;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactionTemplate = new Template();
        $transactionTemplate->name = $request->json('name');
        $transactionTemplate->type = $request->json('type');
        $value = $request->json('value');
        //double check if the sign matches the transactionTemplate type
        if($request->json('type') == 'expense' && $value > 0){
            $value *= -1;
        } elseif ($request->json('type') == 'income' && $value < 0){
            $value *= -1;
        }
        $transactionTemplate->value = $value;
        $transactionTemplate->save();
        return response($transactionTemplate, 201);
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
