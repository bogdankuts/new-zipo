<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Producer;
use App\Subcat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyReadFilter implements \PHPExcel_Reader_IReadFilter {
	public function readCell($column, $row, $worksheetName = '') {
		global $limit;
		global $DELTA;
		if ($row >= $limit-$DELTA+1 && $row <= $limit) {
			return true;
		}
		return false;
	}
}

class ParserController extends Controller {

	public function excelImport() {
		function timer_start() { // add error timing
			global $__start;
			date_default_timezone_set('Europe/Kiev');
			// echo 'Start at: '.date('H:i:s');
			$__start = microtime(true);
		}
		function memuse($line = 'unknown') {
			echo "</br>memory_get_usage(true) on line $line</br>";
			echo round(memory_get_usage(true)/1024/1024, 2);
			echo ' Mb</br>';
		}
		function mempeak($line = 'unknown') {
			$round = round(memory_get_peak_usage(true)/1024/1024, 2);
			return "</br>Максимальная загрузка памяти: ".$round.' Mb</br>';
		}

		function timer_stop() {
			global $__start;
			$__time = microtime(true) - $__start;
			return '</br>Время работы скрипта: '.round($__time, 2).' с</br>';
		}

		timer_start();

		set_time_limit(10*60);
		ini_set('memory_limit', '256M');
		$memoryCacheSizeMb = 10;
		$excel_file = public_path().DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR.'excel.xlsx';
		$STOP = 100; // the row that has higher index than the last one
		global $DELTA;
		$DELTA = 100;
		$SKIP = 2; // amount of rows to be skiped
		global $limit;
		$errors = [];
		$messages = [];
		$added = 0;
		$rows = 0;

		/*------------------------------------------------
		| RETRIEVE DATA
		------------------------------------------------*/
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
		$cat_subcats = Subcat::getSubcatsTitlesByCategory();
		$codes = Item::pluck('code')->toArray();
		$producers = Producer::pluck('producer')->toArray();

		/*------------------------------------------------
		| Read chunks of xlsx
		------------------------------------------------*/
		$objReader = new \PHPExcel_Reader_Excel2007();
		$objReader->setReadDataOnly(TRUE);

		/*------------------------------------------------
		| Enabling Caching
		------------------------------------------------*/
		$cacheMethod=\PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		$cacheSettings=array("memoryCacheSize"=>"$memoryCacheSizeMb"."MB");
		\PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);


		for ($limit=$SKIP+$DELTA; $limit<=$STOP+$DELTA; $limit+=$DELTA) {
			$objReader->setReadFilter(new MyReadFilter);
			$objPHPExcel = $objReader->load($excel_file);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			// remove empty rows that were skiped ???
			// $objWorksheet->removeRow(1, $SKIP);
			/*------------------------------------------------
			| Get max column and row indexes
			------------------------------------------------*/
			$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
			$highestColumnLetter = $objWorksheet->getHighestColumn(); // e.g 'F'
			$highestColumn = \PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // e.g. 5

			/*------------------------------------------------
			| WRITE TO DB
			------------------------------------------------*/
			for ($row=1+$SKIP; $row<=$highestRow; ++$row) {

				$code 			= $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
				$title 			= $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
				$description 	= $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
				$price 			= $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
				$currency 		= $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
				$hit 			= $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
				$special 		= $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
				$category 		= $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
				$subcat 		= $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();
				$producer 		= $objWorksheet->getCellByColumnAndRow(9, $row)->getValue();
				$procurement 	= $objWorksheet->getCellByColumnAndRow(10, $row)->getValue();

				if (isset($code)) {
					$message = '';
					$error = '';
					$rows++;

					//*** code - 0 not empty because of initial condition
					if (in_array($code, $codes)) {
						$error .= 'Товар с кодом '.$code.' уже существует! ';
					}

					//*** title - 1
					if (!isset($title)) {
						$error .= 'Не указано название! ';
					}

					//*** description - 2 can be null

					//*** price - 3
					if (!isset($price)) {
						$error .= 'Не указана цена! ';
					} else {
						if (!is_float($price)) {
							$error .= 'Цена должна быть числом. ';
						} else if ($price < 0) {
							$error .= 'Цена не может быть отрицательной! ';
						}
					}

					//*** currency - 4
					if (!isset($currency)) {
						$error .= 'Не указана валюта! ';
					}

					//*** hit - 5
					if (!isset($hit)) {
						$error .= 'Не указан хит продаж! ';
					} else {
						if (!($hit == 0 || $hit == 1)) {
							$error .= 'Поле Хит продаж должно иметь значение 0 - нет, 1 - да. ';
						}
					}

					//*** special - 6
					if (!isset($special)) {
						$error .= 'Не указано спецпредложение! ';
					} else {
						if (!($special == 0 || $special == 1)) {
							$error .= 'Поле Спецпредложение должно иметь значение 0 - нет, 1 - да. ';
						}
					}

					//*** category - 7 and subcat - 8
					if (!isset($subcat)) {
						$error .= 'Не указана подкатегория! ';
					} else if (!isset($category)) {
						$error .= 'Не указана категория! ';
					} else {
						if (!in_array($category, $categories)) {
							$error .= 'Вы ввели неверную категорию. ';
						}

						if (!in_array($subcat, $cat_subcats[$category]->toArray())) {
							$created_subcat = Subcat::create(['subcat'=>$subcat, 'category'=>$category]);
							$cat_subcats[$category][] = $subcat;
							$message .= 'Добавлена новая подкатегория '.$subcat.' в категорию '.$category.'. ';
						}
					}

					//*** producer - 9
					if (!isset($producer)) {
						$error .= 'Не указан производитель! ';
					} else {
						if (!in_array($producer, $producers)) {
							$created_producer = Producer::create(['producer'=>$producer]);
							$producers[] = $producer;
							$message .= 'Добавлен новый производитель '.$producer.'. ';
						}
					}

					//*** procurement - 10
					if (!isset($procurement)) {
						$error .= 'Не указано наличие! ';
					} else {
						if (!($procurement == 0 || $procurement == 1)) {
							$error .= 'Поле Наличие должно иметь значение 0 - нет, 1 - да. ';
						}
					}

					if ($error) {
						$errors[] = $row.' строка. '.$error;
						continue;
					} else {
						// add item to db
						$fields = [
							'code' 			    => $code,
							'title' 		    => $title,
							'description'       => ($description) ? $description : 'Для данного товара описание отсутствует.',
							'price' 		    => $price,
							'currency' 		    => $currency,
							'hit' 			    => intval($hit),
							'special' 		    => intval($special),
							'subcat_id' 	    => isset($created_subcat) ? intval($created_subcat->subcat_id) : intval(Subcat::where('subcat', $subcat)->pluck('subcat_id')[0]),
							'producer_id'	    => isset($created_producer) ? intval($created_producer)->producer_id : intval(Producer::where('producer', $producer)->pluck('producer_id')[0]),
							'procurement' 	    => $procurement == 0 ? 5 : intval($procurement),
							'visits' 	        => 0,
							'meta_title' 	    => '',
							'meta_description' 	=> '',
						];

						try {
							$item = Item::create($fields);
							$caught = false;
						} catch (\Exception $e) {
							$error .= 'Неизвестная ошибка! Обратитесь в поддержку или попробуйте снова!';
							$errors[] = $row.' строка. '.$error;
							$caught = true;
							continue;
						}

						// add code only if no exception thrown
						if (!$caught) {
							$codes[] = $item->code;
						}
					}

					if ($message) {
						$messages[] = $row.' строка. '.$message;
					}

					// number of added items
					$added++;
				}
			}
			$objPHPExcel->disconnectWorksheets();
			unset($objPHPExcel);
		}

		timer_stop();
		mempeak();

		return view('admin.import.status')->with([
			'importErrors' 	=> $errors,
			'importMessages'  => $messages,
			'added'		=> $added,
			'SKIP'		=> $SKIP,
			'missed'	=> $rows-$added,
			'time'		=> timer_stop(),
			'mempeak'	=> mempeak(),
			'pageTitle' => 'Статус Импорта'
		]);
	}
}


