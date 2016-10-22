@section('modal-change-procurement')
	<div class="change_category_items_modal modal fade" tabindex="-1" role="dialog" id="changeProcurement">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="mdl-card__menu">
						<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
							<i class="material-icons">close</i>
						</button>
					</div>
					<h4 class="mdl-card__title-text">Редактирование наличия</h4>
				</div>
				<div class="modal-body">
					<div class="change_block admin_select_category_div">
						{{ Form::label('procurement', 'Наличие', ['class'=>'admin_uni_label admin_select_category_label']) }}
						{{ Form::select('procurement', createOptions($procurements, 'id', 'supply_title'), null, ['class'=>'form-control admin_select_category_select admin_select_procurement', 'required', 'form' => 'none', 'data-no_results_text' => 'Нет результатов по запросу', 'data-url'=>route('set_procurement')]) }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Закрыть</button>
					<a class="change_item_procurement mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored aadb admin_uni_button ">Сохранить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
		jQuery(function($){ $('.admin_select_procurement').chosen(); });
	</script>
@stop