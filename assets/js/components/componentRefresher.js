$(document).ready(function(){
	let baseUrl = window.location.origin+'/antrian/'; // development
	// let baseUrl = window.location.origin; // production
	let last = getTimeEdit();


	/*
	* refresher function
	* detect if any change in DB
	* */
	setInterval(function () {
		if (getTimeEdit() === last){
			last = getTimeEdit();
		}else{
			last =getTimeEdit();
			window.location.reload();
		}
	},2000);

	function getTimeEdit() {
		return $.ajax({
			url : baseUrl+'ComponentService/userApp',
			type : 'GET',
			async : false,
			dataType : 'JSON',
			method : 'get',
			success : function (response) {
				return response;
			},
			error : function (response) {
				console.log(response);
			}
		}).responseJSON.data.app_date_edited;
	}



});
