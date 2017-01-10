<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//PAGES
Route::get('/',                                     ['as' => 'index',               'uses' => 'PagesController@indexPage']);
Route::get('/about',                                ['as' => 'about',               'uses' => 'PagesController@aboutPage']);
Route::get('/price',                                ['as' => 'price_page',          'uses' => 'PagesController@pricePage']);
Route::get('/get_price',                            ['as' => 'price',               'uses' => 'PagesController@getPrice']);
Route::get('/delivery',                             ['as' => 'delivery',            'uses' => 'PagesController@deliveryPage']);
Route::get('/map',                                  ['as' => 'map',                 'uses' => 'PagesController@map']);
Route::get('/specials',                             ['as' => 'specials',            'uses' => 'CatalogController@specialsPage']);
Route::get('/contacts',                             ['as' => 'contacts',            'uses' => 'PagesController@contactsPage']);
Route::get('/search',                               ['as' => 'search',              'uses' => 'PagesController@search']);

//ARTICLES
Route::get('/articles',                             ['as' => 'articles',            'uses' => 'ArticlesController@articles']);
Route::get('/articles/{article_title}',             ['as' => 'article',             'uses' => 'ArticlesController@article']);

//USER
Route::get('/registration',                         ['as' => 'registration_page',   'uses' => 'UserController@registrationPage']);
Route::post('/registration',                        ['as' => 'registration',        'uses' => 'UserController@registration']);
Route::post('/user_login',                          ['as' => 'login',               'uses' => 'UserController@userLogin']);
Route::post('/user_logout',                         ['as' => 'logout',              'uses' => 'UserController@userLogout']);
Route::post('/feedback',                            ['as' => 'feedback',            'uses' => 'UserController@feedback']);

//CART AND ORDER
Route::get('/cart',                                 ['as' => 'cart',                'uses' => 'CartController@cart']);
Route::get('/order',                                ['as' => 'order_page',          'uses' => 'OrderController@orderPage']);
Route::post('/order',                               ['as' => 'order',               'uses' => 'CartController@order']);
Route::post('/store-order-part',                    ['as' => 'store_order',         'uses' => 'OrderController@storePart']);

Route::get('/check',                                ['as' => 'check',               'uses' => 'CartController@checkCookie']);

//PDF
Route::get('/all_pdf',                              ['as' => 'all_pdf',             'uses' => "PdfController@allPdf"]);
Route::get('/all_pdf/{category}',                   ['as' => 'pdf_category',        'uses' => "PdfController@allPdfByCategory"]);
Route::get('/all_pdf/{category}/{producer}',        ['as' => 'pdf_prod',            'uses' => "PdfController@allPdfByProducer"]);
Route::get('/all_pdf/{category}/{producer}/{subcat}',['as' => 'pdf_prod_subcat',     'uses' => "PdfController@allPdfBySubcatProducer"]);
Route::get('/one_pdf/{category}',                   ['as' => 'one_pdf',             'uses' => "PdfController@onePdf"]);

//SALE
Route::get('/sale/{sale}',                          ['as' => 'one_sale',             'uses' => "SaleController@oneSale"]);


// ADMIN
Route::group(['namespace' => 'Admin'], function() {
	Route::get('/admin_login',                                      ['as' => 'admin_login_page',        'uses' => "LoginController@loginPage"]);
	Route::post('/admin_login',                                     ['as' => 'admin_login',             'uses' => "LoginController@login"]);
	Route::post('/admin/admin_logout',                              ['as' => 'admin_logout',            'uses' => "LoginController@logout"]);

	Route::group(['prefix'=>'/admin', 'before'=>'auth'], function() {
		//GENERAL
		Route::get('/search',                                       ['as' => 'admin_search',            'uses' => 'GeneralController@search']);

		// DASHBOARD
		Route::get('/',                                             ['as' => 'dashboard',               'uses' => 'DashboardController@dashboard']);
		Route::get('/new-admins-after-last-visit/{last_visit}',     ['as' => 'new_admins_after',        'uses' => 'DashboardController@newAdminsAfterVisit']);
		Route::get('/new-clients-after-last-visit/{last_visit}',    ['as' => 'new_clients_after',       'uses' => 'DashboardController@newClientsAfterVisit']);
		Route::get('/new-orders-after-last-visit/{last_visit}',     ['as' => 'new_orders_after',        'uses' => 'DashboardController@newOrdersAfterVisit']);
		Route::get('/new-users-after-last-visit/{last_visit}',      ['as' => 'new_users_after',         'uses' => 'DashboardController@newUsersAfterVisit']);
		Route::get('/new-articles-after-last-visit/{last_visit}',   ['as' => 'new_articles_after',      'uses' => 'DashboardController@newArticlesAfterVisit']);
		Route::post('/toggle-item-hit/{id}',                        ['as' => 'toggle_item_hit',         'uses' => 'DashboardController@toggleItemHit']);
		Route::post('/mark-order-as-done/{id}',                     ['as' => 'mark_order_as_done',      'uses' => 'OrdersController@markOrderAsDone']);
		Route::post('/set-discount',                                ['as' => 'set_discount',            'uses' => 'DashboardController@setDiscount']);
		Route::post('/set-eur-rate',                                ['as' => 'set_eur_rate',            'uses' => 'DashboardController@setEurRate']);
		Route::post('/get-eur-rate',                                ['as' => 'get_eur_rate',            'uses' => 'DashboardController@getCurrentRate']);
		Route::post('/import',                                      ['as' => 'import',                  'uses' => 'DashboardController@import']);

		// CATALOG
		Route::get('/catalog',                                      ['as' => 'catalog_admin',           'uses' => 'CatalogController@catalog']);
		Route::get('/catalog/{category}/{subcat}',                  ['as' => 'admin_subcat',            'uses' => 'CatalogController@items']);
		Route::get('/producers/{producer_title}',                   ['as' => 'admin_catalog_producer',  'uses' => 'CatalogController@byProducer']);
		Route::get('/no-title-items',                               ['as' => 'nt_items_admin',          'uses' => 'CatalogController@noTitleItems']);
		Route::get('/no-description-items',                         ['as' => 'nd_items_admin',          'uses' => 'CatalogController@noDescriptionItems']);

		Route::group(['prefix'=>'/item'], function() {
			Route::get('/add',                                      ['as' => 'add_item',                'uses' => 'ItemController@add']);
			Route::post('/add',                                     ['as' => 'save_item',               'uses' => 'ItemController@save']);
			Route::get('/update/{id}',                              ['as' => 'change_item',             'uses' => 'ItemController@change']);
			Route::post('/update/{id}',                             ['as' => 'update_item',             'uses' => 'ItemController@update']);
			Route::post('/delete/{id}',                             ['as' => 'delete_item',             'uses' => 'ItemController@delete']);
			Route::post('/group-delete/{id}',                       ['as' => 'delete_item_from_group',  'uses' => 'ItemController@delete']);
			Route::post('/make-special',                            ['as' => 'ajax_special',            'uses' => 'ItemsController@setSpecial']);
			Route::post('/make-hit',                                ['as' => 'ajax_hit',                'uses' => 'ItemsController@setHit']);
			Route::post('/set-procurement',                         ['as' => 'set_procurement',         'uses' => 'ItemsController@setProcurement']);
			Route::post('/change-subcategory',                      ['as' => 'change_subcategory',      'uses' => 'ItemsController@changeSubcategory']);
			Route::post('/change-pdf',                              ['as' => 'change_pdf',              'uses' => 'PdfController@ajaxChangePdf']);
			Route::post('/delete-group',                            ['as' => 'delete_group',            'uses' => 'ItemsController@deleteGroup']);
			Route::post('/ajax-image',                              ['as' => 'ajax_image',              'uses' => 'ItemController@ajaxItemImage']);
			Route::post('/multi-images',                            ['as' => 'multi_image',             'uses' => 'ItemController@addPhoto']);
			Route::post('/multi-images-delete/{photo}',             ['as' => 'multi_image_del',         'uses' => 'ItemController@deletePhoto']);
			Route::post('/multi-image-delete/{id}/{photo}',         ['as' => 'one_multi_image_del',     'uses' => 'ItemController@deleteExistingPhoto']);
		});

		// AJAX
		Route::post('/ajax-get-subcategories',                      ['as' => 'ajax_get_subcategories',  'uses' => 'ItemsController@getSubcategories']);

		// ARTICLE
		Route::get('/articles',                                     ['as' => 'articles_admin',          'uses' => 'ArticlesController@articles']);
		Route::group(['prefix'=>'/article'], function() {
			Route::get('/no-title',                                 ['as' => 'nt_articles_admin',       'uses' => 'ArticlesController@noTitleArticles']);
			Route::get('/no-description',                           ['as' => 'nd_articles_admin',       'uses' => 'ArticlesController@noDescriptionArticles']);
			Route::get('/add',                                      ['as' => 'add_article',             'uses' => 'ArticlesController@add']);
			Route::post('/add',                                     ['as' => 'save_article',            'uses' => 'ArticlesController@save']);
			Route::get('/update/{id}',                              ['as' => 'article_change',          'uses' => 'ArticlesController@change']);
			Route::post('/update/{id}',                             ['as' => 'article_update',          'uses' => 'ArticlesController@update']);
			Route::post('/delete/{id}',                             ['as' => 'delete_article',          'uses' => 'ArticlesController@delete']);
			Route::post('/ajax-image',                              ['as' => 'ajax_image_article',      'uses' => 'ArticlesController@ajaxArticleImage']);
		});

		// PRODUCER
		Route::get('/producers',                                    ['as' => 'admin_producers',         'uses' => 'ProducersController@producers']);
		Route::group(['prefix'=>'/producer'], function() {
			Route::get('/add',                                      ['as' => 'producer_add',            'uses' => 'ProducersController@add']);
			Route::post('/add',                                     ['as' => 'producer_save',           'uses' => 'ProducersController@save']);
			Route::get('/change/{id}',                              ['as' => 'producer_change',         'uses' => 'ProducersController@change']);
			Route::post('/update/{id}',                             ['as' => 'producer_update',         'uses' => 'ProducersController@update']);
			Route::post('/delete/{id}',                             ['as' => 'producer_delete',         'uses' => 'ProducersController@delete']);
			Route::post('/ajax-image',                              ['as' => 'ajax_image_producer',     'uses' => 'ProducersController@ajaxProducerImage']);
		});

		// SUBCATEGORIES
		Route::get('/subcategories',                                ['as' => 'admin_subcategories',     'uses' => 'SubcategoriesController@subcategories']);
		Route::post('/update-subcategory',                          ['as' => 'update_subcategory',      'uses' => 'SubcategoriesController@update']);
		Route::post('/delete-subcategory/{id}',                     ['as' => 'delete_subcategory',      'uses' => 'SubcategoriesController@delete']);

		// ORDERS
		Route::get('/orders',                                       ['as' => 'admin_orders',            'uses' => 'OrdersController@orders']);
		Route::get('/detailed-order/{id}',                          ['as' => 'admin_order',             'uses' => 'OrdersController@detailedOrder']);
		Route::post('/change-order-state',                          [                                   'uses' => 'OrdersController@changeOrderState']);
		Route::post('/delete-order/{id}',                           ['as' => 'delete_order',            'uses' => 'OrdersController@deleteOrder']);

		// STATES
		Route::post('/create_state',                                [                                   'uses' => 'StatesController@createState']);
		Route::post('/ajax-update-state',                           [                                   'uses' => 'StatesController@ajaxUpdateState']);
		Route::post('/ajax-delete-state',                           [                                   'uses' => 'StatesController@ajaxDeleteState']);

		// CLIENTS
		Route::get('/clients',                                      ['as' => 'admin_clients',           'uses' => 'ClientsController@clients']);
		Route::get('/detailed-client/{id}',                         ['as' => 'admin_client',            'uses' => 'ClientsController@client']);

		// USERS
		Route::get('/users',                                        ['as' => 'admin_users',             'uses' => 'UsersController@users']);
		Route::get('/detailed-user/{id}',                           ['as' => 'admin_user',              'uses' => 'UsersController@user']);

		// PDFS
		Route::group(['prefix'=>'/pdf'], function() {
			Route::get('/list',                                     ['as' => 'admin_pdfs',              'uses' => 'PdfController@pdfs']);
			Route::get('/create',                                   ['as' => 'create_pdf',              'uses' => 'PdfController@create']);
			Route::post('/save',                                    ['as' => 'save_pdf',                'uses' => 'PdfController@save']);
			Route::get('/change/{id}',                              ['as' => 'change_pdf_page',         'uses' => 'PdfController@change']);
			Route::post('/update/{id}',                             ['as' => 'update_pdf',              'uses' => 'PdfController@update']);
			Route::post('/delete/{id}',                             ['as' => 'delete_pdf',              'uses' => 'PdfController@delete']);
		});

		// ADMINS
		Route::group(['prefix'=>'/admin'], function() {
			Route::get('/list',                                     ['as' => 'admins',                  'uses' => 'AdminsController@admins']);
			Route::get('/add',                                      ['as' => 'create_admin',            'uses' => 'AdminsController@create']);
			Route::post('/save',                                    ['as' => 'save_admin',              'uses' => 'AdminsController@save']);
			Route::get('/change/{id}',                              ['as' => 'change_admin',            'uses' => 'AdminsController@change']);
			Route::post('/update/{id}',                             ['as' => 'update_admin',            'uses' => 'AdminsController@update']);
			Route::post('/delete/{id}',                             ['as' => 'delete_admin',            'uses' => 'AdminsController@delete']);
		});

		// SETTINGS
		Route::group(['prefix'=>'/settings'], function() {
			Route::get('/',                                         ['as' => 'settings',                'uses' => 'SettingsController@index']);
			Route::post('/set-discount-card',                       ['as' => 'set_discount_card',       'uses' => 'SettingsController@discountCard']);
			Route::post('/set-work-time',                           ['as' => 'set_time',                'uses' => 'SettingsController@setTime']);
			Route::post('/set-phones',                              ['as' => 'set_phones',              'uses' => 'SettingsController@setPhones']);
			Route::post('/set-email',                               ['as' => 'set_email',               'uses' => 'SettingsController@setEmail']);
			Route::post('/set-markup',                              ['as' => 'set_markup',              'uses' => 'SettingsController@setMarkup']);
			
		});
		Route::group(['prefix'=>'/settings/delivery'], function() {
			Route::get('/',                                         ['as' => 'admin_delivery',          'uses' => 'DeliveryController@index']);
			Route::post('/add',                                     ['as' => 'add_delivery',            'uses' => 'DeliveryController@create']);
			Route::post('/change/{id}',                             ['as' => 'update_delivery',         'uses' => 'DeliveryController@update']);
			Route::post('/delete/{id}',                             ['as' => 'delete_delivery',         'uses' => 'DeliveryController@delete']);
		});
		
		// SALE
		Route::group(['prefix'=>'/sale'], function() {
			Route::get('/list',                                     ['as' => 'admin_sales',             'uses' => 'SaleController@sales']);
			//Route::get('/create',                                   ['as' => 'create_sale',             'uses' => 'SaleController@create']);
			//Route::post('/save',                                    ['as' => 'save_sale',               'uses' => 'SaleController@save']);
			Route::get('/change/{id}',                              ['as' => 'change_sale_page',        'uses' => 'SaleController@change']);
			Route::post('/delete-from-sale/{item_id}',              ['as' => 'delete_from_sale',        'uses' => 'SaleController@deleteFromSale']);
			Route::post('/add-to-sale',                             ['as' => 'add_to_sale',             'uses' => 'SaleController@addToSale']);
			Route::post('/update/{id}',                             ['as' => 'update_sale',             'uses' => 'SaleController@update']);
			//Route::post('/delete/{id}',                             ['as' => 'delete_sale',             'uses' => 'SaleController@delete']);
		});

		Route::get('/about',                                        ['as' => 'admin_about',             'uses' => 'GeneralController@about']);

		// STATS
		//Route::get('/stats',                                        ['as' => 'stats',                   'uses' => 'GeneralAdminController@index']);
	});

});

$middleware = array_merge(\Config::get('lfm.middlewares'), ['Unisharp\Laravelfilemanager\middleware\MultiUser']);
$prefix = \Config::get('lfm.prefix', 'laravel-filemanager');
$as = 'unisharp.lfm.';
$namespace = 'Unisharp\Laravelfilemanager\controllers';

// make sure authenticated
Route::group(compact('middleware', 'prefix', 'as', 'namespace'), function () {

	// Show LFM
	Route::get('/', [
		'uses' => 'LfmController@show',
		'as' => 'show'
	]);

	// upload
	Route::any('/upload', [
		'uses' => 'UploadController@upload',
		'as' => 'upload'
	]);

	// list images & files
	Route::get('/jsonitems', [
		'uses' => 'ItemsController@getItems',
		'as' => 'getItems'
	]);

	// folders
	Route::get('/newfolder', [
		'uses' => 'FolderController@getAddfolder',
		'as' => 'getAddfolder'
	]);
	Route::get('/deletefolder', [
		'uses' => 'FolderController@getDeletefolder',
		'as' => 'getDeletefolder'
	]);
	Route::get('/folders', [
		'uses' => 'FolderController@getFolders',
		'as' => 'getFolders'
	]);

	// crop
	Route::get('/crop', [
		'uses' => 'CropController@getCrop',
		'as' => 'getCrop'
	]);
	Route::get('/cropimage', [
		'uses' => 'CropController@getCropimage',
		'as' => 'getCropimage'
	]);

	// rename
	Route::get('/rename', [
		'uses' => 'RenameController@getRename',
		'as' => 'getRename'
	]);

	// scale/resize
	Route::get('/resize', [
		'uses' => 'ResizeController@getResize',
		'as' => 'getResize'
	]);
	Route::get('/doresize', [
		'uses' => 'ResizeController@performResize',
		'as' => 'performResize'
	]);

	// download
	Route::get('/download', [
		'uses' => 'DownloadController@getDownload',
		'as' => 'getDownload'
	]);

	// delete
	Route::get('/delete', [
		'uses' => 'DeleteController@getDelete',
		'as' => 'getDelete'
	]);

	Route::get('/demo', function () {
		return view('laravel-filemanager::demo');
	});
});

//CATALOG
Route::get('/category/{category}',                  ['as' => 'category',                            'uses' => 'CatalogController@category']);
Route::get('/producers/{producer_title}',           ['as' => 'items_by_producer',                   'uses' => 'CatalogController@itemsByProducer']);
Route::get('/{category}/{subcat}',                  ['as' => 'producers_by_subcat',                 'uses' => 'CatalogController@producersBySubcat']);
Route::get('/{category}/{subcat}/{producer}/items', ['as' => 'items_by_subcat_and_producer',        'uses' => 'CatalogController@itemsBySubcatAndProducer']);
Route::get('/{category}/{subcat}/{item_title}',     ['as' => 'item',                                'uses' => 'CatalogController@item']);
