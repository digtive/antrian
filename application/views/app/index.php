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
		<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/bare-bones-slider/css/jquery.bbslider.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/video.js/dist/video-js.css')?>">
		<!-- End plugin css for this page -->

		<!-- inject:css -->
		<link rel="stylesheet" href="<?= base_url('assets/css/fonts.css?v=1.0.0&&load='.time().'') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.0&&load='.time().'')?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=1.0.0&&load='.time().'')?>">
		<!-- endinject -->

		<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

	</head>

	<body id="root">
	<!-- start container-->
	<div class="container-scroller">
		<?php
			if ($container['background-image'] === 'true'):
		?>
		<div id="app-container"
			 style='background: url("<?=$container['background-image-src']?>");
				 background-repeat: no-repeat;
				 background-size: cover;
				 background-position: center;'>
		<?php else:?>

		<div id="app-container" style="background-color: <?= $container['background-color']?>;">

		<?php endif?>
			<!-- ---- HEADER SECTION ---- -->
			<div id="header-card" style="background-color: <?= $header['background-header']?>;">
				<div class="row">
					<div class="col-9">
						<!-- ---- TAG LINE AND BRAND SECTION -->
						<div id="tagline-head">
							<div class="tagline-wrapper">
								<div class="parallelogram" style="background: <?= $header['background-paralelogram']?>;">
								</div>
								<div class="brand-wrapper" style='background-image: url("<?= base_url('assets/images/doodle/diamond.png')?>");background-repeat: no-repeat;background-position: right;background-size: inherit;'>
									<img src="<?= $logo ?>" alt="" width="100%" height="100%">
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
					<div class="col-8">
						<div id="content-wrapper">
<!--							<div class="slider" style="height: 100%!important;">-->
<!--								--><?php //for ($i = 0; $i < count($dataGambar); $i++):?>
<!--								<div>-->
<!--									<img src="--><?//= $dataGambar[$i]?><!--" alt=""/>-->
<!--								</div>-->
<!--								--><?php //endfor; ?>
<!--							</div>-->
							<video width="100%" height="100%" controls
								   id="my-player"
								   class="video-js"
								   controls
								   preload="auto"
								   poster="//vjs.zencdn.net/v/oceans.png"
								   data-setup='{}'>
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/mp4">
								<source src="<?= base_url('assets/videos/videoplayback.mp4')?>" type="video/ogg">
								<p class="vjs-no-js">
									To view this video please enable JavaScript, and consider upgrading to a
									web browser that
									<a href="https://videojs.com/html5-video-support/" target="_blank">
										supports HTML5 video
									</a>
								</p>
							</video>
						</div>
					</div>
					<div class="col-4" style="height: 530px;overflow: hidden">
						<div id="queue-active-header" class="hexagon-shape d-flex justify-content-start">
							<h3>SEDANG DI PANGGIL</h3>
						</div>
						<div id="queue-box-wrapper">
							<?php foreach ($dataLoket as $k => $v):?>
							<div class="queue-box" style="background-color: <?= $loket['background-queue-box']; ?>;" id="loket-<?= $v['loket_id']?>">
								<div class="queue-name">
									<h2 class="font-weight-light" style="color: <?= $loket['color-queue-name']; ?>;font-size: 25px;font-family: <?= $loket['font-family-name']; ?>">
										<?= $v['layanan_nama']?> <br>
									</h2>
								</div>
								<div class="queue-number d-flex justify-content-end" style="background-color: <?= $loket['background-queue-number'];?>;">
									<h1 class="queue-number-content" style="font-family: <?= $loket['font-family-number'];?> ;font-weight: bolder;color: <?= $loket['color-number'];?>">A008</h1>
								</div>
								<div class="queue-footer d-flex justify-content-between" style="border-top: 4px <?= $loket['border-top-footer-color'];?> solid;background-color: <?= $loket['background-queue-footer'];?>">
									<span style="color: <?= $loket['color-footer'];?>;font-family: <?= $loket['font-family-footer'];?>">Menuju Loket : <?= $v['loket_nama']?></span>
									<span style="color: <?= $loket['color-left-queue'];?>;font-family: <?= $loket['font-family-left-queue'];?>">Sisa Antrian : 4</span>
								</div>
							</div>
							<?php endforeach; ?>

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
		<!--connection class-->
		<script src="<?= base_url('assets/js/audio/Connection.js?v=1.0.0&&load='.time()) ?>"></script>
		<!-- connection class -->
		<script src="<?= base_url('assets/node_modules/moment/moment.js')?>"></script>
<!--		<script src="--><?//= base_url('assets/node_modules/moment/moment-with-locales.js')?><!--"></script>-->
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
		<script src="<?= base_url('assets/') ?>js/dashboard.js?v=1.0.0&&load="<?= time()?>></script>
		<script src="<?= base_url('assets/js/app/waktu.js?v=1.0.0&&load='.time().'') ?>"></script>
		<script src="<?= base_url('assets/js/package/timer.js?v=1.0.0&&load='.time().'') ?>"></script>
		<!-- End custom js for this page-->

		<!-- howler js untuk suara -->
		<script src="<?= base_url('assets/node_modules/howler/dist/howler.js?v=1.0.0&&load='.time()) ?>"></script>
<!--		<script src="--><?//= base_url('assets/node_modules/howler/dist/howler.core.min.js?v=1.0.0&&load='.time()) ?><!--"></script>-->
<!--		<script src="--><?//= base_url('assets/node_modules/howler/dist/howler.spatial.min.js?v=1.0.0&&load='.time()) ?><!--"></script>-->
		<!-- howler js untuk suara -->

		<!-- swap queue component-->
		<script src="<?= base_url('assets/js/components/swapsies.js?v=1.0.0&&load='.time())?>"></script>
		<script src="<?= base_url('assets/js/components/componentSwap.js?v=1.0.0&&load='.time())?>"></script>
		<!-- swap queue component-->


		<!-- JS inject for playing audio  -->
		<script src="<?= base_url('assets/js/audio/Services.js?v=1.0.0&&load='.time()) ?>"></script>
		<script src="<?= base_url('assets/js/audio/AudioHelper.js?v=1.0.0&&load='.time()) ?>"></script>
		<script src="<?= base_url('assets/js/audio/MainAntrian.js?v=1.0.0&&load='.time()) ?>"></script>
		<script src="<?= base_url('assets/js/audio/player.js?v=1.0.0&&load='.time()) ?>"></script>
		<!-- end inject -->

		<!-- swap queue component-->
		<script src="<?= base_url('assets/js/components/swapsies.js?v=1.0.0&&load='.time())?>"></script>
		<script src="<?= base_url('assets/js/components/componentSwap.js?v=1.0.0&&load='.time())?>"></script>
		<!-- swap queue component-->

		<!-- JS inject for media -->
		<script src="<?= base_url('assets/js/node_modules/bare-bones-slider/js/jquery.bbslider.js')?>"></script>
		<script src="<?= base_url('assets/js/media/Slider.js')?>"></script>
		<script src="<?= base_url('assets/js/node_modules/video.js/dist/video.min.js')?>"></script>
		<script src="<?= base_url('assets/js/node_modules/videojs-playlist/dist/videojs-playlist.min.js')?>"></script>
		<script src="<?= base_url('assets/js/media/VideoPlayer.js?v=1.0.0&load='.time())?>"></script>
		<!-- JS inject for media -->

		<!-- component script-->
		<script type="text/javascript" src="<?= base_url('assets/js/components/componentRefresher.js?v=1.0.0&&load='.time().'')?>"></script>

	<script>
			$(document).ready(function () {
				let durasi = <?= (int)$durasi?>;
			    let baseUrl = window.location.origin+'/antrian/';
				$(document).keypress(function (key) {
					let btnSetting = key.originalEvent.key;
					if (btnSetting === 's'){
					    window.location.href = baseUrl+'settings/parent';
					}
                });

                $('.slider').bbslider({
                    auto:  true,
                    timer: (durasi*1000),
                    loop:  true
                });
            })
		</script>

	</body>

</html>
