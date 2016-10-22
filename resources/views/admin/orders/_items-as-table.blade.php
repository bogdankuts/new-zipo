<table class="mdl-data-table mdl-js-data-table">
	<thead>
	<tr>
		<th class="">Код</th>
		<th>Наименование</th>
		<th>Наличие</th>
		<th class="">Цена</th>
		<th>Количесвто</th>
		<th>Сумма</th>
	</tr>
	</thead>
	<tbody>
	@foreach($order->items as $item)
		<tr>
			<td class="">{{$item->code}}</td>
			<td width="500" class="title-table">{{$item->title}}</td>
			<td>{{$item->supply_title}}</td>
			<td class="price">{{$item->price}} руб.</td>
			<td>{{$item->count}}</td>
			<td class="sum">{{$item->price*$item->count}} руб.</td>
		</tr>
	@endforeach
	</tbody>
</table>