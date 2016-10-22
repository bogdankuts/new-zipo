@section('header')
	<header class="mdl-layout__header mdl-layout__header--scroll">
		<div class="mdl-layout__header-row">
			<span class="mdl-layout-title">{{$pageTitle}}</span>
			<!-- Add spacer, to align navigation to the right -->
			<div class="mdl-layout-spacer"></div>
			<!-- Navigation. We hide it in small screens. -->
			<nav class="mdl-navigation mdl-layout--large-screen-only">
				{{ Form::open(['url' => "/admin/search", 'method' => 'GET', 'class'=>'admin_panel_search']) }}
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
					<label class="mdl-button mdl-js-button mdl-button--icon search" for="search">
						<i class="material-icons">search</i>
					</label>
					<div class="mdl-textfield__expandable-holder">
						{{ Form::text('query', null, ['class'=>'mdl-textfield__input', 'id' =>'search']) }}
					</div>
				</div>
				{{ Form::submit('Поиск', ['class'=>'mdl-button mdl-js-button mdl-js-ripple-effect search_submit']) }}
				{{ Form::close() }}
				<p class="mdl-navigation__link">Привет, {{Auth::guard('admin')->user()->login}}</p>
				<a class="mdl-navigation__link" href="{{route('index')}}" target="_blank">
					Перейти на сайт <i class="material-icons">link</i>
				</a>
				{{Form::open(['url' => "/admin/admin_logout", 'method' => 'POST'])}}
				<a class="mdl-navigation__link logout_link">
					Выйти <i class="material-icons">exit_to_app</i>
				</a>
				{{ Form::close() }}
			</nav>
		</div>
	</header>
@stop