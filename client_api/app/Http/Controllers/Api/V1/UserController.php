<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Users\IndexUserRequest;
use App\Http\Requests\Api\V1\Users\StoreUserRequest;
use App\Http\Requests\Api\V1\Users\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexUserRequest $request
     * @return UserCollection
     */
    public function index(IndexUserRequest $request): UserCollection
    {
        $data = $request->validated();
        $query = User::where('is_primary', false)->queryRequest($data);
        if(isset($request['paginate'])){
            return new UserCollection($query->paginate($request['paginate']));
        } else {
            return new UserCollection($query->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
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
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = User::find($id);
        if($user->is_primary) abort(405);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, int $id): UserResource
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
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $user = User::find($id);

        if(!$user) abort(404);
        if($user->is_primary) abort(405);

        User::destroy($id);
        return response('user deleted', 204);
    }
}
