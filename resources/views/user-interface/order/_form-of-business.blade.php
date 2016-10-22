<p class="step-title">Шаг 2 из 5 - Форма собственности</p>
{{Form::open(['url' => route('store_order'), 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
<div class="general_info">
	<label for="form_of_business" class="main_label req">Выбирете форму собственности</label>
	<div class="radio">
		<label>
			<input type="radio" name="form_of_business" id="jura" value="jura" class="pay_radio" checked>
			Юридические лица
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" name="form_of_business" id="physic" value="physic" class="pay_radio">
			Физические лица
		</label>
	</div>
	{{Form::hidden('step', 2)}}
</div>
{{Form::submit('Далее', ['class'=>'submit_field save_button btn'])}}
{{Form::close()}}