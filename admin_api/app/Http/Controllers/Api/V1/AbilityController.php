<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\AbilityResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbilityController extends Controller
{
    public function index(){
        return AbilityResource::collection(Ability::all());
    }
}
