<div class="recommended">
	<h4 class="item_page_recommended_heading">Похожие товары</h4>
	@foreach ($same as $item)
		@include('user-interface.partials.items.one-item')
	@endforeach
</div>