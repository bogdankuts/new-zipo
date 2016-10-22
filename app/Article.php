<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	public $timestamps = false;
	public $primaryKey = 'article_id';
	protected $fillable = ['title', 'body', 'weight', 'time', 'photo', 'meta_title', 'meta_description'];
	protected $dates = ['time'];


	public static function readAllArticles() {

		return Article::orderBy('weight', 'DESC')->get();
	}

	public static function getSidebarArticles($quantity) {

		return Article::orderBy('weight', 'DESC')->take($quantity)->get();
	}

	public static function noTitleArticles() {

		return Article::where('meta_title', '')->orderBy('weight', 'DESC')->get();
	}

	public static function noDescriptionArticles() {

		return Article::where('meta_description', '')->orderBy('weight', 'DESC')->get();
	}

	/**
	 * Get new articles after last visit
	 *
	 * @param $lastVisit
	 *
	 * @return mixed
	 */
	public static function getNewArticles($lastVisit) {

		return Article::whereBetween('time', [$lastVisit, Carbon::now()])->get();
	}
}
