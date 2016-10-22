//CKEDITOR EMBED
if ($('#ckeditor').length) {
	CKEDITOR.replace('ckeditor', {
		filebrowserBrowseUrl 	   : '/kcfinder/browse.php?opener=ckeditor&type=files',
		filebrowserImageBrowseUrl  : '/kcfinder/browse.php?opener=ckeditor&type=images',
		filebrowserFlashBrowseUrl  : '/kcfinder/browse.php?opener=ckeditor&type=flash',
		filebrowserUploadUrl  	   : '/kcfinder/upload.php?opener=ckeditor&type=files',
		filebrowserImageUploadUrl  : '/kcfinder/upload.php?opener=ckeditor&type=images',
		filebrowserFlashUploadUrl  : '/kcfinder/upload.php?opener=ckeditor&type=flash',
	});
}