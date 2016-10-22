<div class="good">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('login', 'Логин', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('login', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'login']) }}
	</div>
</div>
<div class="good">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		@if(isset($admin))
			{{ Form::label('new_password', 'Новый пароль', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('new_password', null, ['class'=>'mdl-textfield__input', 'id' => 'password']) }}
		@else
			{{ Form::label('new_password', 'Пароль', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('new_password', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'password']) }}
		@endif
	</div>
</div>
<div class="good">
	<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="master" id="master_tooltip">
		@if(isset($admin))
			{{ Form::checkbox('master', true, $admin->master, ['class'=>'mdl-switch__input', 'id'=>'master']) }}
		@else
			{{ Form::checkbox('master', true, false, ['class'=>'mdl-switch__input', 'id'=>'master']) }}
		@endif
		<span class="mdl-switch__label">Сделать master-админом</span>
	</label>
	<div class="mdl-tooltip" for="master_tooltip">
		Master-админ <br>может создавать и редактировать<br> админов
	</div>
</div>