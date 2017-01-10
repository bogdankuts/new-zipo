<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
	
	protected $dates = ['start_date', 'end_date'];
	public $timestamps = false;
	protected $fillable = ['start_date', 'end_date', 'title', 'url', 'description'];
	
	public function getRouteKeyName() {
		
		return 'url';
	}
	
	public function items() {
		
		return $this->belongsToMany(Item::class, 'item_sale');
	}
	
	public function getItems() {
		$itemsIds = $this->items->pluck('item_id')->toArray();
		if(count($itemsIds) > 0) {
			$items = Item::full()->find($itemsIds);
		} else {
			$items = collect([]);
		}
		
		return $items;
	}
}
