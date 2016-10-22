<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AdminInterfaceComposer {

	protected $env = 'dashboard';

	protected $pageTitle = '';

	public function __construct() {
		$route = \Request::route()->getName();
		$this->makeEnv($route);
		$this->makePageTitle($route);
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
			'pageTitle' => $this->pageTitle,
		]);

		//view()->share('user', \Auth::user());
	}

	private function makeEnv($route) {
		switch ($route) {
			case 'dashboard':
				$this->env = 'dashboard';
				break;
			case 'new_admins_after':
				$this->env = 'new_admins_after_last_visit';
				break;
			case 'new_clients_after':
				$this->env = 'new_clients_after_last_visit';
				break;
			case 'new_users_after':
				$this->env = 'new_users_after_last_visit';
				break;
			case 'new_articles_after':
				$this->env = 'new_articles_after_last_visit';
				break;
			case 'new_orders_after':
				$this->env = 'new_orders_after_last_visit';
				break;
			case 'catalog_admin':
				$this->env = 'catalog_admin';
				break;
			case 'admin_subcat':
				$this->env = 'catalog_admin';
				break;
			case 'add_item':
				$this->env = 'change_item';
				break;
			case 'articles_admin':
				$this->env = 'articles';
				break;
			case 'add_article':
				$this->env = 'change_article';
				break;
			case 'article_change':
				$this->env = 'change_article';
				break;
			case 'producers_admin':
				$this->env = 'producers';
				break;
			case 'producer_add':
				$this->env = 'change_producer';
				break;
			case 'producer_change':
				$this->env = 'change_producer';
				break;
			case 'admin_subcategories':
				$this->env = 'subcategories';
				break;
			case 'admin_orders':
				$this->env = 'orders';
				break;
			case 'admin_order':
				$this->env = 'order';
				break;
			case 'admin_clients':
				$this->env = 'clients';
				break;
			case 'admin_client':
				$this->env = 'client';
				break;
			case 'admin_users':
				$this->env = 'users';
				break;
			case 'admin_user':
				$this->env = 'user';
				break;
			case 'admin_pdfs':
				$this->env = 'pdfs';
				break;
			case 'change_pdf':
				$this->env = 'change_pdf';
				break;
			case 'add_pdf':
				$this->env = 'change_pdf';
				break;
			case 'admins':
				$this->env = 'admins';
				break;
			case 'create_admin':
				$this->env = 'create_admin';
				break;
			case 'change_admin':
				$this->env = 'change_admin';
				break;
			case 'settings':
				$this->env = 'settings';
				break;
			case 'admin_delivery':
				$this->env = 'delivery';
				break;
			case 'about':
				$this->env = 'about';
				break;
			case 'search':
				$this->env = 'search';
				break;
		}
	}

	private function makePageTitle($route) {
		switch($route) {
			case 'dashboard':
				$this->pageTitle = 'Dashboard';
				break;
			case 'new_admins_after':
				$this->pageTitle = 'Новые админы';
				break;
			case 'new_clients_after':
				$this->pageTitle = 'Новые Клиенты';
				break;
			case 'new_orders_after':
				$this->pageTitle = 'Новые Заказы';
				break;
			case  'new_users_after':
				$this->pageTitle = 'Новые Клиенты';
				break;
			case 'new_articles_after':
				$this->pageTitle = 'Новые Статьи';
				break;
			case 'catalog_admin':
				$this->pageTitle = 'Каталог';
				break;
			case 'admin_subcat':
				$this->pageTitle = 'Каталог';
				break;
			case 'add_item':
				$this->pageTitle = 'Добавление товара';
				break;
			case 'change_item':
				$this->pageTitle = 'Изменение товара';
				break;
			case 'articles_admin':
				$this->pageTitle = 'Статьи';
				break;
			case 'add_article':
				$this->pageTitle = 'Добавление статьи';
				break;
			case 'article_change':
				$this->pageTitle = 'Изменение статьи';
				break;
			case 'admin_producers':
				$this->pageTitle = 'Производители';
				break;
			case 'producer_add':
				$this->pageTitle = 'Добавление производителя';
				break;
			case 'producer_change':
				$this->pageTitle = 'Изменение производителя';
				break;
			case 'admin_subcategories':
				$this->pageTitle = 'Подкатегории';
				break;
			case 'admin_orders':
				$this->pageTitle = 'Заказы';
				break;
			case 'admin_order':
				$this->pageTitle = 'Заказ';
				break;
			case 'admin_clients':
				$this->pageTitle = "Клиенты";
				break;
			case 'admin_client':
				$this->pageTitle = "Клиент";
				break;
			case 'admin_users':
				$this->pageTitle = "Пользователи";
				break;
			case 'admin_user':
				$this->pageTitle = "Позьзователь";
				break;
			case 'admin_pdfs':
				$this->pageTitle = "Деталировки";
				break;
			case 'admin_pdf':
				$this->pageTitle = "Деталировка";
				break;
			case 'create_pdf':
				$this->pageTitle = "Загрузка деталировки";
				break;
			case 'change_pdf_page':
				$this->pageTitle = "Изменение деталировки";
				break;
			case 'admins':
				$this->pageTitle = "Администраторы";
				break;
			case 'new_admin':
				$this->pageTitle = "Администратор";
				break;
			case 'create_admin':
				$this->pageTitle = "Добавление администратора";
				break;
			case 'change_admin':
				$this->pageTitle = "Изменение администратора";
				break;
			case 'search':
				$this->pageTitle = "Результаты поиска";
				break;
			case 'admin_about':
				$this->pageTitle = "Версия 2.0.5";
				break;
			case 'settings':
				$this->pageTitle = "Настройки сайта";
				break;
			case 'admin_delivery':
				$this->pageTitle = "Поставки";
				break;
		}
	}
}