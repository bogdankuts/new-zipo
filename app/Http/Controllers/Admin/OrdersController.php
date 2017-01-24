<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\State;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller {
	
	public function search() {
		$orders = new Order();
		$orders = $orders->getOrdersByQueryAdmin();
		$query = request()->get('query');
		
		if ($orders->count() == 0) {
			
			return redirect()->route('dashboard')->withErrors('По запросу: "'.$query.'" ничего не найдено.');
		} else {
			
			return view('admin.orders.orders')->with([
				'orders'        => $orders,
				'states'        => State::all(),
			    'env'           => 'search'
			]);
		}
	}

	public function orders() {
		$orders = new Order();
		$orders = $orders->getAllOrders();
		
		return view('admin.orders.orders')->with([
			'orders'        => $orders,
			'states'        => State::all()
		]);
	}

	public function deleteOrder($id) {
		if(\Auth::guard('admin')->user()->master) {
			$order = Order::find($id);
			$order->deleted = 1;
			$order->save();
			if (!request()->ajax()) {

				return redirect()->route('admin_orders');
			}
		} else {
			if (!request()->ajax()) {

				return redirect()->route('dashboard')->withErrors('У Вас нет прав для совершения этого действия');
			}
		}
	}

	public function detailedOrder($id) {
		$order = new Order();
		$order = $order->getDetailedOrder($id);

		return view('admin.orders.order')->with([
			'order'         => $order,
			'states'        => State::all(),
		]);
	}

	public function changeOrderState() {
		$order_id = request()->get('order_id');
		$state_id = request()->get('state');

		$order = Order::find($order_id);
		$order->state = $state_id;
		$order->save();

	}

	public function markOrderAsDone($id) {
		$order = Order::find($id);
		$order->state = 3;
		$order->save();
	}
}
