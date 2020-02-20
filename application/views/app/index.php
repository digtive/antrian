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
		<link rel="stylesheet" href="<?= base_url('assets/css/animate.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/js/node_modules/bxslider/jquery.bxslider.css')?>">
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
		<link rel="stylesheet" href="<?= base_url('assets/css/layanan.css?v=1.0.0&&load='.time().'')?>">
		<!-- endinject -->

		<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>

		<style>
			::-webkit-scrollbar {
				width: 2px;
			}

			::-webkit-scrollbar-track {
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
				border-radius: 10px;
			}

			::-webkit-scrollbar-thumb {
				border-radius: 10px;
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
			}
		</style>

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
									<img src="<?= base_url().$logo ?>" alt="" width="100%" height="100%">
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
							<?php
								if ($media['media_aktif'] ==='gambar'):
							?>

								<ul class="horizontal-bxslider">
									<?php for ($i = 0; $i < count($dataGambar); $i++):?>
										<li>
											<img src="<?= base_url().$dataGambar[$i]?>" alt="" height="510px"/>
										</li>
									<?php endfor; ?>
								</ul>
<!--							<div class="slider" style="height: 100%!important;">-->
<!--								-->
<!--							</div>-->
							<?php else:?>
							<video width="100%" height="100%"
								   id="my-player"
								   class="video-js" controls
								   preload="auto" autoplay >
							</video>
							<?php endif;?>
						</div>
					</div>

					<!-- service list -->
					<div class="col-4" style="height: 536px;overflow: hidden">
						<div id="queue-box-wrapper" class="grid-margin">
							<div class="card card-shadow grid-margin" style='clip-path: polygon(90% 0%, 100% 50%, 90% 100%, 0% 100%, 5% 50%, 0% 0%);
							background-color: white;'>
								<div style='background-image: url("<?= base_url()?>assets/images/background/batik.png");background-size: cover'>
									<div class="card-body p-2">
										<h3 style="font-family: titilliumweb-bold;color: #4a8dc5" class="text-center m-0">Daftar Layanan</h3>
									</div>
								</div>
							</div>

							<div class="card card-shadow grid-margin bg-white card-service" style="background-image: url('<?= base_url()?>assets/images/background/servicecard-bg.png')" id="active-service">
								<div class="card-body p-2">
									<div class="row" style="height: 90px;max-height: 90px">
										<div class="col-7 ">
											<h3 style="color: #1d70b7;font-family: titilliumweb-bold" class="ml-1">Nama Layanan</h3>
										</div>
										<div class="col-5">
											<h1 style="font-size: 45px;color: white;font-family: titilliumweb-bold" class="mt-3 ml-3 animated infinite flash active-queue-number">A-004</h1>
										</div>
									</div>
									<div class="row" style="padding: 4px 8px;height: auto">
										<div class="col-12 d-flex justify-content-end">
											<span class="badge badge-light text-dark service-info active" style="font-family: titilliumweb-bold">
												<h5 class="m-0" id="service-info">Menuju Loket : loket 1</h5>
											</span>
										</div>
									</div>
								</div>
							</div>

							<?php foreach ($dataLoket as $key => $v):?>
								<div class="card card-shadow grid-margin bg-white card-service" style="background-image: url('<?= base_url()?>assets/images/background/servicecard-bg.png')" id="loket-1">
									<div class="card-body p-2">
										<div class="row" style="height: 90px;max-height: 90px">
											<div class="col-7 ">
												<h3 style="color: #1d70b7;font-family: titilliumweb-bold" class="ml-1"><?= $v['layanan_nama']?></h3>
											</div>
											<div class="col-5">
												<h1 style="font-size: 45px;color: white;font-family: titilliumweb-bold" class="mt-3 ml-3 ">A-004</h1>
											</div>
										</div>
										<div class="row" style="padding: 4px 8px;height: auto">
											<div class="col-12 d-flex justify-content-end">
											<span class="badge badge-light text-dark service-info active" style="font-family: titilliumweb-bold">
												<h5 class="m-0" id="service-info">Menuju Loket : <?= $v['loket_id'] ?></h5>
											</span>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach;?>
						</div>
					</div>
					<!-- service list -->
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
		<!-- generate component from js fro active qeueu component -->
<!--		<script src="--><?//= base_url('assets/js/audio/ServiceComponent.js?v=1.0.0&&load='.time()) ?><!--"></script>-->
		<script src="<?= base_url('assets/js/audio/player.js?v=1.0.0&&load='.time()) ?>"></script>
		<!-- end inject for playing audio-->

		<!-- swap queue component-->
		<script src="<?= base_url('assets/js/components/swapsies.js?v=1.0.0&&load='.time())?>"></script>
		<script src="<?= base_url('assets/js/components/componentSwap.js?v=1.0.0&&load='.time())?>"></script>
		<!-- swap queue component-->

		<!-- JS inject for media -->
		<script src="<?= base_url('assets/js/node_modules/bare-bones-slider/js/jquery.bbslider.js')?>"></script>
		<script src="<?= base_url('assets/js/node_modules/video.js/dist/video.min.js')?>"></script>
		<script src="<?= base_url('assets/js/node_modules/videojs-playlist/dist/videojs-playlist.min.js')?>"></script>

		<?php
			if ($media['media_aktif'] === 'gambar'):
		?>
		<script src="<?= base_url('assets/js/media/Slider.js')?>"></script>
		<?php else:?>
		<script src="<?= base_url('assets/js/media/VideoPlayer.js?v=1.0.0&load='.time())?>"></script>
		<?php endif;?>
		<script type="text/javascript" src="<?= base_url('assets/js/node_modules/bxslider/vendor/jquery.easing.1.3.js')?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/js/node_modules/bxslider/vendor/jquery.fitvids.js')?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/js/node_modules/bxslider/jquery.bxslider.js')?>"></script>
		<!-- JS inject for media -->

		<!-- component script-->
		<script type="text/javascript" src="<?= base_url('assets/js/components/componentRefresher.js?v=1.0.0&&load='.time().'')?>"></script>
		<script type="text/javascript" src="<?= base_url('assets/js/audio/MainKeyboard.js?v=1.0.0&&load='.time().'')?>"></script>

	<script>
			$(document).ready(function () {
			    $('.service-info.active').fadeIn('slow');
				let durasi = <?= (int)$durasi?>;
				const getUrl = window.location;
                let baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+'/';
				$(document).keypress(function (key) {
					let btnSetting = key.originalEvent.key;
					if (btnSetting === 's'){
					    window.location.href = baseUrl+'settings/parent';
					}else if (btnSetting === 'l'){
					    window.location.href = baseUrl+'layanan';
					}
                });

                $('.bxslider').bxSlider({
                    auto: true,
					mode: 'vertical',
					controls : false,
					pager : false,
					speed: 1000,
					pause: 3000
                });

                $('.horizontal-bxslider').bxSlider({
                    auto: true,
                    mode: 'horizontal',
                    controls : false,
					speed: 2000,
					pause: 5000
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
