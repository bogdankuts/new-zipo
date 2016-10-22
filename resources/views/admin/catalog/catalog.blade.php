@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

<div class="main_content">
	@extends('user-interface.catalog')
</div>

@section('page-js')
	{{Html::script('js/user-interface/subcategories.js')}}
@stop
