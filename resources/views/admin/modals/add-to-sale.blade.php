@section('modal-add-to-sale')
	<div class="change_category_items_modal modal fade" tabindex="-1" role="dialog" id="addToSale">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="mdl-card__menu">
						<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
							<i class="material-icons">close</i>
						</button>
					</div>
					<h4 class="mdl-card__title-text">Добавление в расрподажу</h4>
				</div>
				<div class="modal-body">
					<div class="change_block admin_select_category_div">
						{{ Form::label('sale', 'Распродажа', ['class'=>'admin_uni_label admin_select_category_label']) }}
						{{ Form::select('sale', createOptions($sales, 'id', 'title'), null, ['class'=>'form-control admin_select_category_select admin_select_sale', 'required', 'form' => 'none']) }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Закрыть</button>
					<a class="add_to_sale mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored aadb admin_uni_button" data-url="{{route('add_to_sale')}}">Сохранить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop