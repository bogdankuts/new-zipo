<div class="navbar_wraper">
	<nav class="navbar navbar-inverse nav_header">
		<ul class="nav navbar-nav">
			<li class="@if ($env == 'catalog' || $env == 'byproducer' || $env == 'search' || $env == 'prods_by_subcat' || $env == 'category') active @endif"><a href="{{route('index')}}">Каталог</a></li>
			{{--<li class="@if ($env == 'price') active @endif"><a href="{{route('price_page')}}">Прайс-лист</a></li>--}}
			<li class="@if ($env == 'delivery') active @endif"><a href="{{route('delivery')}}">Доставка</a></li>
			<li class="@if ($env == 'specials') active @endif"><a href="{{route('specials')}}">Специальные предложения</a></li>
			<li class="@if ($env == 'about') active @endif"><a href="{{route('about')}}">О нас</a></li>
			<li class="@if ($env == 'contacts') active @endif"><a href="{{route('contacts')}}">Контакты</a></li>
		</ul>
	</nav>
</div>