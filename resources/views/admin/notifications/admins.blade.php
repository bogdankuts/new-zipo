@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($newAdmins as $admin)
			<div class="admin-card mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Администратор</h2>
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
			</div>
		@endforeach
	</div>

@stop
