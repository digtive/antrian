	$(document).ready(function(){
		let con = new Connection();

		$(document).on('click','.switchBtn',function () {
			let service = $(this).data('service');
			let data = $('#callData').serializeArray();
			$.post(con.BASE_URL+'Services/switchApi/'+service,data,function (response) {
				if (response.status === '200'){
					$('#redirectModal').modal('hide');
					setTimeout(function () {
						window.location.reload();
					},500);
				}
			},'json');
		});
	});
