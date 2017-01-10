<script>
	Dropzone.options.multiImages = {
		paramName: "photo", // The name that will be used to transfer the file
		maxFilesize: 2, // MB
		parallelUploads: 10,
		acceptedFiles: 'image/*',
		uploadMultiple: true,
		dictDefaultMessage: "Кликните или перетащите что бы добавить картинки!",
		dictInvalidFileType: "Вы не можете загрузить файл, не являющийся изображением!",
		dictFileTooBig: "Файл слишком большой и превышает 2Мб",
		addRemoveLinks: true,
		dictCancelUpload: 'Отменить',
		dictRemoveFile: "Удалить",
		renameFilename: function (filename) {
			return transliterate(filename);
		},
		removedfile: function(file) {
			$.post('/admin/item/multi-images-delete/'+transliterate(file.name));
			$(document).find(file.previewElement).remove();
		}
	};

	var a = {"Ё":"YO","Й":"I","Ц":"TS","У":"U","К":"K","Е":"E","Н":"N","Г":"G","Ш":"SH","Щ":"SCH","З":"Z","Х":"H","Ъ":"'","ё":"yo","й":"i","ц":"ts","у":"u","к":"k","е":"e","н":"n","г":"g","ш":"sh","щ":"sch","з":"z","х":"h","ъ":"'","Ф":"F","Ы":"I","В":"V","А":"a","П":"P","Р":"R","О":"O","Л":"L","Д":"D","Ж":"ZH","Э":"E","ф":"f","ы":"i","в":"v","а":"a","п":"p","р":"r","о":"o","л":"l","д":"d","ж":"zh","э":"e","Я":"Ya","Ч":"CH","С":"S","М":"M","И":"I","Т":"T","Ь":"'","Б":"B","Ю":"YU","я":"ya","ч":"ch","с":"s","м":"m","и":"i","т":"t","ь":"'","б":"b","ю":"yu"};

	function transliterate(word){
		return word.split('').map(function (char) {
			return a[char] || char;
		}).join("");
	}
</script>