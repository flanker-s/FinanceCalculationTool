<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Abilities\IndexAbilityRequest;
use App\Http\Requests\Api\V1\Abilities\ShowAbilityRequest;
use App\Http\Resources\Api\V1\AbilityResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbilityController extends Controller
{
    public function index(IndexAbilityRequest $request)
    {
        $data = $request->validated();
        $abilities = Ability::queryRequest($data)->get();
        return AbilityResource::collection($abilities);
    }

    public function show(ShowAbilityRequest $request, $id)
    {
        $data = $request->validated();
        $ability = Ability::queryRequest($data)->find($id);
        if(!$ability) abort(404);
        return new AbilityResource($ability);
    }
}
