<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Subcat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemsController extends Controller {

	public function setSpecial() {
		$ids = request()->get('ids');

		Item::whereIn('item_id', $ids)->update(['special' => \DB::raw('!special')]);

		return response()->json($ids);
	}

	public function setHit() {
		$ids = request()->get('ids');

		Item::whereIn('item_id', $ids)->update(['hit' => \DB::raw('!hit')]);

		return response()->json($ids);
	}

	public function setProcurement() {
		$ids = request()->get('ids');
		$supplyId = request()->get('supply_id');

		Item::whereIn('item_id', $ids)->update(['procurement' => $supplyId]);

		return response()->json($ids);
	}

	public function getSubcategories() {
		$category = request()->get('category');
		$all = Subcat::readAllSubcats();
		$subcategories = $all[$category];

		return response()->json($subcategories);
	}

	public function changeSubcategory() {
		$ids = request()->get('ids');
		$fields =  request()->all();
		unset($fields['ids']);

		Item::whereIn('item_id', $ids)->update($fields);

		return response()->json($ids);
	}

	public function deleteGroup() {
		$ids =request()->get('ids');

		Item::destroy($ids);

		return response()->json($ids);
	}
}
