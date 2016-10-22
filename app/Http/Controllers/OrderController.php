<?php

namespace App\Http\Controllers;

use App\Item;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewOrderController extends Controller {

	public function orderPage() {

		return view('user-interface.order.order')->with([
			'items'		    => $this->getCartItems(),
			'cartSum'       => $this->countCartSum($this->getCartItems()),
			'discountCard'  => Setting::getDiscountCard(),
			'step'          => 1
		]);
	}

	public function storePart() {
		$data = request()->all();
		if (array_key_exists('requisites', $data)) {
			$fileName = $this->loadRequisitesToServer($data);
			$data['requisites'] = $fileName;
		}
		$cartItems = $this->getCartItems();


		foreach($data as $key=>$value) {
			request()->session()->put($key, $value);
		}

		if($data['step'] != 4) {
			return view('user-interface.order.order')->with([
				'items'		    => $this->getCartItems(),
				'cartSum'       => $this->countCartSum($cartItems),
				'discountCard'  => Setting::getDiscountCard(),
				'step'          => $data['step']+1
			]);
		} else {

			$orderData = $this->getStoredOrderData();
			$items = $this->checkForAllDiscounts($cartItems, $orderData['payment']);//77.6

			return view('user-interface.order.order')->with([
				'data'          => $orderData,
				'items'		    => $items,
				'cartSum'       => $this->countSum($items),
				'discountCard'  => Setting::getDiscountCard(),
				'step'          => $data['step']+1
			]);
		}

	}
	/**
	 *
	 * Put file into the disc directory
	 *
	 * @param array $data
	 *
	 * @return false|string
	 */
	private function loadRequisitesToServer(array $data) {
		$file = $data['requisites'];
		$fileName = $this->renameFile($data);

		\Storage::putFileAs('requisites', $file, $fileName);
		return $fileName;
	}

	/**
	 * Rename the income file to Name_Surname(date) format
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	private function renameFile($data) {
		$name = request()->session()->get('name');
		$surname = request()->session()->get('surname');
		$extension = $data['requisites']->getClientOriginalExtension();

		return $name.'_'.$surname.'('.Carbon::now()->toDateTimeString().').'.$extension;
	}

	/**
	 * Count sum of order
	 * @param array $items
	 *
	 * @return int
	 */
	private function countSum($items) {
		$sum = 0;
		foreach($items as $item) {
			$sum += $item->price*$item->count;
		}

		return $sum;
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
		$authenticated = \Auth::check();
		$paidWithCard = false;
		$discount = Setting::getDiscountCard();

		if ($paymentMethod == 'card') {
			$paidWithCard = true;
		}

		foreach ($items as $item) {
			$DBPrice = Item::find($item->id)->price;
			if ($paidWithCard) {
				$item->price = (1 - intval($discount) / 100) * $DBPrice;
			} elseif ($authenticated) {
				$item->price = discount_price($DBPrice);
			} else {
				$item->price = $DBPrice;
			}
		}

		return $items;

	}

	/**
	 * Get order data from session
	 * @return array
	 */
	private function getStoredOrderData() {
		$orderData = [];
		$fields = ['name', 'surname', 'phone', 'email', 'company', 'form_of_business', 'payment', 'requisites', 'delivery', 'delivery_other', 'address'];

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
			$cartItemPrice = $cartItem->initialPrice;

			if ($cartItem->price !== $cartItemPrice) {
				$cartItem->price = $cartItemPrice;
			}
		}

		return $cartItems;
	}

	/**
	 * Count sum for cart items
	 *
	 * @param array $items
	 *
	 * @return float|int
	 */
	private function countCartSum($items) {
		$sum = 0;
		foreach($items as $item) {
			if(\Auth::check()) {
				$sum += discount_price($item->price)*$item->count;
			} else {
				$sum += $item->price*$item->count;
			}
		}

		return $sum;
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
