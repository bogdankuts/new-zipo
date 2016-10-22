@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class = "groups admin_producers_groups">
			@for($i=1; $i<=4; $i++)
				<ul class="producers_list producers_list_admin producers_first">
					@foreach (columnize($producers, 4, $i) as $key => $producer)
						@if ($producer->producer_id != 0)
							<li>
								<div class="admin_producer_one">
									@if (Auth::guard('admin')->user()->master)
										{{ Form::open(array('url' => route('producer_delete', [$producer->producer_id]), 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
										<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect js_trigger_closet_form">
											<i class="material-icons">close</i>
										</button>
										{{ Form::close() }}
									@endif
									<a href="{{route('producer_change', [$producer->producer_id])}}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect change">
										<i class="material-icons">mode_edit</i>
									</a>
									<p>{{$producer->producer}}</p>
								</div>
							</li>
						@endif
					@endforeach
				</ul>
			@endfor
		</div> <!-- groups  -->
	</div>
	<div class="add_btn" id="add_btn">
		<a href="{{route('producer_add')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">add</i>
		</a>
	</div>
	<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
		Добавить производителя
	</div>
@stop

@section('page-js')
	{{Html::script('js/admin/trigger-delete-form.js')}}
@stop