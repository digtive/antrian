<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title> Project Antrian </title>

		<!-- plugins:css -->
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/mdi/css/materialdesignicons.min.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')?>">
		<!-- endinject -->

		<!-- plugin css for this page -->
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css')?>"/>
		<link rel="stylesheet" href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css')?>">
		<!-- End plugin css for this page -->

		<!-- inject:css -->
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/app.css')?>">
		<!-- endinject -->

		<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

	</head>

	<body>
	<!-- start container-->
	<div class="container-scroller">
		<div class="app-container">
			<!-- ---- HEADER SECTION ---- -->
			<div id="header-card">
				<div class="row">
					<div class="col-8">
						<!-- ---- TAG LINE AND BRAND SECTION -->
						<div id="tagline-head">
							<div class="tagline-wrapper">
								<div class="parallelogram">
								</div>
								<div class="brand-wrapper">
									<img src="<?= base_url('assets/images/logo-dintanak.png') ?>" alt="" width="100%" height="100%">
								</div>
							</div>
						</div>
						<!-- ---- END BRAND AND TAG LINE SECTION -->

					</div>
					<div class="col-4">
						<div class="d-flex justify-content-end">
							<div>
								<h2 class="text-white countdown-time" ></h2>
								<h3 class="date-indicator" id="date-indicator">26/10/2018</h3>
							</div>
							<div>
								<h1 class="time-indicator text-white" id="time-indicator">12:40</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ---- END HEADER SECTION ---- -->


			<!-- ---- CONTENT SECTION ---- -->
			<div id="content-card">
				<div class="row">
					<div class="col-4">
						<div class="row-queue">
							<video width="100%" height="auto" controls >
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
							</video>
						</div>
					</div>
                    <div class="col-4">
                        <div class="row-queue">
                            <video width="100%" height="auto" controls >
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
                            </video>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row-queue">
                            <video width="100%" height="auto" controls >
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
                            </video>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row-queue">
                            <video width="100%" height="auto" controls >
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
                                <source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
                            </video>
                        </div>
                    </div>
<!--					<div class="col-4">-->
<!--						<div class="queue-box">-->
<!--							<div class="queue-name">-->
<!---->
<!--							</div>-->
<!--							<div class="queue-number">-->
<!---->
<!--							</div>-->
<!--							<div class="queue-footer">-->
<!---->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
			</div>
			<!-- ---- END CONTENT SECTION ---- -->

			<!-- ---- FOOTER SECTION ---- -->
			<div id="footer-card">
				<marquee behavior="scroll" direction="left" id="running-text">Selamat Datang Di Dinas Pertanian dan Peternakan</marquee>
			</div>
			<!-- ---- END FOOTER SECTION ---- -->

		</div>
	</div>
	<!-- container-scroller -->

		<!-- plugins:js -->
		<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js')?>"></script>
		<script src="<?= base_url('assets/node_modules/moment/moment.js')?>"></script>
		<script src="<?= base_url('assets/node_modules/moment/moment-with-locales.js')?>"></script>
		<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')?>"></script>
		<!-- endinject -->

		<!-- Plugin js for this page-->
		<script src="<?= base_url('assets/') ?>node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
		<script src="<?= base_url('assets/') ?>node_modules/chart.js/dist/Chart.min.js"></script>
		<script src="<?= base_url('assets/') ?>node_modules/raphael/raphael.min.js"></script>
		<script src="<?= base_url('assets/') ?>node_modules/morris.js/morris.min.js"></script>
		<script src="<?= base_url('assets/') ?>node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
		<!-- End plugin js for this page-->

		<!-- inject:js -->
		<script src="<?= base_url('assets/') ?>js/off-canvas.js"></script>
		<script src="<?= base_url('assets/') ?>js/hoverable-collapse.js"></script>
		<script src="<?= base_url('assets/') ?>js/misc.js"></script>
		<script src="<?= base_url('assets/') ?>js/settings.js"></script>
		<script src="<?= base_url('assets/') ?>js/todolist.js"></script>
		<!-- endinject -->

		<!-- Custom js for this page-->
	<script src="<?= base_url('assets/js/plugins/countdown.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/moment.js') ?>"></script>
	<script src="<?= base_url('assets/') ?>js/dashboard.js"></script>
	<script src="<?= base_url('assets/js/app/waktu.js') ?>"></script>
		<script src="<?= base_url('assets/js/package/timer.js') ?>"></script>
		<!-- End custom js for this page-->

		<script>
			$(document).ready(function () {

			    let baseUrl = window.location.origin+'/antrian/';
				$(document).keypress(function (key) {
					let btnSetting = key.originalEvent.key;
					if (btnSetting === 's'){
					    window.location.href = baseUrl+'settings';
					}
                })
            })
		</script>

	</body>

</html>
