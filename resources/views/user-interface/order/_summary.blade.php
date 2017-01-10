<p class="step-title">Шаг 5 из 5 - Подтверждение заказа</p>
{{Form::open(['url' => 'order', 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
	@include('user-interface.order._cart-contains')
	<p class="subheading-summary">Контактные данные</p>
	<div class="contact-data">
		<p>Имя - {{$data['name']}}</p>
		<p>Фамилия - {{$data['surname']}}</p>
		<p>Компания - {{$data['company']}}</p>
		<p>Телефон - {{$data['phone']}}</p>
		<p>Email - {{$data['email']}}</p>
		<p>Форма собсвтенности -
			@if ($data['form_of_business'] == 'jura')
				Юридическое лицо
			@else
				Физическое лицо
			@endif
		</p>
	</div>
	<p class="subheading-summary">Способ оплаты</p>
	<div class="payment-data">
		<p>Выбранный способ оплаты - {{$data['payment']}}</p>
		@if($data['payment'] == 'card')
			<p>Ваша скидка составляет {{$discountCard}}%.</p>
			<p>Обратите внимание, скидка за регистрацию и скидка за оплату картой не суммируются.</p>
		@endif
	</div>
	<p class="subheading-summary">Доставка</p>
	<div class="delivery-data">
		<p>Выбранный способ доставки - {{$data['deliveryNormal']}}</p>
		<p>Цена доставки -
			@if($data['deliveryPrice'] == 9999)
				Стоимость доставки пожалуйста уточните у менеджера.
			@elseif($data['deliveryPrice'] == 0)
				бесплатно
			@else
				{{$data['deliveryPrice']}} руб.
			@endif
			</p>
		<p>
			Цена товаров с доставкой -
			@if($data['deliveryPrice'] != 9999)
				{{round($data['deliveryPrice'] + $cartSum)}} руб.
			@else
				Итоговую сумму пожалуйста уточните у менеджера.
			@endif
		</p>
	</div>
	<p class="subheading-summary">Итоговая сумма</p>
	@if($data['deliveryPrice'] != 9999)
		<p>Итоговая сумма - {{round($data['deliveryPrice'] + $cartSum)}} руб.</p>
	@else
		<p>Итоговую сумму пожалуйста уточните у менеджера.</p>
	@endif
	<div class="comment">
		{{ Form::label('comment', 'Комментарий: ', ['class'=>'main_label']) }}
		{{ Form::textarea('comment', null, ['class'=>'change_input change_input_code form-control',]) }}
	</div>
	@if(Auth::user())
		{{ Form::hidden('registered', Auth::user()->user_id) }}
	@else
		{{ Form::hidden('registered', 0) }}
	@endif
{{Form::submit('Подтвердить', ['class'=>'submit_field save_button btn js-post-order'])}}
{{Form::close()}}