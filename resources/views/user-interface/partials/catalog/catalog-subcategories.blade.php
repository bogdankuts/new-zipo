<div class="subcategory_block" data-category='{{$category}}'>
	<div class="subcategory_column">
		@for($i=1; $i<3; $i++)
			<div class="subcategory_{{$i}}">
				<ul>
					@foreach (columnize($subcats[$category], 2, $i) as $subcat)
						<li>
							@if ($env == 'catalog_admin')
								<a href="{{route('admin_subcat', [str_slug(substr($category, 0, -3)), str_slug($subcat->subcat)])."?subcat_id=$subcat->subcat_id"}}">
									{{$subcat->subcat}}
								</a>
							@else
								<a href="{{route('producers_by_subcat', [str_slug(substr($category, 0, -3)), str_slug($subcat->subcat)])."?subcat_id=$subcat->subcat_id"}}">
									{{$subcat->subcat}}
								</a>
							@endif
						</li>
					@endforeach
				</ul>
			</div>
		@endfor
	</div>
</div>