<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {
	public $primaryKey = "state_id";
	public $timestamps = false;
	public $fillable = ['state_id', 'state_title'];

	public static function deleteState($stateId) {
		$state = State::find($stateId);
		Order::where('state', $stateId)->update(['state' => 1]);
		$state->delete();
	}
}
