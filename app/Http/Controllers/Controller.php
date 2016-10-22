<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Form all categories array
	 * @return array
	 */
	protected function createCategories() {
		$categoriesGroups = ['Механическое', 'Тепловое', 'Холодильное', 'Моечное'];
		$categories = [];

		foreach ($categoriesGroups as $categoriesGroup) {
			$categories['en'][] = $categoriesGroup.'_en';
			$categories['ru'][] = $categoriesGroup.'_ru';
		}

		return $categories;

	}
}
