@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list new_admins_list--users mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($newUsers as $client)
			<div class="admin-card mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Клиент</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<table class="mdl-data-table mdl-js-data-table">
						<tbody>
						<tr>
							<th class="mdl-data-table__cell--non-numeric">ФИО</th>
							<th>{{$client->name}} {{$client->surname}}</th>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Дата регистрации</td>
							<td>{{$client->timestamp}}</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Телефон</td>
							<td>{{$client->phone}}</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Email</td>
							<td>{{$client->email}}</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Компания</td>
							<td>
								@if( $client->company != '')
									{{$client->company}}
								@else
									-
								@endif
							</td>
						</tr>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Род деятельности</td>
							<td>{{$client->activity}}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('admin_user', [$client->user_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
				</div>
			</div>
		@endforeach
	</div>
@stop
