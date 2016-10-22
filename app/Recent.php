<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recent extends Model {

	/**
	 * @return array
	 */
	private static function formRecentArray() {
		if (\Session::has('recent')) {
			$recent = (array) \Session::get('recent');
		} else {
			$recent = array_fill(0, 3, null);
			\Session::put('recent', $recent);
		}

		return $recent;
	}

	/**
	 * Get all recent items
	 *
	 * @return array
	 */
	public static function readAllRecent() {
		$recent = Recent::formRecentArray();
		$sorted_items = [];

		foreach ($recent as $item) {
			$items = Item::full();
			$oneItem = $items->where('item_id', $item)->first();
			if (!is_null($oneItem)) {
				$sorted_items[] = $oneItem;
			}
		}

		return $sorted_items;
	}

	/**
	 * Save item to recent array
	 *
	 * @param Item $item
	 *
	 * @return bool
	 */
	public static function writeRecentForSession(Item $item) {
		if (!isset($item)) {

			return false;
		}

		$recent = Recent::formRecentArray();

		if (!in_array($item->item_id, $recent)) {

			array_unshift($recent, $item->item_id);
			if(count($recent) > 4) {
				array_pop($recent);
			}

			\Session::put('recent', $recent);
		} else {
			$idPos = array_search($item->item_id, $recent);
			unset($recent[$idPos]);
			array_unshift($recent, $item->item_id);

			\Session::put('recent', $recent);
		}
	}
}
