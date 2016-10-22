@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	@include('admin.dashboard.notifications')
	@include('admin.dashboard.orders')
	@include('admin.dashboard.items')
	<div class="set_discount mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Скидка для зарегистрированных пользователей</h4>
		{{ Form::open(array('url' => "/admin/set-discount", 'method' => 'POST', 'class'=>'admin_discount_input')) }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('discount', 'Дисконт', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('discount', $discount, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discount']) }}
			{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
		</div>
		{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		{{ Form::close() }}
	</div>
	<div class="eur_rate mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Текущий курс евро<br />на {{Carbon\Carbon::now()->format('d-m-Y')}}</h4>
		{{ Form::open(array('url' => "/admin/set-eur-rate", 'method' => 'POST', 'class'=>'admin_discount_input rate_input')) }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('rate', 'Курс', ['class'=>'mdl-textfield__label']) }}
			{{ Form::number('rate', $rate, ['class'=>'mdl-textfield__input', 'required', 'id' => 'rate', 'step' => 0.0001]) }}
		</div>
		{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		{{ Form::close() }}
	</div>
	<div class="eur_rate mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Импорт</h4>
		{{ Form::open(['url'=>'/admin/import', 'files'=>true, 'method'=>'POST', 'class'=>'admin_panel_import']) }}
		{{ Form::file('excel', ['class'=>'admin_panel_input']) }}
		{{ Form::submit('Импортировать', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent import_btn']) }}
		{{ Form::close() }}
	</div>
	<div class="statistics mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="statistics-count items_count">
			<h2 class="heading">Всего товаров на сайте</h2>
			<p class="value">{{$allItems}}</p>
			<a href="{{route('catalog_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				Посмотреть товары
			</a>
		</div>
		<div class="statistics-count articles_count">
			<h2 class="heading">Всего статей на сайте</h2>
			<p class="value">{{$allArticles}}</p>
			<a href="{{route('articles_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				Посмотреть статьи
			</a>
		</div>
		<div class="statistics-count pdf_count">
			<h2 class="heading">Всего деталировок на сайте</h2>
			<p class="value">{{$allPdfs}}</p>
			<a href="{{route('admin_pdfs')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				Посмотреть деталировки
			</a>
		</div>
	</div>
	@include('admin.dashboard.no-meta-statistics')
@stop

@section('page-js')
	{{Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js')}}
	{{Html::script('js/admin/statistics.js')}}
	{{Html::script('js/admin/notifications.js')}}
	{{Html::script('js/admin/make-item-hit.js')}}
	{{Html::script('js/admin/make-order-done.js')}}
	{{Html::script('js/admin/delete-order.js')}}
	@include('admin.dashboard.graph-script')
@stop



