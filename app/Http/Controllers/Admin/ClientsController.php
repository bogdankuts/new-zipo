<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientsController extends Controller {

	public function clients() {
		$clients = new Client;
		$clients = $clients->getAllClients();

		return view('admin.clients.clients')->with([
			'clients' => $clients,
		]);
	}

	public function client($id) {
		$client = new Client;
		$client = $client->getDetailedClient($id);
		$clientOrders = new Order;
		$clientOrders = $clientOrders->getAllOrdersByClient($id);

		return view('admin.clients.client')->with([
			'client' => $client,
			'orders' => $clientOrders,
		]);
	}
	
	public function search() {
		$clients = new Client;
		$clients = $clients->getClientsByQueryAdmin();
		$query = request()->get('query');
		
		if ($clients->count() == 0) {
			
			return redirect()->route('dashboard')->withErrors('По запросу: "'.$query.'" ничего не найдено.');
		} else {
			
			return view('admin.clients.clients')->with([
				'clients' => $clients,
			]);
		}
	}
}
