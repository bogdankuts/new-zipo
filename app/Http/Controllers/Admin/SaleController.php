<?php

namespace App\Http\Controllers\Admin;

use App\ImageUpload;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaleController extends Controller {
    
	public function sales() {
		
		return view('admin.sale.sales')->with([
			'sales' => Sale::all()
		]);
	}
	
	public function create() {
		
		return view('admin.sale.add')->with([
			'sale' => Sale::find(0),
		]);
	}
	
	public function save() {
		$fields = request()->all();
		$imageUpload = new ImageUpload();
		
		$fields['discount'] = $fields['discount']/100;
		$fields['start_date'] = Carbon::createFromFormat('d.m.Y H:i', $fields['start_date']);
		$fields['end_date'] = Carbon::createFromFormat('d.m.Y H:i', $fields['end_date']);
		$fields['banner'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		unset($fields['photo']);
		
		//dd($fields);
		Sale::create($fields);
		
		
		
		$message = 'Распродажа успешно добавлена!';
		
		return redirect()->back()->with('message', $message);
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
		$imageUpload = new ImageUpload();
		
		
		$fields['discount'] = $fields['discount']/100;
		$fields['start_date'] = Carbon::createFromFormat('d.m.Y H:i', $fields['start_date']);
		$fields['end_date'] = Carbon::createFromFormat('d.m.Y H:i', $fields['end_date']);
		$fields['banner'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		unset($fields['photo']);
		
		Sale::find($id)->update($fields);
		
		return redirect()->back()->with('message', 'Распродажа изменена успешно.');
		
	}
	
	public function ajaxSaleImage() {
		$imageUpload = new ImageUpload();
		
		return $imageUpload->ajaxImage();
	}
	
	public function delete($id) {
		$sale = Sale::find($id);
		$imageUpload = new ImageUpload();
		
		if ($sale->photo != 'no_photo.png') {
			$imageUpload->deletePhoto($sale->banner);
		}
		
		\DB::table('item_sale')->where('sale_id', $id)->delete();
		
		$sale->delete();
		
		return redirect()->route('admin_sales')->with('message', 'Распродажа успешно удалена!');
	}
}
