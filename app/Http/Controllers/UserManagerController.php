<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserManagerController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        Gate::authorize('create', User::class);
        return view('user.create');
    }
    public function store(StoreUserRequest $request)
    {
        Gate::authorize('create', User::class);
        $data = $request->validated();
        $user = User::create($data);
        return to_route('users.show', $user);
    }
    public function show(User $user)
    {
        Gate::authorize('view', $user);
        return view('user.show', ['user' => $user]);
    }
    public function edit(User $user)
    {
        Gate::authorize('update', $user);
        return view('user.edit', ['user' => $user]);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return to_route('users.show', $user)->with('success', 'user updated');
    }


    public function destroy(User $user)
    {
        logger()->info("Attempting to delete user: {$user->id}");

        Gate::authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index');
    }

}
