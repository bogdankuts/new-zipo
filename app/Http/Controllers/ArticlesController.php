<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticlesController extends Controller {

	public function articles() {

		return view('user-interface.articles')->with([
			'allArticles'	=> Article::readAllArticles(),
		]);
	}

	public function article() {

		return view('user-interface.article')->with([
			'article'	=> Article::find(request()->get('article_id')),
		]);
	}
}
