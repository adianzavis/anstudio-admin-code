<?php

namespace App\Providers;

use App\Http\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		View::composer('profile', ProfileComposer::class);

		View::composer('admin.*', \App\View\Composers\MenuComposer::class);
		View::composer('admin.*', \App\View\Composers\FakerComposer::class);
		View::composer('admin.*', \App\View\Composers\DarkModeComposer::class);
		View::composer('admin.*', \App\View\Composers\LoggedInUserComposer::class);
	}
}
