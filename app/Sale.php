<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
	
	protected $dates = ['start_date', 'end_date'];
	public $timestamps = false;
	protected $fillable = ['start_date', 'end_date', 'title', 'url', 'description', 'discount', 'changed_by', 'banner'];
	
	public function getRouteKeyName() {
		
		return 'url';
	}
	
	public function items() {
		
		return $this->belongsToMany(Item::class, 'item_sale');
	}
	
	public function getItems() {
		$itemsIds = $this->items->pluck('item_id')->toArray();
		//dd($this);
		if(count($itemsIds) > 0) {
			$items = Item::full()->find($itemsIds);
		} else {
			$items = collect([]);
		}
		
		return $items;
	}
	
	public static function getActiveSale() {
		
		return Sale::where('start_date', '<', Carbon::now())
		                  ->where('end_date', '>', Carbon::now())
		                  ->first();
	}
}
