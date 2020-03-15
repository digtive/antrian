<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Project Antrian </title>

	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/mdi/css/materialdesignicons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/simple-line-icons/css/simple-line-icons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/flag-icon-css/css/flag-icon.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">
	<!-- endinject -->

	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css') ?>"/>
	<link rel="stylesheet"
		  href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/bare-bones-slider/css/jquery.bbslider.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/video.js/dist/video-js.css') ?>">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css?v=1.0.0&&load=' . time() . '') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.0&&load=' . time() . '') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=1.0.0&&load=' . time() . '') ?>">
	<!-- endinject -->

	<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

</head>

<body style="background-color: #f6f8fa;height: 768px;max-height: 768px;overflow: hidden">
<div class="container" style="padding-top: 80px">
	<div class="row">
		<div class="col-8">
			<div class="card  bg-dribbble " style="height: 600px;min-height: 600px">
				<div class="card-body text-center py-5" >
					<h1 style="font-size: 50px;" class="text-white">POLI GIGI UMUM</h1>
					<h1 style="font-size: 170px;font-family: titilliumweb-bold;margin-top: 80px;margin-bottom: 80px"
						class="text-white animated bounceIn">A-003
					</h1>
					<h1 style="font-size: 30px;" class="text-white">Sisa Antrian : 5</h1>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="row">
				<div class="col-12">
					<button class="btn col-12 btn-outline-secondary px-4 grid-margin"
							type="button" style="min-height: 100px;height: 100px"
							data-toggle="modal" data-target="#redirectModal" data-backdrop="static" data-keyboard="false">
						<h1><i class="icon-action-redo"></i> ALIHKAN</h1>
					</button>
					<button class="btn col-12 btn-info px-4 grid-margin" type="button" style="min-height: 130px;height: 130px">
						<h1><i class="icon-earphones-alt"></i> PG - 1</h1>
						<span style="font-family: titilliumweb-regular">Alternatif</span>
					</button>
					<button class="btn col-12 btn-success px-4 grid-margin" type="button" style="min-height: 130px;height: 130px">
						<h1><i class="icon-loop"></i> RECALL</h1>
					</button>
					<button class="btn col-12 btn-primary px-4 grid-margin" type="button" style="min-height: 180px;height: 180px">
						<h1><i class="icon-microphone"></i> CALL</h1>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="redirectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body p-4">
				<div class="row">
					<div class="col-12 mb-2">
						<h3 class="font-weight-medium">Alihkan ke Layanan</h3>
					</div>
					<div class="col-12">
						<button class="col-12 btn btn-dark text-left grid-margin" >
							<i class=" icon-screen-desktop"></i> POLI GIGI UMUM
						</button>
						<button class="col-12 btn btn-dark text-left grid-margin" >
							<i class=" icon-screen-desktop"></i> POLI GIGI UMUM
						</button>
					</div>
					<div class="col-12 my-2">
						<button class="col-12 btn btn-secondary" data-dismiss="modal">
							BATALKAN
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- plugins:js -->
<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js') ?>"></script>
<!--connection class-->
<script src="<?= base_url('assets/js/audio/Connection.js?v=1.0.0&&load=' . time()) ?>"></script>
<!-- connection class -->
<script src="<?= base_url('assets/node_modules/moment/moment.js') ?>"></script>
<!--		<script src="--><? //= base_url('assets/node_modules/moment/moment-with-locales.js')?><!--"></script>-->
<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') ?>"></script>
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
<script src="<?= base_url('assets/')?>js/dashboard.js?v=1.0.0&&load="<?= time() ?>></script>
<script src="<?= base_url('assets/js/package/timer.js?v=1.0.0&&load=' . time() . '') ?>"></script>
<!-- End custom js for this page-->


<!-- JS inject for playing audio  -->
<script src="<?= base_url('assets/js/audio/Services.js?v=1.0.0&&load=' . time()) ?>"></script>
<script src="<?= base_url('assets/js/audio/AudioHelper.js?v=1.0.0&&load=' . time()) ?>"></script>
<script src="<?= base_url('assets/js/audio/MainAntrian.js?v=1.0.0&&load=' . time()) ?>"></script>
<!-- end inject -->

</body>

</html>