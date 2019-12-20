$(document).ready(function(){
	let baseUrl = window.location.origin+'/antrian/'; // development
	// let baseUrl = window.location.origin; // production

	// cek uri
	const allowedUri  = 'http://localhost/antrian/settings/header';
	let uri = window.location.href;

	// selector
	let headerComponentForm = $('#headerComponentData');
	let submitBtn = $('#headerSubmitBtn');
	let alertContainer = $('#settings-alert');


	//events
	submitBtn.click(function () {
		let headerComponentData = headerComponentForm.serializeArray();
		editHeader(headerComponentData);
	});


	// functions
	function editHeader(data) {
		$.ajax({
			url : baseUrl+'ComponentService/editHeader',
			data : data,
			type : 'POST',
			async : true,
			dataType : 'JSON',
			method : 'post',
			success : function (response) {
				if (response.status === 'success'){
					settingsAlert(true,'alert-success','berhasil menyimpan data');
					setInterval(function () {
						window.location.reload();
					},4000);
				}else {
					settingsAlert(false);
				}
			},
			error : function (response) {
				console.log(response);
			}
		})
	}

	// setting alert
	function settingsAlert(visibility,type ='',message ='') {
		if (visibility === true){
			alertContainer.fadeIn('slow');
			alertContainer.addClass(type);
			alertContainer.html(message);

			setInterval(function () {
				alertContainer.fadeOut('slow');
			},3000);
		}else{
			alertContainer.fadeOut('slow');
			alertContainer.html('');
		}
	}

});
