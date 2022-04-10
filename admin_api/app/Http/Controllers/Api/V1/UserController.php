<?php

namespace App\Http\Controllers\Api\V1;

use App\CustomPackages\QueryRequest\KeyWords;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            KeyWords::FILTER
        ]);
        $query = User::where('is_primary', false);
        $users = $query->queryRequest($data, KeyWords::FILTER)->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);
        return new UserResource(User::create($data));
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user) abort(404);
        if($user->is_primary) abort(405);

        $user->update($request->all());
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

        User::destroy($user);
        return response('user deleted', 204);;
    }
}
