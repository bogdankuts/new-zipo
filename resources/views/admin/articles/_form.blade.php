<div class="change_article_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('title', 'Заголовок: ', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('title', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'title']) }}
	</div>
</div>
<div class="change_article_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('meta_title', 'Meta-title: ', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('meta_title', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'meta_title']) }}
		<div class="mdl-tooltip" for="meta_title">
			Параметр, для SEO, должен <br>должен коротко и ясно отражать суть страницы<br> Максимум 70 символов
		</div>
	</div>
</div>
<div class="change_article_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('meta_description', 'Meta-description: ', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('meta_description', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'meta_description']) }}
		<div class="mdl-tooltip" for="meta_description">
			Параметр, для SEO, должен <br> должен описывать содержание конкретной страницы<br> Максимум 200 символов
		</div>
	</div>
</div>
<div class="change_article_descript_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::textarea('body', null, array('class' => 'name mdl-textfield__input', 'id' => 'ckeditor')) }}
	</div>
</div>
<div class="change_article_weight_div">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('weight', 'Вес новости: ', ['class'=>'mdl-textfield__label']) }}
		{{ Form::number('weight', null, ['class'=>'mdl-textfield__input', 'required', 'id'=>'title']) }}
	</div>
</div>
<p class="admin_uni_label admin_uni_label--subheading">Добавить миниатюру для статьи</p>

<div class="change_article_img">
	<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="{{route('ajax_image_article')}}" multiple form='none'>
	<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать миниатюру</a>
</div>

<div class="img_preview">
	@if (isset($article->photo) && $article->photo != 'no_photo.png')
		<img src="/img/photos/articles/{{$article->photo}}" class='items_item_img' data-filepath='{{ public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.$article->photo }}'>
		<i class="material-icons delete_img_icon_ajax">close</i>
		{{ Form::hidden('old', $article->photo) }}
		{{ Form::hidden('photo', $article->photo, ['class' => 'inserted_input']) }}
	@else
		{{ Form::hidden('old', 'no_photo.png') }}
		{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
		<img src="/img/photos/articles/no_photo.png" class='items_item_img' >
	@endif
</div>

<a href="{{route('articles_admin')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent back"><i class="fa fa-list-alt"></i>&nbsp К списку новостей</a>

{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent save']) }}
<div class="change_item_buttons">
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent article_clean">Очистить</a>
</div>