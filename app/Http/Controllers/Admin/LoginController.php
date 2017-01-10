<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

	public function login() {
		$credentials = [
			'password'	=> request()->get('password'),
			'login' 	=> request()->get('login')
		];

		if (\Auth::guard('admin')->attempt($credentials, true)) {

			return redirect()->route('dashboard');
		} else {

			return redirect()->back()->withErrors('Неверный логин или пароль!');
		}
	}

	public function logout() {
		\Auth::guard('admin')->logout();

		return redirect()->route('admin_login');
	}

	public function loginPage() {

		return view('admin.login.login');
	}
}
