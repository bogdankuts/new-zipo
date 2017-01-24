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
	
	public function noTitleItems() {
		$items = Item::full()->where('meta_title', '')->get();
		foreach ($items as $item) {
			$item->meta_title = "Купить $item->title в Санкт-Петербурге";
			$item->changed_by = 18;
			$item->save();
		}
		return view('admin.catalog.items')->with([
			'pdfs'		    => Pdf::all(),
			'procurements'  => Supply::all(),
			'current'	    => Subcat::find(request()->get('subcat_id')),
			'items'         => Item::full()->where('meta_title', '')->get(),
			'sales'         => Sale::all()
		]);
	}
	
	public function noDescriptionItems() {
		$items = Item::full()->where('meta_description', '')->get();
		foreach ($items as $item) {
			$item->meta_description = "Купить $item->producer - $item->title в Санкт-Петербурге";
			$item->changed_by = 18;
			$item->save();
		}
		return view('admin.catalog.items')->with([
			'pdfs'		    => Pdf::all(),
			'procurements'  => Supply::all(),
			'current'	    => Subcat::find(request()->get('subcat_id')),
			'items'         => Item::full()->where('meta_description', '')->get(),
			'sales'         => Sale::all()
		]);
	}
}