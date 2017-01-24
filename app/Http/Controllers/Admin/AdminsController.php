<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Item;
use App\Pdf;
use App\Sale;
use App\Supply;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminsController extends Controller {

	public function admins() {
		//$items = Item::all();
		//foreach ($items as $item) {
		//	$item->created_at = '2016-05-05 00:00:00';
		//	$item->created_by = 1;
		//	$item->changed_by = 1;
		//	$item->save();
		//}
		//$items = Pdf::all();
		//foreach ($items as $item) {
		//	$item->created_at = '2016-05-05 00:00:00';
		//	$item->updated_at = '2016-05-05 00:00:00';
		//	$item->created_by = 1;
		//	$item->changed_by = 1;
		//	$item->save();
		//}
		//$items = Item::where('producer_id', 29);
		//foreach ($items as $item) {
		//	$item->created_at = '2016-12-12 00:00:00';
		//	$item->updated_at = '2016-12-12 00:00:00';
		//	$item->created_by = 18;
		//	$item->changed_by = 18;
		//	$item->save();
		//}
		//$items = Item::where('producer_id', 28);
		//foreach ($items as $item) {
		//	$item->created_at = '2017-01-05 00:00:00';
		//	$item->updated_at = '2017-01-05 00:00:00';
		//	$item->created_by = 18;
		//	$item->changed_by = 18;
		//	$item->save();
		//}
		//$items = Item::where('producer_id', 32);
		//foreach ($items as $item) {
		//	$item->created_at = '2017-01-05 00:00:00';
		//	$item->updated_at = '2017-01-05 00:00:00';
		//	$item->created_by = 18;
		//	$item->changed_by = 18;
		//	$item->save();
		//}
		//$items = Item::where('producer_id', 31);
		//foreach ($items as $item) {
		//	$item->created_at = '2017-01-05 00:00:00';
		//	$item->updated_at = '2017-01-05 00:00:00';
		//	$item->created_by = 18;
		//	$item->changed_by = 18;
		//	$item->save();
		//}
		$admins = Admin::all();
		foreach ($admins as $admin) {
			$admin->items_last_month = $admin->items->where('created_at', '>', Carbon::today()->subMonth(1)->firstOfMonth()->startOfDay())
			                                        ->where('created_at', '<', Carbon::today()->subMonth(1)->lastOfMonth()->endOfDay())
													->count();
			$admin->items_this_month = $admin->items->where('created_at', '>', Carbon::today()->firstOfMonth()->startOfDay())
			                                        ->where('created_at', '<', Carbon::today()->lastOfMonth()->endOfDay())
													->count();
			$admin->pdfs_last_month = $admin->pdfs->where('created_at', '>', Carbon::today()->subMonth(1)->firstOfMonth()->startOfDay())
			                                        ->where('created_at', '<', Carbon::today()->subMonth(1)->lastOfMonth()->endOfDay())
			                                        ->count();
			$admin->pdfs_this_month = $admin->pdfs->where('created_at', '>', Carbon::today()->firstOfMonth()->startOfDay())
			                                        ->where('created_at', '<', Carbon::today()->lastOfMonth()->endOfDay())
			                                        ->count();
			
		}
		
		
		return view('admin.admins.admins')->with([
			'admins' => $admins,
		]);
	}
	
	public function admin($id) {
		$admin = Admin::find($id);
		$titles = [0 => 'Январь', 1 => 'Февраль', 2 => 'Март', 3 => 'Апрель', 4 => 'Май', 5 => 'Июнь', 6 => 'Июль', 7 => 'Август', 8 => 'Сентябрь', 9 => 'Октябрь', 10 => 'Ноябрь', 11 =>'Декабрь'];
		for($i=0; $i < 12; $i++) {
			$month = Carbon::now()->startOfYear()->addMonth($i);
			$result[$i]['title'] = $titles[$i];
			$result[$i]['items_added'] = $admin->items
				->where('created_at', '>', $month->startOfMonth())
				->where('created_at', '<', $month->endOfMonth())
				->count();
			$result[$i]['items_changed'] = $admin->changedItems
				->where('updated_at', '>', $month->startOfMonth())
				->where('updated_at', '<', $month->endOfMonth())
				->count();
			$result[$i]['pdfs_added'] = $admin->pdfs
				->where('created_at', '>', $month->startOfMonth())
				->where('created_at', '<', $month->endOfMonth())
				->count();
			$result[$i]['pdfs_changed'] = $admin->changedPdfs
				->where('updated_at', '>', $month->startOfMonth())
				->where('updated_at', '<', $month->endOfMonth())
				->count();
		};
		
		
		return view('admin.admins.admin')->with([
			'admin'         => Admin::find($id),
		    'byMonth'       => $result,
		]);
	}
	
	public function adminItemsMonth($id, $month) {
		$admin = Admin::find($id);
		$items = $admin->items()
			->where([
				['created_at', '>', Carbon::now()->startOfYear()->addMonths($month)->startOfMonth()],
				['created_at', '<', Carbon::now()->startOfYear()->addMonths($month)->endOfMonth()]
			])->full()->get();
		
		return view('admin.catalog.items')->with([
			'pdfs'		    => Pdf::all(),
			'current'       => 'Товары админа',
			'items'         => $items,
			'procurements'  => Supply::all(),
			'sales'         => Sale::all()
		]);
	}
	
	public function adminPdfsMonth($id, $month) {
		$admin = Admin::find($id);
		$pdfs = $admin->pdfs()
		               ->where([
			               ['created_at', '>', Carbon::now()->startOfYear()->addMonths($month)->startOfMonth()],
			               ['created_at', '<', Carbon::now()->startOfYear()->addMonths($month)->endOfMonth()]
		               ])->get();
		
		return view('admin.pdfs.pdfs')->with([
			'pdfs'		    => $pdfs
		]);
	}
	

	public function create() {

		return view('admin.admins.add')->with([
			'admin' => Admin::find(request()->get('admin_id')),
		]);
	}

	public function save() {
		$fields = $this->formFields(request()->all());

		Admin::create($fields);

		return redirect()->route('admins')->with('message', 'Администратор создан успешно.');
	}

	public function change($id) {

		return view('admin.admins.change')->with([
			'admin' => Admin::find($id),
		]);
	}

	public function update($id) {
		$fields = $this->formFields(request()->all());

		$admin = Admin::find($id);
		$admin->update($fields);

		return redirect()->route('admins')->with('message', 'Администратор создан успешно.');
	}

	public function delete($id) {
		Admin::deleteAdmin($id);

		return redirect()->route('admins')->with('message', 'Админ успешно удален!');
	}

	/**
	 * Form fields for update or create admin
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	private function formFields($fields) {
		if($fields['new_password'] !== '') {
			$fields['password'] = bcrypt($fields['new_password']);
			unset($fields['new_password']);
		} else {
			unset($fields['new_password']);
		}
		if(!array_key_exists('master', $fields)) {
			$fields['master'] = 0;
		} else {
			$fields['master'] = 1;
		}

		$fields['added_at'] = Carbon::now();
		$fields['last_visit'] = Carbon::now();

		return $fields;
	}
}
