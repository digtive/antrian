$(document).ready(function(){
	let baseUrl = window.location.origin+'/antrian/'; // development
	// let baseUrl = window.location.origin; // production

	// cek uri
	const allowedUri  = 'http://localhost/antrian/settings/header';
	let uri = window.location.href;

	// selector
	let headerComponentForm = $('#headerComponentData');
	let submitBtn = $('#headerSubmitBtn');


	//events
	submitBtn.click(function () {
		let headerComponentData = headerComponentForm.serializeArray();
		console.log(headerComponentData);
	});


	// functions


});
