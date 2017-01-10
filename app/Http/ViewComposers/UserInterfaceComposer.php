<?php

namespace App\Http\ViewComposers;

use App\Article;
use App\Recent;
use App\Setting;
use Carbon\Carbon;
use Illuminate\View\View;

class UserInterfaceComposer {

	protected $env = 'catalog';
	//protected $showModal;
	protected $primary_phone;
	protected $secondary_phone;
	protected $winterDecoration = 0;


	public function __construct() {
		$route = \Request::route()->getName();
		switch ($route) {
			case 'price_page':
				$this->env = 'price';
				break;
			case 'delivery':
				$this->env = 'delivery';
				break;
			case 'about':
				$this->env = 'about';
				break;
			case 'contacts':
				$this->env = 'contacts';
				break;
			case 'specials':
				$this->env = 'specials';
				break;
			case 'item':
				$this->env = 'item';
				break;
			case 'category':
				$this->env = 'category';
				break;
			case 'items_by_subcat_and_producer':
				$this->env = 'prods_by_subcat';
				break;
			case 'producers_by_subcat':
				$this->env = 'prods_by_subcat';
				break;
			case 'items_by_producer':
				$this->env = 'byproducer';
				break;
			case 'search':
				$this->env = 'search';
				break;
			case 'articles':
				$this->env = 'articles';
				break;
			case 'article':
				$this->env = 'article';
				break;
			case 'cart':
				$this->env = 'cart';
				break;
			case 'order_page':
				$this->env = 'order';
				break;
		}

		$ip = request()->getClientIp();
		$hasCookie = $this->checkCookieForIp($ip);
		$this->showModal = $this->checkIfModalMustBeShown($hasCookie);

		$this->primary_phone = Setting::find(9);
		$this->secondary_phone = Setting::find(10);
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view) {
		$view->with([
			'env'       => $this->env,
			'modal'     => $this->showModal,
			'articles'	=> Article::getSidebarArticles(4),
			'recent'	=> Recent::readAllRecent(),
		    'p_phone'   => $this->primary_phone,
		    's_phone'   => $this->secondary_phone,
		    'snow'      => $this->winterDecoration
		]);

		//view()->share('user', \Auth::user());
	}

	private function checkIfModalMustBeShown($hasCookie) {
		if ($hasCookie) {
			if($_COOKIE['dateOfVisit'] < Carbon::now()->subDays(7)) {

				return true;
			} else {

				return false;
			}
		} else {

			return true;
		}
	}

	private function checkCookieForIp($ip) {
		if (isset($_COOKIE['ip'])) {

			return true;
		} else {
			setcookie('ip', $ip );
			setcookie('dateOfVisit', Carbon::now());

			return false;
		}

	}
}