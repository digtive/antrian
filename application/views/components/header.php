
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3>Preview</h3>
		<div class="row mb-3" id="bg-header-simulator" style="background-color: #0f1531;overflow: hidden" >
			<div class="col-8">
				<!-- ---- TAG LINE AND BRAND SECTION -->
				<div id="tagline-head">
					<div class="tagline-wrapper">
						<div class="parallelogram" style="background: #ffffff;" id="bg-paralelogram-simulator">
						</div>
						<div class="brand-wrapper">
							<img src="<?= base_url('assets/images/logo-dintanak.png') ?>" alt="" width="100%" height="100%">
						</div>
					</div>
				</div>
				<!-- ---- END BRAND AND TAG LINE SECTION -->
			</div>
			<div class="col-4">
				<div id="date-time-indicator" >
					<div id="date-time-wrapper" style="background-color: #007bff2e" >
						<div class="time-indicator d-flex justify-content-center">
							<h1 style="color:white;line-height: 60px;font-family: roboto-bold" class="m-0" id="time-content">
							</h1>
						</div>
						<div class="date-indicator d-flex justify-content-center">
							<h4 style="color: white;font-family: 'roboto-light', sans-serif;line-height: 44px" class="m-0" id="date-content">
								Kamis, 28 Januari 2019
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>


		<form action="#" class="row pt-4 border-top" method="post">
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12" ><h4 style="font-family: titilliumweb-bold">Warna</h4></div>
					<label for="warna-latar-header" class="col-6 col-form-label font-weight-medium">Warna Latar Header</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#0f1531" name="warna-latar-header" data-transform="#bg-header-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-latar-logo" class="col-6 col-form-label font-weight-medium">Warna Latar logo</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-latar-logo" data-transform="#bg-paralelogram-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-latar-waktu" class="col-6 col-form-label font-weight-medium">Warna Latar Waktu</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#007bff2e" name="warna-latar-waktu" data-transform="#date-time-wrapper" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-jam" class="col-6 col-form-label font-weight-medium">Warna Jam</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-jam" data-transform="#time-content" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-tanggal" class="col-6 col-form-label font-weight-medium">Warna Tanggal</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-tanggal" data-transform="#date-content" data-change="color"/>
					</div>
				</div>
			</div>

			<!-- text setting -->
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12">
						<h4>Text</h4>
					</div>
					<label for="gaya-huruf-waktu" class="col-6 col-form-label font-weight-medium">Gaya Huruf Jam</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#time-content" data-change="font-family" name="gaya-huruf-waktu">
							<option value="Roboto">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label for="gaya-huruf-tanggal" class="col-6 col-form-label font-weight-medium">Gaya Huruf Tanggal</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#date-content" data-change="font-family" name="gaya-huruf-tanggal">
							<option value="robot-bold">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<button type="submit" name="simpan" class="btn btn-primary col-12">simpan</button>
				</div>
			</div>
		</form>

	</div>
</div>
