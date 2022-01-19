<?php

namespace App\Users;

use App\Core\Controller;
use App\Users\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Departments\Department;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index(Request $request) {
        return view('admin.users.index', [
            'layout' => 'side-menu',
        ]);
    }

    public function create(Request $request, User $user) {
        return view('admin.users.create', [
            'layout' => 'side-menu',
            'departments' => Department::all()->pluck('name', 'id'),
        ]);
    }

    public function store(CreateUserRequest $request) {
        $mediator = new UserMediator($request->all());
        $user = $mediator->create();

        return redirect()->route('admin.user.show', $user);
    }

    public function show(Request $request, User $user) {
        return view('admin.users.show', [
            'layout' => 'side-menu',
            'user' => $user,
        ]);
    }

    public function edit(Request $request, User $user) {
        return view('admin.users.edit', [
            'layout' => 'side-menu',
            'user' => $user,
            'departments' => Department::all()->pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, User $user) {
        $mediator = new UserMediator($request->all(), $user);
        $mediator->update();

        return redirect()->route('admin.user.show', $user)->with('success', 'User has been updated');
    }

    public function avatar(Request $request, User $user) {
        if (!Storage::disk('local')->exists($user->avatar) || !Auth::user()) {
            abort(404);
        }

        return Storage::download($user->avatar);
    }
}
