<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Abilities\IndexAbilityRequest;
use App\Http\Requests\Api\V1\Abilities\ShowAbilityRequest;
use App\Http\Resources\Api\V1\AbilityCollection;
use App\Http\Resources\Api\V1\AbilityResource;
use App\Models\Ability;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexAbilityRequest $request
     * @return AbilityCollection
     */
    public function index(IndexAbilityRequest $request): AbilityCollection
    {
        $data = $request->validated();
        $abilities = Ability::queryRequest($data)->get();
        return new AbilityCollection($abilities);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowAbilityRequest $request
     * @param int $id
     * @return AbilityResource
     */
    public function show(ShowAbilityRequest $request, int $id): AbilityResource
    {
        $data = $request->validated();
        $ability = Ability::queryRequest($data)->find($id);
        if(!$ability) abort(404);
        return new AbilityResource($ability);
    }
}
