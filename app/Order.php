<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	public $primaryKey = 'order_id';
	public $dates = ['date'];
	protected $fillable = ['date', 'client_id', 'items', 'requisites', 'delivery', 'address', 'comment', 'state', 'payment'];
	public $timestamps = false;

	/**
	 *
	 * Presenter for $order->delivery
	 * @param $value
	 *
	 * @return string
	 */
	public function getDeliveryAttribute($value) {
		switch($value) {
			case 'self':
				$value = 'Самовывоз';
				break;
			case 'St.Petersburg_delivery':
				$value = 'Доставка По Санкт Петербургу.';
				break;
			case 'TK_business_lines':
				$value = 'Доставка до терминала ТК Деловые Линии в Санкт Петербурге.';
				break;
			case 'EMC':
				$value = 'Доставка EMC до адреса получателя.';
				break;
			case 'SDEK':
				$value = 'Доставка экспресс почтой СДЭК до адреса получателя.';
				break;
			case 'RATEK':
				$value = 'Доставка до терминала ТК РАТЭК в Санкт Петербурге.';
				break;
			case 'PONY':
				$value = 'Доставка экспресс почтой Pony express  до адреса получателя.';
				break;
			case 'Dimex':
				$value = 'Доставка экспресс почтой  dimex до адреса получателя.';
				break;
			case 'PEK':
				$value = 'Доставка до терминала ТК ПЭК в Санкт Петербурге.';
				break;
			case 'MSK':
				$value = 'Доставка в Москву (в МКАД) Элайн  экспресс. (1 рабочий день).';
				break;
			case 'Other':
				$value = 'Другое';
				break;
		}

		return $value;
	}

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
	 * Scope a query to include full order data.
	 *
	 * @param $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFull($query) {

		return $query->join('clients', 'clients.client_id', '=', 'orders.client_id')
		             ->join('states', 'states.state_id' , '=', 'orders.state');
	}

	/**
	 * Scope a query to include full order data and skip deleted orders.
	 *
	 * @param $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFullActive($query) {

		return $query->join('clients', 'clients.client_id', '=', 'orders.client_id')
		             ->join('states', 'states.state_id' , '=', 'orders.state')
					 ->where('deleted', '!=', 1);
	}

	/**
	 * Get new orders after last visit
	 *
	 * @param $lastVisit
	 *
	 * @return mixed
	 */
	public static function getNewOrders($lastVisit) {

		return Order::fullActive()
		            ->whereBetween('date', [$lastVisit, Carbon::now()])
		            ->get();
	}

	/**
	 * Get recent orders
	 *
	 * @return mixed
	 */
	public static function getRecentOrders() {

		return Order::fullActive()
					->where('state', '!=', '3')
					->orderBy('date', 'desc')
					->take(10)
					->get();
	}

	/**
	 * Get recently done orders
	 *
	 * @return mixed
	 */
	public static function getRecentDoneOrders() {

		return Order::fullActive()
					->where('state', '=', '3')
					->orderBy('date', 'desc')
					->take(10)
					->get();
	}

	public function getAllOrders() {
		$orders = Order::fullActive()
		               ->orderBy('state', 'asc')
		               ->orderBy('order_id', 'desc')
		               //->get();
					   ->paginate(30);

		foreach ($orders as $order) {
			$order['items'] = $this->getFullOrderItems($order);
			$order['sum'] = $this->getOrderSum($order);
		}

		return $orders;
	}

	public function getDetailedOrder($orderId) {
		$order = Order::full()
		              ->find($orderId);

		$order['items'] = $this->getFullOrderItems($order);
		$order['sum'] = $this->getOrderSum($order);
		$order['number_of_order'] = $this->getNumberOfOrder($order->client_id);

		return $order;
	}

	public function getAllOrdersByClient($client_id) {
		$orders = Order::full()
		               ->where('orders.client_id', '=', $client_id)
		               ->orderBy('state', 'asc')
		               ->orderBy('order_id', 'desc')
		               ->get();

		foreach ($orders as $order) {
			$order['items'] = $this->getFullOrderItems($order);
			$order['sum'] = $this->getOrderSum($order);
		}


		return $orders;
	}
	
	public function getOrdersByQueryAdmin() {
		$query = trim(request()->get('query'));
		
		$orders = Order::full()
					->where('order_id', $query)
		            ->orWhere('date', 'like', '%'.$query.'%')
		            ->orWhere('address', 'like', '%'.$query.'%')
		            ->orWhere('delivery', 'like', '%'.$query.'%')
		            ->orWhere('state', 'like', '%'.$query.'%')
		            ->orWhere('clients.name', 'like', '%'.$query.'%')
		            ->orWhere('clients.surname', 'like', '%'.$query.'%')
		            ->orderBy('state', 'asc')
		            ->orderBy('order_id', 'desc')
		            ->paginate(30);
		
		foreach ($orders as $order) {
			$order['items'] = $this->getFullOrderItems($order);
			$order['sum'] = $this->getOrderSum($order);
		}
		
		return $orders;
	}

	private function getNumberOfOrder($clientId) {
		$ordersQuantity =  Order::where('client_id', '=', $clientId)->count();

		return $ordersQuantity;
	}

	private function getFullOrderItems($order) {
		$itemsInOrder = json_decode($order['items']);
		$fullItems = [];
		foreach ($itemsInOrder as $item) {
			$itemId = $item->id;
			$quantity = $item->count;
			$price = $item->price;
			$item = Item::full()->find($itemId);
			if ($item != null) {
				$item['price'] = $price;
				$item['count'] = $quantity;
				$item['currency'] = 'РУБ';
				$fullItems[] = $item;
			}
		}

		return $fullItems;
	}

	private function getOrderSum($order) {
		$orderSum = 0;

		foreach($order->items as $item) {
			$price = $item['price'];
			$quantity = $item['count'];
			$sum = $price * $quantity;
			$orderSum +=$sum;
		}

		return $orderSum;
	}
}
