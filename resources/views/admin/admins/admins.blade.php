@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($admins as $admin)
			<div class="admin-card mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">
						@if($admin->master)
							Мастер-Администратор
						@else
							Администратор
						@endif
					</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<table class="mdl-data-table mdl-js-data-table">
						<tbody>
						<tr>
							<th class="mdl-data-table__cell--non-numeric">Логин</th>
							<th>{{$admin->login}}</th>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Дата добавления</td>
							<td>{{$admin->added_at}}</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Заходил последний раз</td>
							<td>{{$admin->last_visit}}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="mdl-card__menu">
					<button id="{{$admin->cred_id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$admin->cred_id}}-menu-trigger">
						<a href="{{route('change_admin', [$admin->cred_id])}}" class="mdl-menu__item">
							Изменить
						</a>
						{{Form::open(['url'=>route('delete_admin', [$admin->cred_id]), 'method'=>'POST', 'class'=>'delete_admin_form'])}}
						{{Form::hidden('admin_id', $admin->cred_id)}}
						<li class="mdl-menu__item js_trigger_closet_form">
							Удалить
						</li>
						{{Form::close()}}
					</ul>
				</div>
			</div>
		@endforeach
		<div class="add_btn" id="add_btn">
			<a href="{{route('create_admin')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить администратора
		</div>
	</div>
@stop

@section('page-js')
	{{ Html::script('js/admin/trigger-delete-form.js') }}
@stop