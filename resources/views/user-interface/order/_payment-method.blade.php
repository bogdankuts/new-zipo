<p class="step-title">Шаг 3 из 4 - Способ оплаты</p>
{{Form::open(['url' => route('store_order'), 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
<div class="general_info">
	@if(request()->session()->get('form_of_business') == 'jura')
		<div class="payment_method_jura">
			<div class="radio">
				<label>
					<input type="radio" name="payment" id="jura_pay" value="check" class="pay_radio" checked>
					Оплата по счету
				</label>
			</div>
		</div>
	@else
		<div class="payment_method_physic">
			<div class="radio">
				<label>
					<input type="radio" name="payment" id="physic_pay_card" value="card" class="pay_radio">
					Оплата на карту "Сбербанка"(скидка {{$discountCard}}%, скидки не суммируются)
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="payment" id="physic_pay_check" value="physic_check" class="pay_radio" checked>
					Оплата по счету
				</label>
			</div>
		</div>
	@endif
	@if(request()->session()->get('form_of_business') == 'jura')
		<div class="requisites">
			{{ Form::label('requisites', 'Реквизиты для оплаты: ', ['class'=>'main_label req']) }}
			{{ Form::file('requisites', ['class'=>'change_input change_input_code form-control',]) }}
		</div>
	@endif
	{{Form::hidden('step', 3)}}
</div>
{{Form::submit('Далее', ['class'=>'submit_field save_button btn'])}}
{{Form::close()}}