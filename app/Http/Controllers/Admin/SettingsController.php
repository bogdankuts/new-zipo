<?php

namespace App\Http\Controllers\Admin;

use App\Rate;
use App\Item;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller {

	public function index() {
		
		$ids = Item::all()->pluck('item_id');
		//$r = array_map(function ($item) {
		//	return $item['item_id'];
		//}, $items->toArray());
		//print_r($r);
		//exit;
		foreach ($ids as $id) {
			$item = Item::find($id);
			$item->changed_by = 1;
			$item->save();
		}
		$time = Setting::getWorkTime();
		$rate = new Rate();
		$phones = Setting::getPhones();
		$markup = Setting::getMarkup();
		//dd(Setting::getDiscountCard());

		return view('admin.settings.settings')->with([
			'discount'      => Setting::getDiscount(),
			'rate'          => $rate->getRate(),
			'rateIsFixed'   => Rate::checkIfRateIsFixed(),
			'discountCard'  => Setting::getDiscountCard(),
			'timeWeekFrom'  => $time['time_week_from'],
			'timeWeekTo'    => $time['time_week_to'],
			'timeSatFrom'   => $time['time_sat_from'],
			'timeSatTo'     => $time['time_sat_to'],
			'timeSunFrom'   => $time['time_sun_from'],
			'timeSunTo'     => $time['time_sun_to'],
		    'p_phone'       => $phones[0],
			's_phone'       => $phones[1],
		    'email'         => Setting::find(11),
		    'markupLess10'  => $markup['markup-less-10'],
			'markup1025'    => $markup['markup-10-25'],
			'markup2580'    => $markup['markup-25-80'],
			'markupMore80'  => $markup['markup-more-80'],
		    
		]);
	}

	public function discountCard() {
		$discount = Setting::setDiscountCard();

		return redirect()->route('settings')->with('message', 'Скидка при оплате картой: '.$discount.'%.');
	}

	public function setTime() {
		$input = request()->all();
		$fields = ['time_week_from', 'time_week_to', 'time_sat_from', 'time_sat_to', 'time_sun_from', 'time_sun_to'];
		foreach($fields as $field) {
			Setting::where('name', $field)->update([
				'name'       => $field,
				'value'      => $input[$field],
				'changed_at' => Carbon::now(),
				'changed_by' => $input['changed_by']
			]);
		}

		return redirect()->back()->with('message', 'Время работы успешно изменено');
	}
	
	public function setMarkup() {
		$input = request()->all();
		$fields = ['markup-less-10', 'markup-10-25', 'markup-25-80', 'markup-more-80'];
		
		foreach($fields as $field) {
			Setting::where('name', $field)->update([
				'name'       => $field,
				'value'      => floatval($input[$field]),
				'changed_at' => Carbon::now(),
				'changed_by' => $input['changed_by']
			]);
		}
		
		return redirect()->back()->with('message', 'Наценка успешно изменена');
	}

	public function setPhones() {
		$input = request()->all();
		$fields = ['main_phone', 'secondary_phone'];
		foreach($fields as $field) {
			Setting::where('name', $field)->update([
				'name'       => $field,
				'value'      => $input[$field],
				'changed_at' => Carbon::now(),
				'changed_by' => $input['changed_by']
			]);
		}

		return redirect()->back()->with('message', 'Телефоны успешно изменены!');

	}

	public function setEmail() {
		$input = request()->all();
		Setting::where('name', 'email')->update([
			'name'       => 'email',
			'value'      => $input['email'],
			'changed_at' => Carbon::now(),
			'changed_by' => $input['changed_by']
		]);

		return redirect()->back()->with('message', 'Email успешно изменены!');

	}
}
