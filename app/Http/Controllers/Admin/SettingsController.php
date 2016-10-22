<?php

namespace App\Http\Controllers\Admin;

use App\Rate;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller {

	public function index() {
		$time = Setting::getWorkTime();
		$rate = new Rate();
		$phones = Setting::getPhones();
		//dd(Setting::getDiscountCard());

		return view('admin.settings.settings')->with([
			'discount'      => Setting::getDiscount(),
			'rate'          => $rate->getRate(),
			'discountCard'  => Setting::getDiscountCard(),
			'timeWeekFrom'  => $time['time_week_from'],
			'timeWeekTo'    => $time['time_week_to'],
			'timeSatFrom'   => $time['time_sat_from'],
			'timeSatTo'     => $time['time_sat_to'],
			'timeSunFrom'   => $time['time_sun_from'],
			'timeSunTo'     => $time['time_sun_to'],
		    'p_phone'       => $phones[0],
			's_phone'       => $phones[1],
		    'email'         => Setting::find(11)
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
