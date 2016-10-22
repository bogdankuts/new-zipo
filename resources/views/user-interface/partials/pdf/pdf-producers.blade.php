<div class="subcategory_block" data-category='{{$category}}'>
	<div class="subcategory_column">
		@for($i=1; $i<3; $i++)
			<div class="subcategory_{{$i}}">
				<ul>
					@foreach (columnize($producers[$category], 2, $i) as $producer)
						<li>
							@if ($env == 'catalog_admin')
								<a href="{{route('pdf_prod', [str_slug($category), str_slug($producer->producer)])."?producer_id=$producer->producer_id"}}">
									{{$producer->producer}}
								</a>
							@else
								<a href="{{route('pdf_prod', [str_slug($category), str_slug($producer->producer)])."?producer_id=$producer->producer_id"}}">
									{{$producer->producer}}
								</a>
							@endif
						</li>
					@endforeach
				</ul>
			</div>
		@endfor
	</div>
</div>