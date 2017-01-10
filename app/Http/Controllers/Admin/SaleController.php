<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaleController extends Controller {
    
	public function sales() {
		
		return view('admin.sale.sales')->with([
			'sales' => Sale::all()
		]);
	}
	
	public function change($id) {
		
		$sale = Sale::find($id);
		
		return view('admin.sale.change')->with([
			'sale'  => $sale,
			'items' => $sale->getItems(),
		]);
	}
	
	public function deleteFromSale($item_id) {
		
		\DB::table('item_sale')->where('item_id', $item_id)->delete();
		
		return redirect()->back()->with('message', 'Товар удален из распродажи!');
		
	}
	
	public function addToSale() {
		
		$ids = request()->get('ids');
		$saleId = request()->get('sale_id');
		$saleItems = Sale::find($saleId)->items();
		$itemIds = Sale::find($saleId)->items->pluck('item_id');
		
		
		foreach ($itemIds as $itemId) {
			if (in_array($itemId, $ids)) {
				$attachedIds[] = $itemId;
			}
		}
		
		$saleItems->attach($ids);
		if (isset($attachedIds)) {
			$saleItems->detach($attachedIds);
		}
		
		return response()->json($ids);
	}
	
	public function update($id) {
		$fields = request()->all();
		unset($fields['url']);
		unset($fields['start_date']);
		unset($fields['end_date']);
		
		Sale::find($id)->update($fields);
		
		return redirect()->back()->with('message', 'Распродажа изменена успешно.');
		
	}
}
