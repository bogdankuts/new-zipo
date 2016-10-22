<div class="catalog_category @if(substr($category, 0, -3) == 'Тепловое' || substr($category, 0, -3) == 'Моечное') no-margin @endif" data-category='{{$category}}'>
	@if ($env == 'catalog_admin')
		<img src="../../img/markup/{{str_slug(substr($category, 0, -3))}}.png" alt="" class="catalog_category_img">
	@else
		<img src="img/markup/{{str_slug(substr($category, 0, -3))}}.png" alt="" class="catalog_category_img">
	@endif
	<p class="catalog_category_heading">{{substr($category, 0, -3)}}<br> оборудование</p>
</div>
