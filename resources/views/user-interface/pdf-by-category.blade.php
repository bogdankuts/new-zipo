@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
{{--	<title>Деталировки {{$producer->producer}}</title>--}}
	{{--<meta name='keywords' content='Деталировки {{$producer->producer}} - Зип Общепит'>--}}
	{{--<meta name='description' content='Деталировки {{$producer->producer}} - Зип Общепит'>--}}
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
			<li class="active">{{reverseSlug($category)}}</li>
		</ol>
		<h4 class="universal_heading">Деталировки категории {{reverseSlug($category)}}</h4>
		<hr class="main_hr">
		<div class="pdf_list">
			<ul>
				@foreach ($pdfs as $pdf)
					<li>
						<a href="{{route('one_pdf', [$category])."?pdf_id=$pdf->pdf_id&producer_id=$pdf->producer_id"}}">
							{{$pdf->good}}
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@stop