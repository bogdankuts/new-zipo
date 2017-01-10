<div class="message">
	<p>На вашем ресурсе <a href="http://www.vsezip.ru" target="_blank">ЗИП общепит</a> была оставлена заявка на заказ товара!</p>
	<p>Номер заявки - {{$orderId}}</p>
</div>
<table class="order_form_table">
	<tr>
		<td class="main_label">Имя: </td>
		<td class="change_input form-control">{{$order['name']}}</td>
	</tr>
	<tr>
		<td class="main_label">Фамилия:</td>
		<td class="change_input form-control">{{$order['surname']}}</td>
	</tr>
	<tr>
		<td class="main_label">Телефон:</td>
		<td class="change_input change_input_code form-control">{{$order['phone']}}</td>
	</tr>
	<tr>
		<td class="main_label">Email:</td>
		<td class="change_input change_input_code form-control">{{$order['email']}}</td>
	</tr>
	<tr>
		<td class="main_label">Компания:</td>
		<td class="change_input change_input_code form-control">{{$order['company']}}</td>
	</tr>
	<tr>
		<td class="main_label">Форма собственности:</td>
		@if($order['form_of_business'] === 'jura')
			<td class="change_input change_input_code form-control">Юридическое лицо</td>
		@else
			<td class="change_input change_input_code form-control">Физическое лицо</td>
		@endif
	</tr>
	<tr>
		<td class="main_label">Способ доставки:</td>
		<td class="change_input change_input_code form-control">{{$order['deliveryNormal']}}</td>
	</tr>
	<tr>
		<td class="main_label">Адрес</td>
		<td class="change_input change_input_code form-control">{{$order['address']}}</td>
	</tr>
	<tr>
		<td class="main_label">Способ оплаты:</td>
		<td class="change_input change_input_code form-control">{{$payment}}</td>
	</tr>
	<tr>
		<td class="main_label">Скидка:</td>
		<td class="change_input change_input_code form-control">{{$discount}}%</td>
	</tr>
	<tr>
		<td class="main_label"><b><center>ТОВАРЫ</center></b></td>
	</tr>
	<tr>
		<td class="form-control">Артикул</td>
		<td class="form-control">Наименование</td>
		<td class="form-control">цена</td>
		<td class="form-control">Кол-во</td>
		<td class="form-control">Сумма</td>
	</tr>
	@foreach($items as $item)
		<tr>
			<td class="form-control">{{$item->code}}</td>
			<td class="form-control">{{$item->title}}</td>
			<td class="form-control">{{round($item->price)}} руб.</td>
			<td class="form-control">{{$item->count}}</td>
			<td class="form-control">{{round($item->price*$item->count)}} руб.</td>
		</tr>
	@endforeach
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td class="main_label">Сумма без доставки:</td>
		<td class="change_input change_input_code form-control">{{round($order['sum'])}} руб.</td>
	</tr>
	<tr>
		<td class="main_label">Цена доставки:</td>
		@if($order['deliveryPrice'] != 9999)
			<td class="change_input change_input_code form-control">{{$order['deliveryPrice']}} руб.</td>
		@else
			<td class="change_input change_input_code form-control">Стоимость доставки пожалуйста уточните у менеджера.</td>
		@endif
	</tr>
	<tr>
		<td class="main_label">Общая сумма:</td>
		@if($order['deliveryPrice'] != 9999)
			<td class="change_input change_input_code form-control">{{round($order['sum']+$order['deliveryPrice'])}} руб.</td>
		@else
			<td class="change_input change_input_code form-control">Общую сумму пожалуйста уточните у менеджера.</td>
		@endif
	</tr>
	<tr>
		<td class="main_label">Комментарий:</td>
		<td class="change_input change_input_code form-control">{{$order['comment']}}</td>
	</tr>
</table>
<p>Удачного дня!</p>