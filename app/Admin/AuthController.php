<?php

namespace App\Admin;

use App\Core\Controller;
use App\Users\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
	public function create(Request $request) {
		return view('admin.login-form', [
			'layout' => 'login',
		]);
	}

	public function store(LoginRequest $request) {
		$request->authenticate();
		$request->session()->regenerate();
		return redirect()->route('admin.dashboard');
	}

	public function destroy(Request $request) {
		Auth::guard('admin')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route('auth.login');
	}
}
