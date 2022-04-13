<?php

namespace App\Http\Controllers\Api\V1;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Users\IndexUserRequest;
use App\Http\Requests\Api\V1\Users\StoreUserRequest;
use App\Http\Requests\Api\V1\Users\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index(IndexUserRequest $request)
    {
        $data = $request->validated();
        $query = User::where('is_primary', false);
        $users = $query->queryRequest($data)->get();
        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if(isset($data['abilities'])){
            $user->abilities()->attach($data['abilities']);
        }
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user->is_primary) abort(405);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if(!$user) abort(404);
        if($user->is_primary) abort(405);

        $data = $request->validated();
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        if(isset($data['abilities'])){
            $user->abilities()->sync($data['abilities']);
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user) abort(404);
        if($user->is_primary) abort(405);

        User::destroy($id);
        return response('user deleted', 204);;
    }
}
