@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list supply-change-page mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<h2 class="title">Существующие периоды поставки</h2>
		@foreach($supplies as $supply)
			<div class="one_state" id="{{$supply->id}}_state">
				{{ Form::open(['url'=>route('update_delivery', [$supply->id]), 'method'=>'POST', 'class'=>'']) }}
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					{{ Form::label('delivery_title', 'Название', ['class'=>'mdl-textfield__label']) }}
					{{ Form::text('delivery_title', $supply->supply_title, ['class'=>'mdl-textfield__input', 'required', 'id' => 'delivery_title', 'maxlength'=>'128']) }}
				</div>
				<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect save_delivery" data-target="{{$supply->id}}">
					<i class="material-icons">save</i>
				</a>
				{{ Form::close() }}
				{{Form::open(['url'=>route('delete_delivery', [$supply->id]), 'method'=>'POST', 'class'=>''])}}
				@if($supply->id !='1' && $supply->id !='5' && Auth::guard('admin')->user()->master)
					<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect delete_delivery" data-target="{{$supply->id}}">
						<i class="material-icons">close</i>
					</a>
				@endif
				{{Form::close()}}
			</div>
		@endforeach
		<h2 class="title">Новый период поставки</h2>
		<div class="new_state">
			{{ Form::open(['url'=>route('add_delivery'), 'method'=>'POST', 'class'=>'']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('delivery_title', 'Название', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('delivery_title', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'delivery_title', 'maxlength'=>'128']) }}
			</div>
			<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect create_delivery">
				<i class="material-icons">save</i>
			</a>
			{{ Form::close() }}
		</div>
	</div>

@stop
@section('page-js')
	{{ Html::script('js/admin/delivery.js') }}
@stop