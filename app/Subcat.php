<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model {
	public $primaryKey = "subcat_id";

	protected $fillable = ['subcat', 'category'];
	public $timestamps = false;

	public static function readAllSubcats() {
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

		$subcats = new Subcat;

		foreach ($categories as $category) {
			$subcats[$category] = $subcats->where('category', $category)
											->groupBy('subcat_id')
											->orderBy('subcat', 'asc')
											->get();
		}

		return $subcats;
	}

	public static function getSubcatsByCategory($category) {
		$category = unSlug($category);

		return Subcat::where('category', $category)->orderBy('subcat', 'asc')->get();
	}

	public static function getSubcatsTitlesByCategory() {
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
		$subcats = [];

		foreach ($categories as $category) {
			$subcats_titles = Subcat::where('category', $category)->pluck('subcat');
			$subcats[$category] = $subcats_titles;
		}

		return $subcats;
	}
}
