<?php

namespace App\Http\Controllers\Admin;

use App\Delivery;
use App\Supply;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller {
	public function index() {

		return view('admin.deliveries.deliveries')->with([
			'supplies' => Supply::all(),
		]);
	}

	public function create() {
		Supply::create([
			'supply_title' => request()->get('delivery_title'),
		]);

		return redirect()->back();
	}

	public function update($id) {
		$delivery = Supply::find($id);
		$delivery->supply_title = request()->get('delivery_title');
		$delivery->save();

		return redirect()->back();
	}

	public function delete($id) {
		$delivery = Supply::find($id);
		$delivery->delete();

		return redirect()->back();
	}
}
