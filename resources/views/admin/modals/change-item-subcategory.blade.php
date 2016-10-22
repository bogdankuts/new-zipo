@section('modal-change-subcategory')
	<div class="change_category_items_modal modal fade" tabindex="-1" role="dialog" id="changeSubcat">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="mdl-card__menu">
						<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
							<i class="material-icons">close</i>
						</button>
					</div>
					<h4 class="mdl-card__title-text">Редактирование категории/подкатегории</h4>
				</div>
				<div class="modal-body">
					<div class="change_block admin_select_category_div">
						<div class="label_block">
							{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
						</div>
						{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], '', ['class'=>'form-control admin_select_category_select category_input a_i_s_c_l', 'required', 'form' => 'none', 'id'=>'popupCategorySelect']) }}
					</div>
					<div class="change_block admin_select_title_div">
						<div class="label_block">
							{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label admin_select_category_label ascl']) }}
						</div>
						{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text', 'required', 'id'=>'popupSubcategoriesSelect']) }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Закрыть</button>
					<a class="change_subcat_button admin_add_button aadb mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-url="{{route('change_subcategory')}}">Сохранить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop