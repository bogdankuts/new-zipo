<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Order;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

	public function users() {
		$users = new User;
		$users = $users->getAllUsers();

		return view('admin.users.users')->with([
			'users' => $users,
		]);
	}

	public function user($id) {
		$user = new User;
		$user = $user->getDetailedUser($id);
		$client = Client::where('registered', $id)->first();

		if(!is_null($client)) {
			$client_orders = new Order;
			$client_orders = $client_orders->getAllOrdersByClient($client->client_id);
		} else {
			$client_orders = [];
		}

		return view('admin.users.user')->with([
			'user'   => $user,
			'orders' => $client_orders,
		]);
	}
}
