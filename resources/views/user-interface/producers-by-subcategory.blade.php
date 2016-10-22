@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Все производители подкатегории: {{$current->subcat}}</title>
	<meta name='keywords' content='Все производители подкатегории: {{$current->subcat}} - Зип Общепит'>
	<meta name='description' content='Все производители подкатегории: {{$current->subcat}} - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="/">Каталог</a></li>
			<li>
				<a href="{{route('category', [str_slug($current->category)])}}">
					{{substr($current->category, 0, -3)}} оборудование
				</a>
			</li>
			<li class="active">{{$current->subcat}}</li>
		</ol>
		<h3 class="items_page_main_header universal_heading">{{substr($current->category, 0, -3)}} оборудование</h3>
		<p class="items_subheading">{{$current->subcat}} сгрупированные по производителю</p>
		<hr class="main_hr">

		<div>
			<ul class="prod_by_subcat_list">
				@foreach ($producers as $producer)
					<li>
						<a href="{{route('items_by_subcat_and_producer', [str_slug($current->category), str_slug($current->subcat), str_slug($producer->producer)])."?subcat_id=$current->subcat_id&producer_id=$producer->producer_id"}}">
							<p>{{$producer->producer}}</p>
							<div class="prods_by_subcat_img_wrap">
								<img src="/img/photos/producers{{$producer->producer_photo}}" alt="{{$producer->producer}}" class="prods_by_subcat_img">
							</div>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@stop