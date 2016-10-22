<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'login', 'password', 'master', 'last_visit', 'added_at'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public $timestamps = false;

	public $dates = ['last_visit', 'added_at'];

	public $primaryKey = 'cred_id';

	protected $table = 'creds';


	/**
	 * Get new admins after last visit
	 *
	 * @param $lastVisit
	 *
	 * @return mixed
	 */
	public static function getNewAdmins($lastVisit) {

		return Admin::whereBetween('added_at', [$lastVisit, Carbon::now()])->get();
	}

	public static function deleteAdmin($id) {
		$settings = Setting::where('changed_by', $id)->update(['changed_by' => 1]);
		Admin::destroy($id);
	}

}
