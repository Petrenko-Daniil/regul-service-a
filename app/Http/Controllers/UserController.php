<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SearchUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->paginate(20);
        return response()->json(UserResource::collection($users));
    }

    public function searchBy(SearchUserRequest $request)
    {
        try {
            $user = User::query()
                ->where($request->field, $request->value)
                ->firstOrFail();
            return new UserResource($user);
        } catch (ModelNotFoundException $exception){
            return response($exception->getMessage(), 404);
        }
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return response(new UserResource($user), 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response(null, 204);
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (LogicException $exception){
            return response($exception->getMessage(), 500);
        }
        return response(null, 204);
    }
}
