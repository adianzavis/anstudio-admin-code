<?php

namespace App\Admin;

use Illuminate\Http\Request;
use App\Core\Controller;

class StaticPageController extends Controller {
	public function dashboard(Request $request) {
		return view('admin.dashboard', [
			'layout' => 'side-menu',
		]);
	}
}
