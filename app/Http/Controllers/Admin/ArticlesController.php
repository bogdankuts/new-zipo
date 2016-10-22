<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ImageUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ArticlesController extends Controller {

	public function articles() {

		return view('admin.articles.articles')->with([
			'articles'	=> Article::readAllArticles(),
		]);
	}

	public function add() {
		//TODO::fix KCFinder
		return view('admin.articles.add')->with([
			'article'	=> Article::find(request()->get('article_id')),
		]);
	}

	public function change($id) {
		//TODO::fix KCFinder
		return view('admin.articles.change')->with([
			'article'	=> Article::find($id),
		]);
	}

	public function save() {
		$fields = $this->formArticleFields();

		$article = $this->createArticle($fields);

		$message = 'Новость '.$article->title.' добавлена! <a href='.route('article_change', [$article->article_id]).' class="alert-link">Назад</a>';

		return redirect()->back()->with('message', $message);
	}

	public function update($articleId) {
		$fields = $this->formArticleFields();

		$article = $this->updateArticle($fields, $articleId);

		$message = 'Новость '.$article->title.' изменена! <a href='.route('article_change', [$article->article_id]).' class="alert-link">Назад</a>';

		return redirect()->route('article_change', [$article->article_id])->with('message', $message);
	}

	public function delete($id) {
		$article = Article::find($id);
		$imageUpload = new ImageUpload();

		if ($article->photo != 'no_photo.png') {
			$imageUpload->deletePhoto($article->photo);
		}

		$article->delete();

		return redirect()->route('articles_admin')->with('message', 'Новость успешно удалена!');
	}

	/**
	 * Form article data array
	 *
	 * @return array
	 */
	private function formArticleFields() {
		$fields = request()->all();
		$fields['time'] = Carbon::now();

		return $fields;
	}

	/**
	 * Update article with new fields
	 *
	 * @param array $fields
	 * @param int   $articleId
	 *
	 * @return mixed
	 */
	private function updateArticle($fields, $articleId) {
		$imageUpload = new ImageUpload();

		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);

		$article = Article::find($articleId);
		$article->update($fields);

		return $article;
	}

	/**
	 * Create new article from fields
	 *
	 * @param array $fields
	 *
	 * @return static
	 */
	private function createArticle($fields) {
		$imageUpload = new ImageUpload();
		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);

		return $article = Article::create($fields);
	}

	public function ajaxArticleImage() {
		$imageUpload = new ImageUpload();

		return $imageUpload->ajaxImage();
	}
}
