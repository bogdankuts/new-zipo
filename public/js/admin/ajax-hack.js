/**
 * Created by BogdanKootz on 16.10.16.
 */
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': window.TOKEN
	}
});