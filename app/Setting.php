<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model  {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'setting_id';
	protected $dates = ['changed_at'];

	public static function getDiscount() {

		return Setting::find(1)->value;
	}

	public static function getDiscountCard() {

		return Setting::find(2)->value;
	}

	public static function getWorkTime() {
		$times = Setting::find([3,4,5,6,7,8]);
		
		foreach ($times as $time) {
			$result[$time->name] = $time->value;
		}

		return $result;
	}
	
	public static function getMarkup() {
		$markups = Setting::find([14,15,16,17]);
		
		foreach ($markups as $markup) {
			$result[$markup->name] = $markup->value;
		}
		
		return $result;
	}

	public static function getDiscountWithUser($lastVisit) {

		$discount = Setting::find(1);
		if ($discount->changed_at > $lastVisit) {
			$discount = $discount->join('creds', 'settings.changed_by', '=', 'creds.cred_id')->first();

			return"Дисконт был изменен $discount->login и теперь составляет $discount->value%";
		} else {

			return false;
		}
	}

	public static function setDiscount($discount, $changedBy) {

		$setting = Setting::find(1);
		$setting->value = $discount;
		$setting->changed_at = Carbon::now();
		$setting->changed_by = $changedBy;
		$setting->save();
	}

	public static function setDiscountCard() {
		$discount = trim(request()->get('discountCard'));
		$setting = Setting::find(2);
		$setting->value = $discount;
		$setting->changed_at = Carbon::now();
		$setting->changed_by = request()->get('changed_by');
		$setting->save();

		return $discount;
	}

	public static function getPhones() {

		return Setting::find([9,10]);
	}

	public static function getEmail() {

		return Setting::find([11]);
	}
}
