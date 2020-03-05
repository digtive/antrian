$(document).ready(function(){
	let connection = new Connection();
	let services = new Services();



	$('.take-queue').click(function (e) {
		e.preventDefault();
		let url = $(this).data('url');
		let response = services.getData('Services/'+url);
		if (response.status === '200'){
			$('#ticket-number-print').html(response.antrian_nomor);
			$('#service-name-print').html(response.service_name);
			$('#left-queue-print').html(response.left_queue);
			swal({
				title: 'BERHASIL MENGAMBIL ANTRIAN',
				html: '<h4>Nomor Antrian Anda </h4><br>' +
					'<h1>'+response.antrian_nomor+'</h1><br>' +
					'<h5>Silahkan Cetak Karcis dan Menunggu</h5>'
				,
				type: 'success',
				allowOutsideClick: false,
				showCloseButton: false,
				showCancelButton: false,
				confirmButtonText:
					'<button class="btn btn-success" id="cetak-karcis" data-antrian="'+response.antrian_nomor+'"><i class="fa fa-print"></i> cetak</button>',
			});
		}
	});

	$(document).on('click','#cetak-karcis', function () {
		// $('#ticket-preview').printThis({
		// 	debug: false,               // show the iframe for debugging
		// 	importCSS: true,            // import parent page css
		// });
		window.location.reload();
	})
});
