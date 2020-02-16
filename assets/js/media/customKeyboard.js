$(document).ready(function(){
	$(document).on('keydown','.bt-max-length', function (e) {
		e.preventDefault();
		let key = e.key;
		$(this).val(key);

	});


});
