@section('drawer')
	<div class="mdl-layout__drawer">
		<span class="mdl-layout-title">Привет, {{Auth::guard('admin')->user()->login}}</span>
		<nav class="mdl-navigation">

			<a class="mdl-navigation__link @if ( $env == 'dashboard') active_nav @endif" href="{{route('dashboard')}}">Панель управления</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'catalog_admin') active_nav @endif" href="{{route('catalog_admin')}}">Товары</a>
			<a class="mdl-navigation__link @if ( $env == 'change_item') active_nav @endif" href="{{route('add_item')}}">Добавить товар</a>
			<div class="mdl-navigation__devider"></div>
			<a class="mdl-navigation__link @if ( $env == 'articles') active_nav @endif" href="{{route('articles_admin')}}">Новости</a>
			<a class="mdl-navigation__link @if ( $env == 'change_article') active_nav @endif" href="{{route('add_article')}}">Добавить новость</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'producers') active_nav @endif" href="{{route('admin_producers')}}">Производители</a>
			<a class="mdl-navigation__link @if ( $env == 'change_producer') active_nav @endif" href="{{route('producer_add')}}">Добавить прозводителя</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'subcategories') active_nav @endif" href="{{route('admin_subcategories')}}">Подкатегории</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'orders' || $env == 'order') active_nav @endif" href="{{route('admin_orders')}}">Заказы</a>
			<a class="mdl-navigation__link @if ( $env == 'clients' || $env == 'client') active_nav @endif" href="{{route('admin_clients')}}">Клиенты</a>
			<a class="mdl-navigation__link @if ( $env == 'users' || $env == 'user') active_nav @endif" href="{{route('admin_users')}}">Пользователи</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'pdfs') active_nav @endif" href="{{route('admin_pdfs')}}">Деталировки</a>
			<a class="mdl-navigation__link @if ( $env == 'create_pdf' || $env == 'change_pdf' ) active_nav @endif" href="{{route('create_pdf')}}">Добавить деталировку</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'settings') active_nav @endif" href="{{route('settings')}}">Настройки</a>
			<a class="mdl-navigation__link @if ( $env == 'delivery') active_nav @endif" href="{{route('admin_delivery')}}">Поставки</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'admins') active_nav @endif" href="{{route('admins')}}">Администраторы</a>
			<a class="mdl-navigation__link @if ( $env == 'create_admin' || $env == 'change_admin') active_nav @endif" href="{{route('create_admin')}}">Добавить администратора</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link" href="{{route('admin_about')}}"><i class="material-icons">help_outline</i></a>
		</nav>
	</div>
@stop