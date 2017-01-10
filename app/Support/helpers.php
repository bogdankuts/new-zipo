<?php
/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 07.10.16
 * Time: 10:05
 */


/**
 * Columns form the array
 *
 * @param array $array
 * @param int $columns
 * @param int $current
 *
 * @return array
 */
function columnize($array, $columns, $current) {
	$current--; // set indexes from 1
	$array = method_exists($array, 'all') ? $array->all() : $array;
	$count = count($array);
	$rest = $count % $columns;
	$base = ($count - $rest)/$columns;
	$borders = [];

	for ($i=0; $i<$columns; $i++) {
		if ($i > 0) {
			$borders[$i] = $base + $borders[$i-1];
		} else {
			$borders[$i] = $base;
		}
		if ($rest > 0) {
			$borders[$i]++;
			$rest--;
		}
	}

	if ($current > 0) {
		$start = $borders[$current-1];
		$length = $borders[$current]-$borders[$current-1];
	} else {
		$start = 0;
		$length = $borders[$current];
	}

	return array_slice($array, $start, $length);
}

/**
 * Format date for news
 *
 * @param string $date
 *
 * @return string
 */
function formatDate($date) {
	$newDate = date("d-m-Y", strtotime($date));

	return $newDate;
}


/**
 * Apply discount for price
 *
 * @param int $price
 *
 * @return float
 */
function discount_price($price) {
	$discount = floatval(\App\Setting::getDiscount());
	$price = floatval($price);

	return ceil($price - $price*$discount/100);
}

function salesPrice($price, $discount) {
	
	return round(floatval($price) * (1-$discount));
}

/**
 * Create normal category title
 *
 * @param string $title
 *
 * @return string
 */
function reverseSlug($title) {
	$title = substr($title, 0, -3);
	switch ($title) {
		case 'mekhanicheskoe':
			$normalizedTitle = 'Механическое';
			break;
		case 'teplovoe':
			$normalizedTitle = 'Тепловое';
			break;
		case 'moechnoe':
			$normalizedTitle = 'Моечное';
			break;
		case 'kholodilnoe':
			$normalizedTitle = 'Холодильное';
			break;
	}

	return $normalizedTitle;
}

/**
 * Reverse slug with all ending
 *
 * @param string $title
 *
 * @return string
 */
function unSlug($title) {
	$normalizedTitle = '';
	switch ($title) {
		case 'mekhanicheskoe_en':
			$normalizedTitle = 'Механическое_en';
			break;
		case 'teplovoe_en':
			$normalizedTitle = 'Тепловое_en';
			break;
		case 'kholodilnoe_en':
			$normalizedTitle = 'Холодильное_en';
			break;
		case 'moechnoe_en':
			$normalizedTitle = 'Моечное_en';
			break;
		case 'mekhanicheskoe_ru':
			$normalizedTitle = 'Механическое_ru';
			break;
		case 'teplovoe_ru':
			$normalizedTitle = 'Тепловое_ru';
			break;
		case 'kholodilnoe_ru':
			$normalizedTitle = 'Холодильное_ru';
			break;
		case 'moechnoe_ru':
			$normalizedTitle = 'Моечное_ru';
			break;
		case 'mekhanicheskoe-en':
			$normalizedTitle = 'Механическое_en';
			break;
		case 'teplovoe-en':
			$normalizedTitle = 'Тепловое_en';
			break;
		case 'kholodilnoe-en':
			$normalizedTitle = 'Холодильное_en';
			break;
		case 'moechnoe-en':
			$normalizedTitle = 'Моечное_en';
			break;
		case 'mekhanicheskoe-ru':
			$normalizedTitle = 'Механическое_ru';
			break;
		case 'teplovoe-ru':
			$normalizedTitle = 'Тепловое_ru';
			break;
		case 'kholodilnoe-ru':
			$normalizedTitle = 'Холодильное_ru';
			break;
		case 'moechnoe-ru':
			$normalizedTitle = 'Моечное_ru';
			break;
	}
	return $normalizedTitle;
}

/**
 * Get how many minutes left fill tommorow
 *
 * @return mixed
 */
function minutes_left() {
	$now = \Carbon\Carbon::now();
	$tomorrow = \Carbon\Carbon::tomorrow();
	$minutes_left = $tomorrow->diffInMinutes($now);
	return $minutes_left;
}

/**
 * Create option element from array
 * @param array  $array
 * @param string $key
 * @param string $value
 *
 * @return array
 */
function createOptions($array, $key, $value) {
	$options = [];

	foreach ($array as $element) {
		$options[$element->$key] = $element->$value;
	}

	return $options;
}