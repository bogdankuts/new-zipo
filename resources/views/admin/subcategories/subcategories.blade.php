@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')
@extends('admin.modals.add-subcategory')
@extends('admin.modals.edit-subcategory')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content--subcategories mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($categories as $category => $title)
			<div class="admin_catalog_category" data-category='{{$category}}'>
				<h4 class="admin_one_cat_heading">{{$title}}</h4>
				<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect add_subcategory" data-category='{{$category}}' id="{{$category}}" data-toggle="modal" data-target="#{{$category}}_modal">
					<i class="material-icons">add_circle_outline</i>
				</a>
				<div class="mdl-tooltip" for="{{$category}}">
					Добавить подкатегорию
				</div>
				@if (count($subcats[$category]))
					<div class="admin_subcats_list">
						@for($i=1; $i<=3; $i++)
							<ul class="subcats_list">
								@foreach (columnize($subcats[$category], 3, $i) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect edit" data-toggle="modal" data-target="#{{$subcat->subcat_id}}_edit_modal">
											<i class="material-icons" data-category='{{ $subcat->category }}'>mode_edit</i>
										</a>
										@if (Auth::guard('admin')->user()->master)
											{{ Form::open(array('url' => route('delete_subcategory', [$subcat->subcat_id]), 'method' => 'POST', 'class'=>'admin_subcategory_form delete')) }}
											<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect delete_items_group_icon">
												<i class="material-icons">close</i>
											</button>
											{{ Form::close() }}
										@endif
									</li>
								@endforeach
							</ul>
						@endfor
					</div>
				@endif
			</div>
		@endforeach
		<div class="add_btn" id="add_btn">
			<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#Механическое_en_modal">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить подкатегорию
		</div>
	</div>
@stop
