<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	public $timestamps = false;
	public $dates = ['created_at', 'updated_at'];
	public $primaryKey = 'item_id';
	protected $fillable = ['code', 'title', 'description', 'price', 'currency', 'photo', 'hit', 'special', 'subcat_id', 'producer_id', 'procurement', 'visits', 'meta_title', 'meta_description', 'created_by', 'changed_by', 'created_at', 'updated_at'];

	public function pdfs() {
		
		return $this->belongsToMany(Pdf::class);
	}
	
	public function sales() {
		
		return $this->belongsToMany(Sale::class, 'item_sale');
	}
	
	public function activeSales() {
		
		return $this->belongsToMany(Sale::class, 'item_sale')->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now());
	}

	public function producer() {
		
		return $this->hasOne(Producer::class, 'producer_id', 'producer_id');
	}

	public function subcat() {
		
		return $this->hasOne(Subcat::class, 'subcat_id', 'subcat_id');
	}
	
	public function admin() {
		
		return $this->belongsTo(Admin::class);
	}

	/**
	 * Scope a query to include full item data.
	 *
	 * @param $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFull($query) {

		return $query->join('subcats', 'items.subcat_id', '=', 'subcats.subcat_id')
		             ->join('producers', 'items.producer_id', '=', 'producers.producer_id')
		             ->join('supplies', 'items.procurement', '=', 'supplies.id');
	}

	/**
	 * Get all special items
	 *
	 * @return mixed
	 */
	public static function getSpecialItems() {
		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];
		$pages_by = self::formSortOrderPages()['pages_by'];

		return Item::full()->where('special', '1')->orderBy($sort, $order)->paginate($pages_by);
	}

	/**
	 *
	 * Presenter for item->price
	 * @param $value
	 *
	 * @return float
	 */
	public function getPriceAttribute($value) {
		$currencies = ['РУБ', 'RUB', 'руб', 'rub', 'Руб', 'Rub', 'Руб.', 'РУБ.'];
		if(!in_array($this->currency, $currencies)) {
			$rate = new Rate();
			$currentRate = $rate->getRate();
			
			return round(floatval($value)*$currentRate);
		} else {

			return $value;
		}
	}
	
	public static function getByMonth($month) {
		$currentYear = Carbon::now()->year;
		$prevYear = $currentYear -1;
		//$month = $month +1;
		//if($month < 10) {
		//	$month = "0$month";
		//}
		$items = Item::where('created_at', '>', "$prevYear-31-12")
					 ->where('created_at', '>=', "$currentYear-$month-01")
					 ->where('created_at', '<=', "$currentYear-$month-31")
					 ->count();
		
		return $items;
	}

	/**
	 * Get 4 same items
	 *
	 * @param Item $item
	 *
	 * @return mixed
	 */
	public static function getSameItems(Item $item) {

		return Item::full()
		           ->where('items.subcat_id', $item->subcat_id)
		           ->where('items.producer_id', $item->producer_id)
		           ->where('items.item_id', '!=', $item->item_id)
		           ->orderByRaw("RAND()")
		           ->take(4)
		           ->get();
	}


	/**
	 * Get items by subcategory and producer
	 *
	 * @return mixed
	 */
	public static function getItemsBySubcategoryProd() {
		$subcat_id = request()->get('subcat_id');
		$producer_id = request()->get('producer_id');

		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];
		$pages_by = self::formSortOrderPages()['pages_by'];

		return Item::full()
		           ->where('items.subcat_id', $subcat_id)
		           ->where('items.producer_id', $producer_id)
		           ->orderBy($sort, $order)
		           ->paginate($pages_by);
	}

	/**
	 * Get all items by producer
	 *
	 * @param int $producerId
	 *
	 * @return mixed
	 */
	public static function getItemsByProducer($producerId) {
		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];
		$pages_by = self::formSortOrderPages()['pages_by'];

		return Item::full()
		           ->where('items.producer_id', $producerId)
		           ->orderBy($sort, $order)
		           ->paginate($pages_by);
	}

	/**
	 * Get items by search query
	 *
	 * @param string $query
	 *
	 * @return mixed
	 */
	public static function getItemsByQuery($query) {
		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];
		$pages_by = self::formSortOrderPages()['pages_by'];

		return Item::full()
		           ->where('title', 'like', '%'.$query.'%')
		           ->orWhere('code', 'like', '%'.$query.'%')
		           ->orderBy($sort, $order)
		           ->paginate($pages_by);
	}

	/**
	 * Get items which are connected with pdf
	 *
	 * @param int $fileId
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function getItemsForPdf($fileId) {

		return Item::full()
		            ->whereHas('pdfs', function($query) use ($fileId) {$query->where('item_pdf.pdf_id', $fileId);})
		            ->get();
	}

	/**
	 * Get most views items collection
	 *
	 * @return mixed
	 */
	public static function getMostViewedItems() {

		return Item::full()->orderBy('visits', 'desc')->take(10)->get();
	}

	/**
	 * Get most selling items
	 * @return array
	 */
	public static function getMostSellingItems() {
		//TODO::refactor this mess

		$orders = Order::all();
		$ids = [];
		$result = [];
		foreach ($orders as $order) {
			$items = json_decode($order->items);
			foreach ($items as $item) {
				if (array_key_exists($item->id, $ids)) {
					$ids[$item->id] = $ids[$item->id] + $item->count;
				} else {
					$ids[$item->id] = $item->count;
				}
			}
		}
		
		arsort($ids);
		$count = count($ids);
		if ($count > 10) {
			$ids = array_slice($ids, 0, 10, TRUE);
		}
		foreach ($ids as $id => $sales) {
			$item = Item::find($id);
			$item->sales = $sales;
			$result[] = $item;
		}

		return $result;
	}

	public static function getItemsForAdminCatalog($subcatId) {
		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];

		return Item::full()
		           ->where('items.subcat_id', $subcatId)
		           ->orderBy($sort, $order)
		           ->paginate(50);
	}

	/**
	 * Get all stored parameters or parameters from url
	 *
	 * @param array $defaults
	 *
	 * @return array
	 */
	private static function formSortOrderPages(array $defaults = ['sort'=>'title', 'order'=>'asc', 'pages_by'=>'10']) {
		$values = ['sort', 'order', 'pages_by'];
		$parameters = [];
		$request = [];
		foreach ($values as $value) {
			if (array_key_exists($value, $_COOKIE)) {
				$parameters[$value] = $_COOKIE[$value];
			}

			$request[$value] = request()->get($value);

			if (is_null($request[$value])) {
				if (!array_key_exists($value, $parameters)) {
					$parameters[$value] = $defaults[$value];
				}
			} else {
				$parameters[$value] = $request[$value];
			}
		}

		return $parameters;
	}

	public static function getItemsByQueryAdmin() {
		$query = trim(request()->get('query'));
		$sort = self::formSortOrderPages()['sort'];
		$order = self::formSortOrderPages()['order'];

		$items = Item::full()
					 ->where('title', 'like', '%'.$query.'%')
					 ->orWhere('code', 'like', '%'.$query.'%')
					 ->orderBy($sort, $order)
					 ->paginate(25);

		return $items;
	}
}
