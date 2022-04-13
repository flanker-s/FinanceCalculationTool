<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AbilityResource;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbilityController extends Controller
{
    public function index(Request $request){
        //Users can see only their own abilities
        //TODO: add comparing user abilities with db abilities
        $userAbilities = $request->user()->abilities;
        return AbilityResource::collection($userAbilities);
    }
}
