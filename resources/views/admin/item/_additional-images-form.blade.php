{{ Form::open(['url'=>route('multi_image'), 'class'=>'dropzone', 'method'=>'POST',  'id'=>"multiImages", 'files' => 'true']) }}
	{{--<p data-dz-remove data-title=""></p>--}}
{{ Form::close() }}
