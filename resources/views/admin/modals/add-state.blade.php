@section('modal-add-state')
	<div class="modal fade add_state_modal" id="addState" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="mdl-card__menu">
						<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
							<i class="material-icons">close</i>
						</button>
					</div>
					<h4 class="mdl-card__title-text">Добавить статус заказа</h4>
				</div>
				<div class="modal-body">
					<p class="title">Существующие статусы</p>
					@foreach($states as $state)
						<div class="one_state" id="{{$state->state_id}}_state">
							{{ Form::open(['url'=>"", 'method'=>'POST', 'class'=>'']) }}
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								{{ Form::label('state_title', 'Название', ['class'=>'mdl-textfield__label']) }}
								{{ Form::text('state_title', $state->state_title, ['class'=>'mdl-textfield__input', 'required', 'id' => 'state_title', 'maxlength'=>'128']) }}
							</div>
							<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect save_state" data-target="{{$state->state_id}}">
								<i class="material-icons">save</i>
							</a>
							{{ Form::close() }}
							@if($state->state_id !='1' && $state->state_id !='3' && \Auth::guard('admin')->user()->master)
								<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect delete_state" data-target="{{$state->state_id}}">
									<i class="material-icons">close</i>
								</a>
							@endif
						</div>
					@endforeach
					<p class="title">Новый статус</p>
					<div class="new_state">
						{{ Form::open(['url'=>"/admin/create_state", 'method'=>'POST', 'class'=>'']) }}
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							{{ Form::label('state_title', 'Название', ['class'=>'mdl-textfield__label']) }}
							{{ Form::text('state_title', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'state_title', 'maxlength'=>'128']) }}
						</div>
						<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect create_state">
							<i class="material-icons">save</i>
						</a>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop