<?php

namespace App\Http\Controllers;

use App\Item;
use App\Sale;
use Illuminate\Http\Request;

use App\Http\Requests;

class SaleController extends Controller {
    
	public function oneSale($id) {
		$sale = Sale::find($id);
		
		return view('user-interface.sale')->with([
			'sale'  => $sale,
		    'items' => $sale->getItems(),
		]);
	}
}
