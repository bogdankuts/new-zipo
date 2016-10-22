<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreUser;

class UserController extends Controller {

	public function userLogin() {
		\Auth::attempt([
			'password'	=> request()->input('password'),
			'email' 	=> request()->input('email')
		], true);

		return redirect()->route('index');
	}

	public function registrationPage() {

		return view('user-interface.registration');
	}

	public function registration(StoreUser $request) {
		$password = $request->password;
		unset($request['confirm']);
		$request['password'] = bcrypt($request->password);

		$user = User::create($request->all());

		\Auth::attempt([
			'password'	=> $password,
			'email' 	=> $user->email
		], true);

		return redirect()->route('index')
						 ->with('message', "Вы успешно зарегестрированы, $user->name $user->surname");
	}

	public function userLogout() {
		\Auth::logout();

		return redirect()->back();
	}

	public function feedback() {
		\Mail::to(env('MAIL_ADMIN_EMAIL'))->send(new Feedback(request()->all()));

		return redirect()->route('index')
		                 ->with('message', 'Спасибо за оставленное сообщение, Ваше мнение очень важно для нас!');
	}
}
