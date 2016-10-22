<?php

namespace App\Http\Controllers\Admin;

use App\Subcat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubcategoriesController extends Controller {
	public function subcategories() {
		$categories = [
			'Механическое_en'   => 'Механическое оборудование (импортное)',
			'Тепловое_en'       => 'Тепловое оборудование (импортное)',
			'Холодильное_en'    => 'Холодильное оборудование (импортное)',
			'Моечное_en'        => 'Моечное оборудование (импортное)',
			'Механическое_ru'   => 'Механическое оборудование (российское)',
			'Тепловое_ru'       => 'Тепловое оборудование (российское)',
			'Холодильное_ru'    => 'Холодильное оборудование (российское)',
			'Моечное_ru'        => 'Моечное оборудование (российское)'
		];

		return view('admin.subcategories.subcategories')->with([
			'subcats'       => Subcat::readAllSubcats(),
			'categories'    => $categories,
		]);
	}

	public function update() {
		$subcategoryId = request()->get('subcat_id');
		$fields = request()->all();

		$rules = [
			'subcat' => 'required|unique:subcats,subcat,NULL,subcat_id,category,'.$fields['category']
		];
		$validator = \Validator::make($fields, $rules);

		if ($validator->fails()) {

			return redirect()->back()->withInput()
			               ->withErrors('Подкатегория с таким названием уже существует!');
		} else {
			Subcat::updateOrCreate(['subcat_id' => $subcategoryId], $fields);

			return redirect()->back();
		}
	}

	public function delete($id) {
		$subcat = Subcat::find($id);
		$subcat->delete();

		return redirect()->back()->with('message', 'Подкатегория успешно удалена!');
	}
}
