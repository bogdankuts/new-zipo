<div class="catalog_bottom_pages">
	<div class="items_sort_by_main">
		<p class="items sort_by">Показать по: </p>
		<?php $q = http_build_query(request()->except(['page', 'pages_by'])); ?>
		<select name="pages_by" id="pages_by" class="form-control form_control">
			<option data-link="{{ URL::current().'?'.$q.'&pages_by=10' }}" value="10">
				10
			</option>
			<option data-link="{{ URL::current().'?'.$q.'&pages_by=50' }}" value="50">
				50
			</option>
			<option data-link="{{ URL::current().'?'.$q.'&pages_by=100' }}" value="100">
				100
			</option>
			<option data-link="{{ URL::current().'?'.$q.'&pages_by=1000000' }}" value="1000000">
				все
			</option>
		</select>
	</div>
</div>
