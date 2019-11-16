	$(document).ready(function () {
		let now = new Date;
		let waktu = now.setMinutes(now.getMinutes()+48);
		let baru = new Date(waktu);

		$('.countdown-time').countdown({
			date : baru
		});
	});
