@section('modal-edit-subcategory')
	@foreach($categories as $category=>$title)
		@foreach($subcats[$category] as $subcat)
			<div class="modal fade add_subcategory_modal" id="{{$subcat->subcat_id}}_edit_modal" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="mdl-card__menu">
								<button type="button" class="close mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" data-dismiss="modal" aria-label="Close">
									<i class="material-icons">close</i>
								</button>
							</div>
							<h4 class="mdl-card__title-text">Изменить подкатегорию</h4>
						</div>
						{{ Form::open(['url'=>"admin/update-subcategory?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'']) }}
						<div class="modal-body">
							<div class="change_block admin_select_category_div">
								{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label']) }}
								{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control create_category', 'required']) }}
							</div>
							<div class="change_block admin_select_title_div">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									{{ Form::label('subcat', 'Название', ['class'=>'mdl-textfield__label']) }}
									{{ Form::text('subcat', $subcat->subcat, ['class'=>'mdl-textfield__input', 'required', 'id' => 'subcat', 'maxlength'=>'128']) }}
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Закрыть</button>
							{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		@endforeach
	@endforeach

@stop