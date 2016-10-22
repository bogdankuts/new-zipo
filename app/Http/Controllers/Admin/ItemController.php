<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaveItemRequest;
use App\ImageUpload;
use App\Item;
use App\Producer;
use App\Rate;
use App\Supply;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ItemController extends Controller {

	public function add() {

		return view('admin.item.add')->with([
			'item'		=> Item::full()->find(request()->get('item_id')),
			'producers' => Producer::readAllProducers(),
			'supplies'  => Supply::all(),
		]);
	}

	public function save(SaveItemRequest $request) {
		$itemId = $request->get('item_id');
		$fields = $this->convertPriceToEur($this->formFields());

		$item = $this->createItem($fields);

		return $this->successMessage($item, $itemId);
	}

	public function change($id) {

		return view('admin.item.change')->with([
			'item'		=> Item::full()->find($id),
			'producers' => Producer::readAllProducers(),
			'supplies'  => Supply::all(),
		]);
	}

	public function update($itemId) {
		$fields = $this->convertPriceToEur($this->formFields());

		$item = $this->updateItem($fields, $itemId);

		return $this->successMessage($item, $itemId);
	}

	public function delete($id) {
		$item = Item::find($id);
		$imageUpload = new ImageUpload();

		if ($item->photo != 'no_photo.png') {
			$imageUpload->deletePhoto($item->photo);
		}

		$item->delete();

		if($route = \Request::route()->getName() == 'delete_item_from_group') {

			return redirect()->back()->with('message', 'Товар Успешно удален!');
		} else {

			return redirect()->route('catalog_admin')->with('message', 'Товар успешно удален!');
		}
	}

	/**
	 * Create item
	 *
	 * @param array $fields
	 *
	 * @return mixed
	 */
	private function createItem($fields) {
		$imageUpload = new ImageUpload();
		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);

		return $item = Item::create($fields);
	}

	/**
	 * Update item
	 *
	 * @param array $fields
	 * @param int   $itemId
	 *
	 * @return mixed
	 */
	private function updateItem($fields, $itemId) {
		$imageUpload = new ImageUpload();

		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		$item = Item::find($itemId);
		$item->update($fields);

		return $item;
	}

	/**
	 * Add photo to temp directory on server and create the preview response
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function ajaxItemImage() {
		$imageUpload = new ImageUpload();

		return $imageUpload->ajaxImage();
	}

	/**
	 * Form fields for saving item
	 * @return array
	 */
	private function formFields() {
		$fields = request()->all();
		unset($fields['subcategoryActive']);
		unset($fields['categoryActive']);

		if (!isset($fields['special'])) {
			$fields['special'] = 0;
		}
		if (!isset($fields['hit'])) {
			$fields['hit'] = 0;
		}

		return $fields;

	}

	/**
	 * Convert price to eur if needed
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	private function convertPriceToEur($fields) {
		$categories = [
			'Механическое_en',
			'Тепловое_en',
			'Холодильное_en',
			'Моечное_en',
		];

		if (in_array($fields['category'], $categories) && $fields['currency']  == 'РУБ') {
			$fields['currency'] = 'EUR';
			$rate = new Rate();
			$fields['price'] = ceil($fields['price']/$rate->getRate()*100)/100;
		}
		unset($fields['category']);

		return $fields;
	}

	/**
	 * Return the success message and redirect
	 * @param $item
	 * @param $item_id
	 *
	 * @return mixed
	 */
	private function successMessage($item, $item_id) {
		if ($item_id) {
			$message = 'Товар '.$item->title.' изменен! <a href='.route('change_item', [$item->item_id]).' class="alert-link">Назад</a>';
			return redirect()->back()->with('message', $message);
		} else {
			$message = 'Товар '.$item->title.' добавлен! <a href='.route('change_item', [$item->item_id]).' class="alert-link">Назад</a>';
			return redirect()->back()->with('message', $message)->withInput();
		}
	}
}

