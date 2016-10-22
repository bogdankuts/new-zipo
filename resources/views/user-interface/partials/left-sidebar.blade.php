@section('left_sidebar')
	<div class="left_sidebar">
		<div class="container_sidebar">
			{{ Form::open(array('url' => "/search", 'method' => 'GET', 'class'=>'form-inline left_sidebar_search')) }}
				{{ Form::text('query', null, ['placeholder'=>"Поиск по каталогу", 'class'=>'form-control left_sidebar_input', 'id' =>'search']) }}
				{{ Form::submit('Поиск', ['class' => 'btn search_btn', 'id' => 'search_btn']) }}
			{{ Form::close() }}
			<div class="cart">
				<a href="{{route('cart')}}" class="left_sidebar_catalog_main_heading cart_link">
					<i class="fa fa-shopping-cart fa-2x"></i>
					<p>Корзина</p>
				</a>
				<p class="cart_include js_cart_full">В корзине <span class="totalPositionsContainer">0</span> позиций на сумму <span class="totalAmountContainer">0</span> руб.</p>
			</div>
			<div class="left_sidebar_catalog">
				<a  href="{{route('index')}}" class="left_sidebar_catalog_main_heading">Каталог</a><br>
				<h4 class="left_sidebar_heading">Импортное</h4>
				<div class="left_sidebar_catalog_categories">
					<ul class="left_sidebar_categories">
						<li>
							{{Html::linkRoute('category', 'Механическое оборудование', [str_slug('Механическое_en')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Тепловое оборудование', [str_slug('Тепловое_en')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Холодильное оборудование', [str_slug('Холодильное_en')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Моечное оборудование', [str_slug('Моечное_en')], [])}}
						</li>
					</ul>
					<h4 class="left_sidebar_heading">Отечественное</h4>
					<ul class="left_sidebar_categories">
						<li>
							{{Html::linkRoute('category', 'Механическое оборудование', [str_slug('Механическое_ru')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Тепловое оборудование', [str_slug('Тепловое_ru')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Холодильное оборудование', [str_slug('Холодильное_ru')], [])}}
						</li>
						<li>
							{{Html::linkRoute('category', 'Моечное оборудование', [str_slug('Моечное_ru')], [])}}
						</li>
					</ul>
				</div>
			</div>
			<a href="{{route('all_pdf')}}" class="watch_details">Посмотреть все деталировки</a>
			<div class="left_sidebar_recent">
				@if ($recent)
					<h3 class="recent_heading">Недавно просмотренные</h3>
					@foreach ($recent as $item)
						<a href="{{route('item', [str_slug($item->category), str_slug($item->subcat), str_slug($item->title)])."?subcat_id=$item->subcat_id&item_id=$item->item_id"}}" class="recent_link">
							<img src="/img/photos/items/{{$item->photo}}" alt="{{$item->title}}" class="recent">
						</a>
					@endforeach
				@endif
			</div>
		</div>
	</div>
@stop