<?php

namespace App\Http\Controllers;

use App\Article;
use App\Item;
use App\Producer;
use App\Recent;
use App\Sale;
use App\Setting;
use App\Subcat;
use App\Support\Curl;
use App\Support\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller {

	public function indexPage() {
		
		return view('user-interface.index')->with([
			'categories'    => $this->createCategories(),
			'producers'     => Producer::readAllProducers(),
			'subcats'       => Subcat::readAllSubcats()
		]);
	}

	public function pricePage() {

		return view('user-interface.price')->with([
			'prices' => $this->getPricesFromDir(public_path().DIRECTORY_SEPARATOR.'prices'),
		]);
	}

	/**
	 * Downloads the price file by id
	 */
	public function getPrice() {
		$prices =  $this->getPricesFromDir(public_path().DIRECTORY_SEPARATOR.'prices');
		$price_id = request()->get('price_id');

		header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-disposition: attachment; filename=$prices[$price_id]");
	}

	public function deliveryPage() {

		return view('user-interface.delivery');
	}

	public function map() {

		return view('user-interface.map');
	}

	public function aboutPage() {

		return view('user-interface.about');
	}

	public function contactsPage() {
		$time = Setting::getWorkTime();

		return view('user-interface.contacts')->with([
			'timeWeekFrom'  => $time['time_week_from'],
			'timeWeekTo'    => $time['time_week_to'],
			'timeSatFrom'   => $time['time_sat_from'],
			'timeSatTo'     => $time['time_sat_to'],
			'timeSunFrom'   => $time['time_sun_from'],
			'timeSunTo'     => $time['time_sun_to'],
			'email'         => Setting::find(11),
		]);
	}

	public function search() {
		$query = trim(request()->get('query'));
		
		return view('user-interface.items')->with([
			'items'     => Item::getItemsByQuery($query),
			'current'	=> $query
		]);

	}

	/**
	 * @param string $dir
	 *
	 * @return array
	 */
	private function getPricesFromDir($dir) {
		$result = array();

		if (!file_exists($dir)) {
			echo "<span style='color: red'>ERROR: no \"$dir\" directory found!</span></br>";
		}

		$cdir = scandir($dir);
		foreach ($cdir as $key => $value) {
			if (!in_array($value, array(".",".."))) {
				if (is_dir($dir.DIRECTORY_SEPARATOR.$value)) {
					$result[$value] = getPricesFromDir($dir.DIRECTORY_SEPARATOR.$value);
				} else {
					$result[] = iconv('Windows-1251', "UTF-8", $value);
				}
			}
		}

		return $result;
	}
}
