<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminsController extends Controller {

	public function admins() {

		return view('admin.admins.admins')->with([
			'admins' => Admin::all(),
		]);
	}

	public function create() {

		return view('admin.admins.add')->with([
			'admin' => Admin::find(request()->get('admin_id')),
		]);
	}

	public function save() {
		$fields = $this->formFields(request()->all());

		Admin::create($fields);

		return redirect()->route('admins')->with('message', 'Администратор создан успешно.');
	}

	public function change($id) {

		return view('admin.admins.change')->with([
			'admin' => Admin::find($id),
		]);
	}

	public function update($id) {
		$fields = $this->formFields(request()->all());

		$admin = Admin::find($id);
		$admin->update($fields);

		return redirect()->route('admins')->with('message', 'Администратор создан успешно.');
	}

	public function delete($id) {
		Admin::deleteAdmin($id);

		return redirect()->route('admins')->with('message', 'Админ успешно удален!');
	}

	/**
	 * Form fields for update or create admin
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	private function formFields($fields) {
		if($fields['new_password'] !== '') {
			$fields['password'] = bcrypt($fields['new_password']);
			unset($fields['new_password']);
		} else {
			unset($fields['new_password']);
		}
		if(!array_key_exists('master', $fields)) {
			$fields['master'] = 0;
		} else {
			$fields['master'] = 1;
		}

		$fields['added_at'] = Carbon::now();
		$fields['last_visit'] = Carbon::now();

		return $fields;
	}
}
