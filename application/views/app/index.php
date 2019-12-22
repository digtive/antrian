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
		<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/app.css')?>">
		<!-- endinject -->

		<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

	</head>

	<body id="root">
	<!-- start container-->
	<div class="container-scroller">
		<div id="app-container" style="background-color: #0ba1b5;">
			<!-- ---- HEADER SECTION ---- -->
			<div id="header-card" style="background-color: <?= $header['background-header']?>;">
				<div class="row">
					<div class="col-9">
						<!-- ---- TAG LINE AND BRAND SECTION -->
						<div id="tagline-head">
							<div class="tagline-wrapper">
								<div class="parallelogram" style="background: <?= $header['background-paralelogram']?>;">
								</div>
								<div class="brand-wrapper">
									<img src="<?= base_url('assets/images/logo-dintanak.png') ?>" alt="" width="100%" height="100%">
								</div>
							</div>
						</div>
						<!-- ---- END BRAND AND TAG LINE SECTION -->

					</div>
					<div class="col-3">
						<div id="date-time-indicator" >
							<div id="date-time-wrapper" style="background-color: <?= $header['background-timer']?>">
								<div class="time-indicator d-flex justify-content-center">
									<h1 style="color:<?= $header['color-timer']?>;line-height: 60px;font-family: <?= $header['font-family-timer']?>;font-size: 45px" class="m-0" id="time-content">
									</h1>
								</div>
								<div class="date-indicator d-flex justify-content-center">
									<h4 style="color: <?= $header['color-date']?>;font-family: <?= $header['font-family-date']?>, sans-serif;line-height: 44px" class="m-0" id="date-content">

									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ---- END HEADER SECTION ---- -->


			<!-- ---- CONTENT SECTION ---- -->
			<div id="content-card">
				<div class="row">
					<div class="col-7">
						<div id="content-wrapper">
							<video width="100%" height="auto" controls >
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
							</video>
						</div>
					</div>
					<div class="col-5">
						<div id="queue-box-wrapper">

							<div class="queue-box" style="background-color: <?= $loket['background-queue-box']; ?>;">
								<div class="queue-name">
									<h2 class="font-weight-light" style="color: <?= $loket['color-queue-name']; ?>;font-size: 28px;font-family: <?= $loket['font-family-name']; ?>">
										Nama
									</h2>
								</div>
								<div class="queue-number d-flex justify-content-end" style="background-color: <?= $loket['background-queue-number'];?>;">
									<h1 class="queue-number-content" style="font-family: <?= $loket['font-family-number'];?> ;font-weight: bolder;color: <?= $loket['color-number'];?>">A008</h1>
								</div>
								<div class="queue-footer d-flex justify-content-between" style="border-top: 4px <?= $loket['border-top-footer-color'];?> solid;background-color: <?= $loket['background-queue-footer'];?>">
									<span style="color: <?= $loket['color-footer'];?>;font-family: <?= $loket['font-family-footer'];?>">Menuju Loket : 3</span>
									<span style="color: <?= $loket['color-left-queue'];?>;font-family: <?= $loket['font-family-left-queue'];?>">Sisa Antrian : 4</span>
								</div>
							</div>

							<div class="queue-box">
								<div class="queue-name">
									<h2 style="color: white" class="font-weight-light">Nama</h2>
									<h2 style="color: white" class="font-weight-light">Layanan 3</h2>
								</div>
								<div class="queue-number d-flex justify-content-end">
									<h1 class="queue-number-content" style="font-family: 'roboto-light';font-weight: bolder">A008</h1>
								</div>
								<div class="queue-footer d-flex justify-content-between">
									<span style="color: white;">Menuju Loket : 3</span>
									<span style="color: white">Sisa Antrian : 4</span>
								</div>
							</div>

							<div class="queue-box">
								<div class="queue-name">
									<h2 style="color: white" class="font-weight-light">Nama</h2>
									<h2 style="color: white" class="font-weight-light">Layanan 3</h2>
								</div>
								<div class="queue-number d-flex justify-content-end">
									<h1 class="queue-number-content" style="font-family: 'roboto-light';font-weight: bolder">A008</h1>
								</div>
								<div class="queue-footer d-flex justify-content-between">
									<span style="color: white;">Menuju Loket : 3</span>
									<span style="color: white">Sisa Antrian : 4</span>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- ---- END CONTENT SECTION ---- -->

			<!-- ---- FOOTER SECTION ---- -->
			<div id="footer-card" style="background-color:  <?= $footer['background-footer']?>;">
				<marquee behavior="scroll" direction="left" id="running-text" style="font-size: 22px;color: <?= $footer['color-footer']?>;font-family: <?= $footer['font-family-footer']?>"><?= $footer['footer-text']?></marquee>
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

	<!-- component script-->
	<script type="text/javascript" src="<?= base_url('assets/js/components/componentRefresher.js?v=1.0.0&&load='.time().'')?>"></script>

	<script>
			$(document).ready(function () {

			    let baseUrl = window.location.origin+'/antrian/';
				$(document).keypress(function (key) {
					let btnSetting = key.originalEvent.key;
					if (btnSetting === 's'){
					    window.location.href = baseUrl+'settings';
					}
                });

            })
		</script>

	</body>

</html>
