<?php

namespace App\Http\Controllers;

use App\Item;
use App\MultiImageUpload;
use App\Producer;
use App\Recent;
use App\Subcat;
use Illuminate\Http\Request;

use App\Http\Requests;

class CatalogController extends Controller {

	public function specialsPage() {

		return view('user-interface.items')->with([
			'items' => Item::getSpecialItems(),
		]);
	}

	public function category($category) {

		return view('user-interface.category')->with([
			'category'  => $category,
			'subcats'   => Subcat::getSubcatsByCategory($category),
		]);
	}

	public function item() {
		$id = request()->get('item_id');
		$item = Item::full()->find($id);
		//dd($item->sales);
		$item->visits += 1;
		$item->save();
		Recent::writeRecentForSession($item);

		return view('user-interface.item')->with([
			'same'		=> Item::getSameItems($item),
			'item'      => $item,
			'current'	=> $item->subcat_id,
			'photos'    => MultiImageUpload::where('item_id', $id)->get()
		]);
	}

	public function producersBySubcat() {
		$subcategory = Subcat::find(request()->get('subcat_id'));

		return view('user-interface.producers-by-subcategory')->with([
			'producers' => Producer::getBySubcategory($subcategory),
			'current'	=> $subcategory,
		]);
	}

	public function itemsBySubcatAndProducer() {

		return view('user-interface.items')->with([
			'items'     => Item::getItemsBySubcategoryProd(),
			'current'	=> Subcat::find(request()->get('subcat_id')),
		    'producer'  => Producer::find(request()->get('producer_id'))
		]);
	}

	public function itemsByProducer() {

		$producer = Producer::find(request()->get('producer_id'));

		return view('user-interface.items')->with([
			'items'     => Item::getItemsByProducer($producer->producer_id),
		    'current'   => $producer

		]);
	}
}
