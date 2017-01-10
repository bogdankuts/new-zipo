<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	public $primaryKey = 'client_id';
	public $dates = ['added_at'];
	protected $fillable = ['name', 'surname', 'phone', 'email', 'company', 'form_of_business', 'added_at', 'registered'];
	public $timestamps = false;

	/**
	 * Presenter for $order->form_of_business
	 *
	 * @param $value
	 *
	 * @return string
	 */
	public function getFormOfBusinessAttribute($value) {
		switch($value) {
			case 'jura':
				$value = ' Юридические лица';
				break;
			case 'physic':
				$value = ' Физические лица';
				break;
		}

		return $value;
	}

	/**
	 * Get client from DB with the same credentials
	 *
	 * @param array $match
	 *
	 * @return mixed
	 */
	public static function getOldClient(array $match) {

		return Client::where($match)->first();
	}

	/**
	 * Get new clients after last visit
	 *
	 * @param $lastVisit
	 *
	 * @return mixed
	 */
	public static function getNewClients($lastVisit) {

		return Client::whereBetween('added_at', [$lastVisit, Carbon::now()])->get();
	}

	public function getAllClients() {
		$clients = Client::orderBy('added_at', 'desc')->get();

		foreach($clients as $client) {
			$client->total_orders = Order::where('client_id', $client->client_id)->count();
			$client->total_orders_sum = $this->countOrderByClientSum($client->client_id);
			$client->registered = $this->checkIfClientIsRegistered($client);
		}

		return $clients;
	}

	public function getDetailedClient($clientId) {
		$client = Client::find($clientId);

		$client->total_orders = Order::where('client_id', $clientId)->count();
		$client->total_orders_sum = $this->countOrderByClientSum($clientId);
		$client->registered = $this->checkIfClientIsRegistered($client);

		return $client;
	}

	/**
	 * Get all orders by client quantity
	 *
	 * @param int $clientId
	 *
	 * @return int
	 */
	public function countOrderByClientSum($clientId) {
		$ordersByClient = new Order();
		$ordersByClient = $ordersByClient->getAllOrdersByClient($clientId);

		$ordersByClientSum = 0;

		foreach($ordersByClient as $order) {
			$ordersByClientSum += $order->sum;
		}

		return $ordersByClientSum;
	}

	/**
	 * Check if client is registered
	 *
	 * @param Client $client
	 *
	 * @return int
	 */
	private function checkIfClientIsRegistered(Client $client) {
		if($client->registered != 0) {
			return 1;
		} else {
			return 0;
		}
	}

}
