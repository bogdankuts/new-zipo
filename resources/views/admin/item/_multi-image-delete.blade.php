<div class="delete-existing-images">
	@if(count($photos) > 0)
		@foreach($photos as $photo)
			<div class="one-photo">
				<img src="{{'/img/photos/items/'.$item->item_id.'/'.$photo->photo_title}}" data-title="{{$photo->photo_title}}">
				<p>
					<i class="fa fa-close js-delete-existing-photo" data-photo="{{$photo->photo_title}}" data-id="{{$item->item_id}}"></i>
				</p>
			</div>
		@endforeach
	@endif
</div>