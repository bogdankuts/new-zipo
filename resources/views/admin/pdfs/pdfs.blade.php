@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--producers pdfs mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach ($pdfs as $pdf)
			<div class="mdl-card mdl-shadow--2dp one_pdf" id="{{$pdf->pdf_id}}">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Деталировка № {{$pdf->pdf_id}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="line title">
						<p class="heading_full">{{$pdf->good}}</p>
					</div>
					<div class="line">
						<p class="heading">Производитель</p>
						<p class="value">{{$pdf->producer->producer}}</p>
					</div>
					<div class="line">
						<p class="heading">Категория</p>
						<p class="value">{{$pdf->category}}</p>
					</div>
					<div class="line subcat">
						<p class="heading">Подкатегория</p>
						<p class="value">{{$pdf->subcat->subcat}}</p>
					</div>
					<div class="line">
						<p class="heading">Просмотр на сайте</p>
						<a href="{{route('one_pdf', [str_slug($pdf->subcat->category)])."?pdf_id=$pdf->pdf_id&producer_id=$pdf->producer_id"}}" class="value" target="_blank">Посомтреть</a>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('change_pdf_page', [$pdf->pdf_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
				</div>
				<div class="mdl-card__menu">
					<button id="{{$pdf->pdf_id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$pdf->pdf_id}}-menu-trigger">
						<a href="{{route('change_pdf_page', [$pdf->pdf_id])}}"class="mdl-menu__item">
							Изменить
						</a>
						@if (Auth::guard('admin')->user()->master)
							<li class="mdl-menu__item delete_pdf" data-id="{{$pdf->pdf_id}}" data-url="{{route('delete_pdf', [$pdf->pdf_id])}}">
								<p>Удалить</p>
							</li>
						@endif
					</ul>
				</div>
			</div>
		@endforeach
			{{$pdfs->links()}}
		<div class="add_btn" id="add_btn">
			<a href="{{route('create_pdf')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить деталировку
		</div>
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/pdfs.js') }}
@stop