<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use App\Mail\AdminOrder;
use App\Mail\UserOrder;
use App\Order;
use App\Sale;
use App\Setting;
use App\Support\Curl;
use App\Support\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller {

	public function cart() {

		return view('user-interface.cart')->with([
			'cart_items'=> $this->getCartItems()
		]);
	}

	public function orderPage() {

		return view('user-interface.order')->with([
			'items'		    => $this->getCartItems(),
			'discountCard'  => Setting::getDiscountCard(),
		    'step'          => 1
		]);
	}

	public function order() {
		$data = $this->formOrderData();
		$orderItems = $this->checkForAllDiscounts($this->getCartItems(), $data['payment']);

		$clientId = $this->addClientToDB($data);
		$orderId = $this->addOrderToDB($data, $clientId, $orderItems);

		$this->sendEmails($data, $orderId, $orderItems);
		
		//$sms = new SMS($orderId);
		//$sms->sendSMS($data['phone']);
		//$this->sendSMS();

		$this->clearCart();

		$this->clearOrder();

		return redirect()->route('index')->with('message', 'Ваш заказ оформлен!');
	}

	/**
	 * Delete cookie with cart
	 */
	private function clearCart() {
		setcookie("shopcartItems", "shopcartItems", time()-1);
	}

	private function clearOrder() {
		$fields = ['name', 'surname', 'phone', 'email', 'company', 'form_of_business', 'delivery', 'delivery_other', 'address', 'payment', 'requisites'];

		foreach($fields as $field) {
			request()->session()->pull($field);
		}
	}

	/**
	 * Send emails about order to admin and user
	 *
	 * @param array $data
	 * @param int   $orderId
	 * @param array $orderItems
	 */
	private function sendEmails(array $data, $orderId, array $orderItems) {
		\Mail::to(env('MAIL_ADMIN_EMAIL'))->send(new AdminOrder($data, $orderItems, $orderId));
		\Mail::to($data['email'])->send(new UserOrder($data, $orderItems, $orderId));
	}

	/**
	 * Add order to DB
	 *
	 * @param array         $data
	 * @param int|int       $client_id
	 * @param array         $items
	 *
	 * @return mixed
	 */
	private function addOrderToDB(array $data, $client_id, array $items) {
		$orderData = [];
		$orderData['date'] = Carbon::now();
		$orderData['client_id'] = $client_id;
		$orderData['items'] = json_encode($items);
		$orderData['requisites'] = $data['requisites'];
		$orderData['delivery'] = $data['delivery'];
		$orderData['address'] = $data['address'];
		$orderData['comment'] = $data['comment'];
		$orderData['state'] = 1;
		$orderData['payment'] = $data['payment'];

		return Order::create($orderData)->order_id;
	}

	/**
	 * Add new client to DB
	 *
	 * @param array $data
	 *
	 * @return mixed
	 */
	private function addClientToDB(array $data) {
		$clientData = $this->formClientData($data);
		$existingClient = Client::getOldClient($clientData);

		if (is_null($existingClient)) {
			$clientData['added_at'] = Carbon::now();

			return Client::create($clientData)->client_id;
		} else {

			return $existingClient->client_id;
		}
	}

	/**
	 * Form client array from data array
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	private function formClientData(array $data) {
		$credentials = ['name', 'surname', 'email', 'phone', 'company', 'form_of_business', 'registered'];
		$clientData = [];

		foreach ($credentials as $credential) {
			$clientData[$credential] = $data[$credential];
		}

		return $clientData;
	}

	/**
	 * Check for all discounts and modify price
	 *
	 * @param array  $items
	 * @param string $paymentMethod
	 *
	 * @return mixed
	 */
	private function checkForAllDiscounts(array $items, $paymentMethod) {
		if ($items != emptyArray()) {
			$authenticated = \Auth::check();
			//$paidWithCard = false;
			
			if ($paymentMethod == 'card') {
				//$paidWithCard = true;
				$discount = Setting::getDiscountCard();
			} else {
				$discount = 0;
			}
			
			if($authenticated != 0) {
				$authDiscount = intval(Setting::getDiscount());
			} else {
				$authDiscount = 0;
			}
			
			//if (Sale::getActiveSale() != null) {
			//	$saleDiscount = Sale::getActiveSale()->discount*100;
			//} else {
			//	$saleDiscount = 0;
			//}
			
			$finalDiscount = max($authDiscount, $discount);
			
			$toDiscount = 1 - intval($finalDiscount) / 100;
			
			foreach ($items as $item) {
				$DBPrice = Item::find($item->id)->price;
				if (!Item::find($item->id)->activeSales->isEmpty()) {
					$item->price = (1-Sale::getActiveSale()->discount) * $DBPrice;
					//dd($item->price);
				} elseif ($toDiscount != 0) {
					$item->price = $toDiscount*$DBPrice;
				} else {
					$item->price = $DBPrice;
				}
				
				//if (!$item->activeSales->isEmpty()) {
				//	$item->price = salesPrice($item->price, $item->activeSales[0]->discount);
				//} elseif ($paidWithCard) {
				//	$item->price = (1 - intval($discount) / 100) * $DBPrice;
				//} elseif ($authenticated) {
				//	$item->price = discount_price($DBPrice);
				//} else {
				//	$item->price = $DBPrice;
				//}
			}
			
			return $items;
			
		}

		return redirect()->back()->withErrors('Нет товаров в корзине!');

	}
	
	/**
	 * Normalize data  from form
	 *
	 * @return array
	 */
	private function formOrderData() {
		$dataPost = request()->all();
		$data = $this->getStoredOrderData();
		if (!array_key_exists('requisites', $data)) {
			$data['requisites'] = '';
		}
		$data['registered'] = $dataPost['registered'];
		$data['comment'] = $dataPost['comment'];
		
		return $data;
	}

	private function getStoredOrderData() {
		$orderData = [];
		$fields = ['name', 'surname', 'phone', 'email', 'company', 'form_of_business', 'delivery', 'delivery_other', 'address', 'payment', 'requisites'];

		foreach($fields as $field) {
			if(request()->session()->has($field)) {
				$orderData[$field] = request()->session()->get($field);
			}
		}
		if($orderData['delivery'] == 'St.Petersburg_delivery') {
			$orderData['deliveryPrice'] = 350;
		} elseif ($orderData['delivery'] == 'TK_business_lines' || $orderData['delivery'] == 'RATEK') {
			$orderData['deliveryPrice'] = 150;
		} elseif ($orderData['delivery'] == 'PEK') {
			$orderData['deliveryPrice'] = 200;
		} elseif ($orderData['delivery'] == 'self') {
			$orderData['deliveryPrice'] = 0;
		} else {
			$orderData['deliveryPrice'] = 9999;
		}

		return $orderData;
	}

	/**
	 * Return items from cart with names and prices
	 *
	 * @return array|mixed
	 */
	private function getCartItems() {
		$cartItems = $this->getStoredCart();//[]

		foreach ($cartItems as $cartItem) {
			$item = Item::full()->find($cartItem->id);

			$cartItem->code = $item->code;
			$cartItem->title = $item->title;
			$cartItem->category = $item->category;
			$cartItem->subcat = $item->subcat;
			$cartItem->initialPrice = $item->price;
			$cartItem->sales = $item->sales;
			$cartItemPrice = $cartItem->initialPrice;

			if ($cartItem->price !== $cartItemPrice) {
				$cartItem->price = $cartItemPrice;
			}
		}
		
		return $cartItems;
	}

	/**
	 * Get items from cookie to array
	 *
	 * @return array|mixed
	 */
	private function getStoredCart() {
		if(isset($_COOKIE['shopcartItems'])) {
			$cartItems = json_decode($_COOKIE['shopcartItems']);
		} else {
			$cartItems = [];
		}

		return $cartItems;
	}
}
