@if ($env == 'specials')
	<ol class="breadcrumb">
		<li><a href="{{route('index')}}">Каталог</a></li>
		<li class="active">Спецпредложения</li>
	</ol>
	<h3 class="items_main_header universal_heading">Спецпредложения</h3>
@elseif ($env == 'catalog')
	<ol class="breadcrumb">
		<li><a href="{{route('index')}}">Каталог</a></li>
		<li>
			<a href="{{route('category', [str_slug($current->category)])}}">
				{{substr($current->category, 0, -3)}} оборудование
			</a>
		</li>
		<li class="active">{{$current->subcat}}</li>
	</ol>
	<h3 class="items_page_main_header universal_heading">{{substr($current->category, 0, -3)}} оборудование</h3>
	<p class="items_subheading">{{$current->subcat}}</p>
@elseif ($env == 'prods_by_subcat')
	<ol class="breadcrumb">
		<li><a href="{{route('index')}}">Каталог</a></li>
		<li>
			<a href="{{route('category', [str_slug($current->category)])}}">
				{{substr($current->category, 0, -3)}} оборудование
			</a>
		</li>
		<li>
			<a href="{{route('producers_by_subcat', [str_slug($current->category), str_slug($current->subcat)])."?subcat_id=$current->subcat_id"}}">
				{{$current->subcat}}
			</a>
		</li>
		<li class="active">
			{{$producer->producer}}
		</li>
	</ol>
	<a href="{{route('pdf_prod_subcat', [str_slug($current->category), str_slug($producer->producer), str_slug($current->subcat)])."?producer_id=".$producer->producer_id."&subcat_id=$current->subcat_id"}}" class="btn watch_by_prod_btn watch_by_prod_and_subcat">
		Посмотреть деталировки
	</a>
	<h3 class="items_page_main_header universal_heading">{{substr($current->category, 0, -3)}} оборудование</h3>
	<p class="items_subheading">{{$current->subcat}}</p>
	<p class="items_subheading sub_head_second"> производителя "{{$producer->producer}}"</p>
@elseif ($env=='byproducer')
	<ol class="breadcrumb">
		<li><a href="{{route('index')}}">Каталог</a></li>
		<li class="active">{{$current->producer}}</li>
	</ol>
	{{--<a href="{{route('pdf_only_prod', [str_slug($current->producer)])."?producer_id=$current->producer_id"}}" class="btn watch_by_prod_btn">--}}
		{{--Посмотреть деталировки--}}
	{{--</a>--}}
	<h3 class="items_page_main_header universal_heading">{{$current->producer}}</h3>
@elseif ($env=='search')
	<h3 class="items_page_main_header universal_heading">Результаты поиска: {{$current}}</h3>
@endif