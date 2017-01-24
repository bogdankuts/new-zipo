@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="detailed-admin">
			<h1>Статистика администратора {{$admin->login}} за {{\Carbon\Carbon::now()->year}} год</h1>
			<div class="admin-statistics">
				<div class="stat-block">
					<p class="stat-block-title">Товары</p>
					<div class="by-month">
						<table rules="rows">
							<tbody>
								<tr>
									<th>Меясц</th>
									<th>Добвалено</th>
									<th>Изменено</th>
									<th>Подробнее</th>
								</tr>
								@foreach($byMonth as $month)
									<tr>
										<td>{{$month['title']}}</td>
										<td>{{$month['items_added']}}</td>
										<td>{{$month['items_changed']}}</td>
										<td><a href="{{route('admin_item_month', [$admin->cred_id, array_search($month, $byMonth)])}}">Смотреть добавленные</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="stat-block">
					<p class="stat-block-title">Деталировки</p>
					<div class="by-month">
						<table rules="rows">
							<tbody>
							<tr>
								<th>Меясц</th>
								<th>Добвалено</th>
								<th>Изменено</th>
								<th>Подробнее</th>
							</tr>
							@foreach($byMonth as $month)
								<tr>
									<td>{{$month['title']}}</td>
									<td>{{$month['pdfs_added']}}</td>
									<td>{{$month['pdfs_changed']}}</td>
									<td><a href="{{route('admin_pdfs_month', [$admin->cred_id, array_search($month, $byMonth)])}}">Смотреть добавленные</a></td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if (Auth::guard('admin')->user()->master)
			<div class="add_btn" id="add_btn">
				<a href="{{route('create_admin')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
					<i class="material-icons">add</i>
				</a>
			</div>
			<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
				Добавить администратора
			</div>
		@endif
	</div>
@stop

@section('page-js')
	{{ Html::script('js/admin/trigger-delete-form.js') }}
@stop