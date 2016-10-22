@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Деталировка {{$pdf->good}} ({{$producer->producer}})</title>
	<meta name='keywords' content='Деталировка {{$pdf->good}} ({{$producer->producer}}) - Зип Общепит'>
	<meta name='description' content='Деталировка {{$pdf->good}} ({{$producer->producer}}) - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li>
				<a href="{{route('index')}}">Каталог</a>
			</li>
			<li>
				<a href="{{route('all_pdf')}}">
					Все деталировки
				</a>
			</li>
			<li>
				<a href="{{route('pdf_category', [$category])}}">
					{{reverseSlug($category)}}
				</a>
			</li>
			<li>
				<a href="{{route('pdf_prod', [$category, $producer->producer])."?producer_id=$producer->producer_id"}}">
					{{$producer->producer}}
				</a>
			</li>
			<li class="active">{{$pdf->good}}</li>
		</ol>
		<h4 class="universal_heading">Деталировка {{$pdf->good}} ({{$producer->producer}})</h4>
		<hr class="main_hr">
		<div class="pdf_content">
			<div class="pdf_reader">
				@if($file_type == 'pdf' || $file_type == 'img')
					<p>Открыть деталировку в новом окне</p>
					{{Html::link("/pdf/$pdf->file", $pdf->good, ['target'=>'_blank']) }}
				@endif
				<p class="load">Загрузить деталировку</p>
				{{Html::link("/pdf/$pdf->file", $pdf->good." | загрузка",['target'=>'_blank', 'download'=>'']) }}
			</div>
			@if(!$items->isEmpty())
				<div class="pdf_links">
					<p class="head">У нас вы можете приобрести следующие запчасти и комплектующие: </p>
					@include('user-interface.partials.items.items-sorting')
					@foreach ($items as $item)
						@include('user-interface.partials.items.one-item')
					@endforeach
				</div>
			@endif
		</div>
	</div>
@stop