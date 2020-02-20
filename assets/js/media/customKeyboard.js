$(document).ready(function(){
	$('.bt-max-length').on('click',function () {
		$(this).select();
	});

	$(document).on('keydown','.bt-max-length', function (e) {
		e.preventDefault();
		let key = e.key;
		$(this).val(key);

	});


});
