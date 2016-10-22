<p class="step-title">Шаг 4 из 5 - Доставка</p>
{{Form::open(['url' => route('store_order'), 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
	<div class="delivery_type">
		<label for="delivery" class="main_label req">Способ доставки</label>
		<select name="delivery" id="delivery" class="form-control">
			<option value="self">Самовывоз</option>
			<option value="St.Petersburg_delivery">Доставка По Санкт Петербургу</option>
			<option value="TK_business_lines">Доставка до терминала ТК Деловые Линии в Санкт Петербурге</option>
			<option value="EMC">Доставка EMC до адреса получателя.</option>
			<option value="PEK">Доставка до терминала ТК ПЭК в Санкт Петербурге</option>
			<option value="SDEK">Доставка экспресс почтой СДЭК до адреса получателя.</option>
			<option value="RATEK">Доставка до терминала ТК РАТЭК в Санкт Петербурге.</option>
			<option value="PONY">Доставка экспресс почтой Pony express  до адреса получателя.</option>
			<option value="Dimex">Доставка экспресс почтой  dimex до адреса получателя.</option>
			<option value="MSK">Доставка в Москву (в МКАД) Элайн  экспресс. (1 рабочий день)</option>
			<option value="Other">Другое</option>
		</select>
		<input type="text" name="delivery_other" id="deliver_other" placeholder="Введите желаемый способ доставки" class="form-control delivery_other">
		<div class="address">
			{{ Form::label('address', 'Адрес: ', ['class'=>'main_label']) }}
			{{ Form::text('address', null, ['class'=>'change_input change_input_code form-control',]) }}
		</div>
	</div>
	<div class="price_of_delivery">
		<p>Стоимость доставки:
			<span id="delivery_only_summ">0 руб.</span>
		</p>
	</div>
	{{Form::hidden('step', 4)}}
	{{Form::submit('Далее', ['class'=>'submit_field save_button btn'])}}
{{Form::close()}}