@section('body')
	@if (Session::get('message'))
		<div class="message alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i aria-hidden="true" class="fa fa-times close_message"></i></button>
			<p class="message_text">{{ Session::get('message') }}</p>
		</div>
	@endif
	<div class="main_content">
		<div class="headings">
			<p class="catalog_heading universal_heading">Каталог продукции</p>
			<p class="catalog_subheading">По виду продукции</p>
			<hr class="catalog_hr">
		</div>
		<div class="catalog_categories">
			@foreach(['en', 'ru'] as $lang)
				<div class="catalog">
					<h4 class="catalog_part_heading">
						@if($lang =='en')
							Импортное
						@else
							Отечественное
						@endif
					</h4>
					@foreach(array_chunk($categories[$lang], 2) as $categoryArray)
						@foreach($categoryArray as $category)
							@include('user-interface.partials.catalog.catalog-categories')
						@endforeach
						@foreach($categoryArray as $category)
							@include('user-interface.partials.catalog.catalog-subcategories')
						@endforeach
					@endforeach
				</div>
			@endforeach
		</div>
		<div class="catalog_producers">
			<div class="producers_block_heding">
				<p class="catalog_subheading subheading_brands sub_moz">По производителю</p>
				<hr class="catalog_hr">
			</div>
			<div class = "groups">
				@for($i=1; $i<3; $i++)
					<div class="producers_{{$i}}">
						<table class="producers_list">
							@foreach (columnize($producers, 2, $i) as $producer)
								<tr>
									<td>
										@if ($env == 'catalog_admin')
											<a href="{{route('admin_catalog_producer', [str_slug($producer->producer)])."?producer_id=$producer->producer_id"}}">
												{{$producer->producer}}
											</a>
										@else
											<div class="producer_two_links">
												<a href="{{route('items_by_producer', [str_slug($producer->producer)])."?producer_id=$producer->producer_id"}}" class="prod_a">
													{{$producer->producer}}
												</a>
												<a href="{{route('items_by_producer', [str_slug($producer->producer)])."?producer_id=$producer->producer_id"}}" class="full_prod_a">
													{{$producer->producer}}
												</a>
											</div>
										@endif
									</td>
								</tr>
							@endforeach
						</table>
					</div>
				@endfor
			</div>
		</div>
	</div>
@stop
