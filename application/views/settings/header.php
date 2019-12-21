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
	<!-- endinject -->

	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/font-awesome/css/font-awesome.min.css') ?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css') ?>">

	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-1to10.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-horizontal.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-movie.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-pill.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-reversed.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bars-square.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/bootstrap-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/css-stars.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars-o.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-bar-rating/examples/css/examples.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/dropify/dist/css/dropify.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-file-upload/css/uploadfile.css">
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/jquery-asColorPicker/dist/css/asColorPicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>/assets/node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css">

	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
	<!-- endinject -->

	<link rel="shortcut icon" href="<?= base_url('assets/images/icon-antrian.png') ?>"/>


</head>

<body>
<!-- start container-->
<div class="container-scroller" style="padding-top: 40px">
	<div class="container-fluid" style="padding: 20px 80px!important;box-sizing: border-box ">

		<div class="row">
<!--			<div class="col-12">-->
<!--				<div class="alert alert-success setting-alert" role="alert">-->
<!--					A simple success alert—check it out!-->
<!--				</div>-->
<!--			</div>-->

			<div class="col-3">

				<div class="side-nav">

					<div class="nav-header">
						<div class="row">
							<div class="col-3">
								<h1>
									<i class="icon-settings"></i>
								</h1>
							</div>
							<div class="col-9">
								<h2 class="font-weight-medium">
									Pengaturan
								</h2>
							</div>
						</div>
					</div>

					<div class="nav-body">
						<ul>
							<?php
								$active = 'active-menu';
								$warna = '';
								$teks  = '';
								$suara  = '';
								$umum = '';
								$media = '';
								$cetakan = '';
								$loket = '';
								$header = '';

								switch ($activeMenu){
									case 'umum':
										$umum = $active; break;
									case 'warna':
										$warna = $active; break;
									case 'teks':
										$teks = $active; break;
									case 'suara':
										$suara = $active; break;
									case 'media':
										$media = $active; break;
									case 'cetakan':
										$cetakan = $active; break;
									case 'loket':
										$loket = $active;break;
									case 'header':
										$header = $active;break;
								}

							?>
							<li>
								<a href="<?= base_url('settings')?>" class="<?php echo $umum;?>">
									<i class="icon-wrench "></i>
									Umum
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/loket')?>" class="<?php echo $loket;?>">
									<i class="icon-layers "></i>
									Loket
								</a>
							</li>
<!--							<li>-->
<!--								<a href="--><?//= base_url('settings/colours') ?><!--" class="--><?php //echo $warna;?><!--">-->
<!--									<i class="icon-drop "></i>-->
<!--									Warna-->
<!--								</a>-->
<!--							</li>-->
							<li>
								<a href="<?= base_url('settings/header')?>" class="<?php echo $header;?>">
									<i class="icon-credit-card "></i>
									Header
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/media') ?>" class="<?= $media; ?>">
									<i class="icon-picture"></i>
									Media
								</a>
							</li>
							<li>
								<a href="<?= base_url('settings/print') ?>" class="<?= $cetakan; ?>">
									<i class="icon-printer"></i>
									Cetakan
								</a>
							</li>

						</ul>
					</div>

				</div>

			</div>

			<div class="col-9">

