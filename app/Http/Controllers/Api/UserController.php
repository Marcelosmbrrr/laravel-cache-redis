<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Jobs\NotifyNewUserJob;

class UserController extends Controller
{
    function __construct(User $user)
    {
        $this->model = $user;
    }

    public function indexCache()
    {
        $users = Cache::rememberForever('users', function () {
            return $this->model->all();
        });

        return UserResource::collection($users);
    }

    public function indexNoCache()
    {
        $users = $this->model->all();

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->model->create($request->validated());

        Cache::forget('users');

        NotifyNewUserJob::dispatch($user)->onQueue('default');

        return new UserResource($user);
    }

    public function show(string $public_id)
    {
        $user = $this->model->where("public_id", $public_id)->firstOrFail();

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, string $public_id)
    {
        $user = $this->model->where("public_id", $public_id)->firstOrFail();

        Cache::forget('users');

        $user->update($request->validated());

        return response()->json(['message' => 'updated']);
    }

    public function destroy(string $public_id)
    {
        $user = $this->model->where("public_id", $public_id)->firstOrFail();
        $user->delete();

        Cache::forget('users');

        return response()->json([], 204);
    }
}
