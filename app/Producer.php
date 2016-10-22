<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model {
	protected $guarded = [];
	public $primaryKey = 'producer_id';
	public $timestamps = false;
	protected $fillable = ['producer', 'producer_photo'];

	public function items() {
		return $this->belongsTo(Item::class, 'producer_id', 'producer_id');
	}

	public function pdf() {
		return $this->hasOne(Pdf::class, 'producer_id', 'producer_id');
	}


	public static function readAllProducers() {

		return Producer::orderBy('producer', 'ASC')->get();
	}

	/**
	 * Get producers by subcategory
	 *
	 * @param Subcat $subcategory
	 *
	 * @return array
	 */
	public static function getBySubcategory(Subcat $subcategory) {
		$items = Item::where('subcat_id', $subcategory->subcat_id)->get()->groupBy('producer_id');
		$producers = [];

		foreach ($items as $key => $item) {
			$producers[] = Producer::find($key);
		}

		return collect($producers)->sortBy('producer');
	}

	public static function getPdfProducersByCategory() {
		$categories = [
			'Механическое_en',
			'Тепловое_en',
			'Холодильное_en',
			'Моечное_en',
			'Механическое_ru',
			'Тепловое_ru',
			'Холодильное_ru',
			'Моечное_ru'
		];

		foreach ($categories as $category) {
			$producers[$category] = Producer::whereHas('pdf.subcat', function($q) use ($category) {
				$q->where('category', $category);
			})->orderBy('producer', 'asc')->get();
		}

		return $producers;
	}

	/**
	 * Remove producer id from items on delete
	 *
	 * @param int $producerId
	 */
	public static function deleteProducerFromItems($producerId) {
		Item::where('producer_id', $producerId)->update(['producer_id' => 0]);
	}
}
