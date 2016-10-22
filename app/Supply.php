<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model {
    protected $fillable = ['supply_title'];
	public $timestamps = false;
}
