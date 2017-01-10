<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Pdf;
use App\Producer;
use App\Sale;
use App\Subcat;
use App\Supply;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatalogController extends Controller {

	public function catalog() {

		return view('admin.catalog.catalog')->with([
			'subcats'   => Subcat::readAllSubcats(),
			'producers' => Producer::readAllProducers(),
		    'categories'=> $this->createCategories(),
		]);
	}

	public function items() {

		return view('admin.catalog.items')->with([
			'pdfs'		    => Pdf::all(),
			'procurements'  => Supply::all(),
			'current'	    => Subcat::find(request()->get('subcat_id')),
			'items'         => Item::getItemsForAdminCatalog(request()->get('subcat_id')),
		    'sales'         => Sale::all()
		]);
	}
}