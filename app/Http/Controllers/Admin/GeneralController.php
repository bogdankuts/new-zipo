<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Pdf;
use App\Supply;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralController extends Controller {

	public function about() {

		return view('admin.about.about');
	}

	public function search() {
		$items = Item::getItemsByQueryAdmin();
		$query = request()->get('query');

		if ($items->count() == 0) {

			return redirect()->route('dashboard')->withErrors('По запросу: "'.$query.'" ничего не найдено.');
		} else {

			return view('admin.catalog.items')->with([
				'pdfs'		    => Pdf::all(),
				'items'         => Item::getItemsByQueryAdmin(),
				'current'	    => $query,
				'procurements'  => Supply::all(),
			]);
		}
	}
}
