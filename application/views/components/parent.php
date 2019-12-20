
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3 style="font-family:  titilliumweb-bold">Preview</h3>
		<div class="row mb-3" >
			<div class="col-12">
				<div class="" id="parent-simulator" style="height: 280px;background-color: #0ba1b5">

				</div>
			</div>
		</div>


		<form action="#" class="row pt-4 border-top">
			<div class="col-12">
				<h3 style="font-family: titilliumweb-bold">
					Pengaturan
				</h3>
			</div>
			<div class="col-6">
				<div class="form-check form-check-flat">
					<label class="form-check-label" style="font-family: titilliumweb-bold;font-size: 18px">
						<input type="checkbox" class="form-check-input" >
						Latar Gambar
						<i class="input-helper"></i></label>
				</div>
				<div class="form-group row ">
					<label for="background-header" class="col-4 col-form-label font-weight-medium">Warna Latar</label>
					<div class="col-8">
						<input type='text' class="color-picker" value="#0ba1b5" name="background-header" data-transform="#parent-simulator" data-change="background-color"/>
					</div>
				</div>

				<div class="form-group row mt-2">
					<label for="warna-latar-loket" class="col-4 col-form-label font-weight-medium">Gambar Latar</label>
					<div class="col-8">
						<input type="file" class="dropify" disabled>
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
