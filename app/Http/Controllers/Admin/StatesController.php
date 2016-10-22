<?php

namespace App\Http\Controllers\Admin;

use App\State;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StatesController extends Controller {
	public function createState() {
		$fields = request()->all();

		$rules = [
			'state_title' => 'required|unique:states,state_title'
		];
		$validator = \Validator::make($fields, $rules);

		if ($validator->fails()) {
			return redirect()->back()->withInput()
			               ->withErrors('Статус с таким названием уже существует!');
		} else {
			State::create($fields);
			return redirect()->back();
		}
	}

	public function ajaxUpdateState() {
		$state_id = request()->get('state_id');
		$new_title = request()->get('new_state');

		$state = State::find($state_id);
		$state->state_title = $new_title;

		$state->save();
	}

	public function ajaxDeleteState() {
		if(\Auth::guard('admin')->user()->master) {
			$stateId = request()->get('state_id');
			State::deleteState($stateId);
		}
	}
}
