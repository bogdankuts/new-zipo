@section('modal-add-to-pdf')
	<div class="change_category_items_modal modal fade" tabindex="-1" role="dialog" id="addToPdf">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="mdl-card__menu">
						<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
							<i class="material-icons">close</i>
						</button>
					</div>
					<h4 class="mdl-card__title-text">Редактирование/добавление деталировки</h4>
				</div>
				<div class="modal-body">
					<div class="change_block admin_select_category_div">
						{{ Form::label('pdf', 'PDF', ['class'=>'admin_uni_label admin_select_category_label']) }}
						{{ Form::select('pdf', createOptions($pdfs, 'pdf_id', 'good'), null, ['class'=>'form-control admin_select_category_select admin_select_pdf', 'required', 'form' => 'none', 'data-no_results_text' => 'Нет результатов по запросу']) }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Закрыть</button>
					<a class="change_item_pdf mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored aadb admin_uni_button" data-url="{{route('change_pdf')}}">Сохранить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
		jQuery(function($){ $('.admin_select_pdf').chosen(); });
	</script>
@stop