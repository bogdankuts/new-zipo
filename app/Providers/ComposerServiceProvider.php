<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot() {

		$UIViews = ['index',
		            'price',
		            'delivery',
		            'about',
		            'contacts',
		            'items',
		            'item',
		            'category',
		            'producers-by-subcategory',
		            'articles',
		            'article',
		            'registration',
		            'cart',
		            'order',
		            'order',
		            'pdf-all',
		            'pdf-by-producer',
		            'pdf-one',
		            'pdf-by-category',
		            'order.order',
		            'sale'
		];

		foreach ($UIViews as $view) {
			$userInterface[] = 'user-interface.'.$view;
		}

		View::composer($userInterface, 'App\Http\ViewComposers\UserInterfaceComposer');

		$adminViews = ['dashboard.dashboard',
		               'notifications.admins',
		               'notifications.users',
		               'notifications.clients',
		               'notifications.orders',
		               'notifications.articles',
		               'import.status',
		               'catalog.catalog',
		               'catalog.items',
		               'item.add',
		               'item.change',
		               'articles.articles',
		               'articles.add',
		               'articles.change',
		               'producers.producers',
		               'producers.producers',
		               'producers.add',
		               'producers.change',
		               'subcategories.subcategories',
		               'orders.orders',
		               'orders.order',
		               'clients.clients',
		               'clients.client',
		               'users.users',
		               'users.user',
		               'pdfs.pdfs',
		               'pdfs.add',
		               'pdfs.change',
		               'admins.admins',
		               'admins.add',
		               'admins.change',
		               'settings.settings',
		               'deliveries.deliveries',
		               'about.about',
		               'sale.sales',
		               'sale.change'

		];

		foreach ($adminViews as $view) {
			$adminInterface[] = 'admin.'.$view;
		}

		View::composer($adminInterface, 'App\Http\ViewComposers\AdminInterfaceComposer');

		//// Using Closure based composers...
		//View::composer('dashboard', function ($view) {
		//
		//});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}