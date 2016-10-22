<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'company', 'email', 'phone', 'activity', 'password', 'timestamp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public $timestamps = false;

	public $dates = ['timestamp'];

	public $primaryKey = 'user_id';

	/**
	 * Get new users after last visit
	 *
	 * @param $lastVisit
	 *
	 * @return mixed
	 */
	public static function getNewUsers($lastVisit) {

		return User::whereBetween('timestamp', [$lastVisit, Carbon::now()])->get();
	}

	public function getAllUsers() {
		$users = User::all();

		foreach($users as $user) {
			$client = Client::where('registered', '=', $user->user_id)->first();
			if (!is_null($client)) {
				$clientOrder = new Client;
				$clientOrders = Order::where('client_id', $client->client_id)->count();
				$clientOrdersSum = $clientOrder->countOrderByClientSum($client->client_id);
				$user->total_orders = $clientOrders;
				$user->total_orders_sum = $clientOrdersSum;
			} else {
				$user->total_orders = 0;
				$user->total_orders_sum = 0;
			}
		}

		return $users;
	}

	public function getDetailedUser($user_id) {
		$user = User::find($user_id);
		$client = Client::where('registered', '=', $user->user_id)->first();
		if (!is_null($client)) {
			$user->total_orders = Order::where('client_id', $client->client_id)->count();
			$user->total_orders_sum = $client->countOrderByClientSum($client->client_id);
		}

		return $user;
	}
}
