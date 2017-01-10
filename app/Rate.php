<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model {
	
	public static function makeRateFixed($fixed) {
		$setting = Setting::find(12);
		$setting->value = $fixed;
		$setting->changed_at = Carbon::now();
		$setting->changed_by = request()->get('changed_by');
		$setting->save();
	}
	
	public static function checkIfRateIsFixed() {
		$rate = Setting::find(12);
		if ($rate->value == 1) {
			
			return true;
		} else {
			
			return false;
		}
	}
	
	public static function setRate($rate) {
		$rateDB = Setting::find(13);
		$rateDB->value = $rate;
		$rateDB->changed_at = Carbon::now();
		$rateDB->changed_by = request()->get('changed_by') ? request()->get('changed_by') : 1;
		$rateDB->save();
		
		return $rateDB;
	}
	
	public function getRate() {
		
		$rate = Setting::find(13);
		
		if ($rate->changed_at < Carbon::now()->subHours(24) && Rate::checkIfRateIsFixed() != true) {
			
			$rateValue = $this->storeRate();
		} else {
			
			$rateValue = $rate->value;
		}
		
		return $rateValue;
	}
	
	public function parseRate() {
		$xml = file_get_contents('http://www.cbr-xml-daily.ru/daily.xml');
		$xml = simplexml_load_string($xml);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		$collection = collect($array['Valute']);
		$EUR = $collection->filter(function($item) {return $item['CharCode'] == 'EUR';})->first()['Value'];

		return floatval(str_replace(',', '.',$EUR));
	}

	private function storeRate() {

		if ($this->parseRate()) {
			$rate = Rate::setRate($this->parseRate());
		} else {
			$rate = Rate::getRate();
		}
		
		return $rate->value;
	}


}
