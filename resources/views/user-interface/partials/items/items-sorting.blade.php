<div class="items_sort_div">
	<p class="items_sort_by">Сортировать по: </p>

	<?php $q = http_build_query(request()->except(['page', 'order', 'sort']));?>
	<select name="items_sort" id="items_sort" class="form-control items_sort_c">
		<option data-link="{{URL::current().'?'.$q.'&sort=visits&order=desc' }}" value="visits" data-order="desc">
			популярности(&#8595;)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=visits&order=asc' }}" value="visits" data-order="asc">
			популярности(&#8593;)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=title&order=asc' }}" value="title" data-order="asc">
			имени(а-я)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=title&order=desc' }}" value="title" data-order="desc">
			имени(я-а)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=price&order=asc' }}" value="price" data-order="asc">
			цене($-$$$)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=price&order=desc' }}" value="price" data-order="desc">
			цене($$$-$)
		</option>
	</select>
</div>