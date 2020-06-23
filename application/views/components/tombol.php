
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 mb-3"><?= $settingsTitle;?></h4>


		<form action="<?= base_url('ComponentService/editTombol')?>" class=" pt-4 border-top row" method="post" id="keyboardData">
			<div class="col-4">
				<h4 style="font-family: titilliumweb-bold" class="mb-4">Umum</h4>
				<div class="form-group  row">
					<label for="background-paralelogram" class="col-4 col-form-label font-weight-medium">Setting</label>
					<div class="col-4">
						<input type="text" name="settings"  maxlength="1" class="form-control bt-max-length"  placeholder="key" style="font-size: 18px!important;text-transform: uppercase" value="<?= $keyList['settings']['key'] ?>">
						<input type="text" name="settings-url" value="<?= 'settings/parent'?>" hidden>
					</div>
				</div>

				<div class="form-group  row">
					<label for="background-paralelogram" class="col-4 col-form-label font-weight-medium">Tampilan Utama</label>
					<div class="col-4">
						<input type="text" name="utama" maxlength="1" class="form-control bt-max-length" placeholder="key" data-url="/" style="font-size: 18px!important;text-transform: uppercase " value="<?= $keyList['utama']['key'] ?>">
						<input type="text" name="utama-url" value="<?= '/' ?>" hidden>
					</div>
				</div>

				<div class="form-group  row">
					<label for="background-paralelogram" class="col-4 col-form-label font-weight-medium">Layanan</label>
					<div class="col-4">
						<input type="text" name="layanan" maxlength="1" data-url="layanan" class="form-control bt-max-length" placeholder="key" style="font-size: 18px!important;text-transform: uppercase" value="<?= $keyList['layanan']['key'] ?>">
						<input type="text" name="layanan-url" value="<?= 'layanan'?>" hidden>
					</div>
				</div>
			</div>

			<div class="col-4">
				<h4 style="font-family: titilliumweb-bold " class="mb-4">Panggilan</h4>
			</div>

			<div class="col-4">
				<h4 style="font-family: titilliumweb-bold " class="mb-4">Recall</h4>
			</div>

			<!-- text setting -->

			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<button type="submit" name="simpan" class="btn btn-primary col-12" id="keyboardSubmitBtn">SIMPAN</button>
				</div>


			</div>
		</form>

	</div>
</div>
