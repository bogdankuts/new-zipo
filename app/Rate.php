<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	public function getRate() {
		if (!\Cache::has('rate')) {
			$this->storeRate();
		}

		return \Cache::get('rate');

	}

	/**
	 * Store new rate till tomorrow
	 *
	 * @param $rate
	 * @param $minutes
	 */
	public static function setRate($rate, $minutes) {
		\Cache::put('rate', $rate, $minutes);
	}

	private function parseRate() {
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
			\Cache::put('rate', $this->parseRate(), 24*60);
		}
	}


}
