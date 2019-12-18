
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>

		<h3>Preview</h3>
		<div class="row mb-3" >
			<div class="col-12">
				<div id="queue-box-wrapper-simulator">
					<div class="queue-box" style="background-color: #0f1531;" id="queue-box-simulator">
						<div class="queue-name">
							<h2 class="font-weight-light" style="color: white;font-size: 28px;font-family: Roboto" id="text-loket-simulator">
								Nama Loket
							</h2>
						</div>
						<div class="queue-number d-flex justify-content-end" style="background-color: #0b51c5;" id="queue-number-simulator">
							<h1 class="queue-number-content" style="font-family: 'roboto-light';font-weight: bolder;color: white" id="queue-number-content-simulator">A008</h1>
						</div>
						<div class="queue-footer d-flex justify-content-between" style="border-top: 4px #0b51c5 solid;background-color: #0f1531" id="queue-footer-simulator">
							<span style="color: white;font-family: Roboto" id="quote-antrian">Menuju Loket : 3</span>
							<span style="color: white;font-family: Roboto" id="quote-sisa-antrian">Sisa Antrian : 4</span>
						</div>
					</div>
				</div>
			</div>
		</div>


		<form action="#" class="row pt-4 border-top" method="post">
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12" ><h4 style="font-family: titilliumweb-bold">Warna</h4></div>
					<label for="warna-latar-loket" class="col-6 col-form-label font-weight-medium">Latar Loket</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#0f1531" name="warna-latar-loket" data-transform="#queue-box-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-latar-antrian" class="col-6 col-form-label font-weight-medium">Latar Antrian</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#0b51c5" name="warna-latar-antrian" data-transform="#queue-number-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-latar-footer" class="col-6 col-form-label font-weight-medium">Latar Footer</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#0f1531" name="warna-latar-footer" data-transform="#queue-footer-simulator" data-change="background-color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-text-antrian" class="col-6 col-form-label font-weight-medium">Teks Antrian</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-text-antrian" data-transform="#queue-number-content-simulator" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-text-loket" class="col-6 col-form-label font-weight-medium">Teks Layanan</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-text-loket" data-transform="#text-loket-simulator" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-text-footer" class="col-6 col-form-label font-weight-medium">Teks Footer</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-text-footer" data-transform="#quote-antrian" data-change="color"/>
					</div>
				</div>
				<div class="row mt-2">
					<label for="warna-text-sisa-antrian" class="col-6 col-form-label font-weight-medium">Teks Sisa Antrian</label>
					<div class="col-6">
						<input type='text' class="color-picker" value="#ffffff" name="warna-text-footer" data-transform="#quote-sisa-antrian" data-change="color"/>
					</div>
				</div>
			</div>

			<!-- text setting -->
			<div class="col-6">
				<div class="row mt-2">
					<div class="col-12">
						<h4>Text</h4>
					</div>
					<label for="gaya-huruf-nomor-antrian" class="col-6 col-form-label font-weight-medium">Gaya Huruf Antrian</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#queue-number-content-simulator" data-change="font-family" name="gaya-huruf-nomor-antrian">
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
					<label for="gaya-huruf-loket" class="col-6 col-form-label font-weight-medium">Gaya Huruf Layanan</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#text-loket-simulator" data-change="font-family" name="gaya-huruf-loket">
							<option value="robot-bold">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label for="gaya-huruf-footer" class="col-6 col-form-label font-weight-medium">Gaya Huruf Footer</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#quote-antrian" data-change="font-family" name="gaya-huruf-footer">
							<option value="robot-bold">Roboto</option>
							<option value="girassol-regular">Girassol</option>
							<option value="titilliumweb-bold">Titillium Web</option>
							<option value="sans-serif">Sans Serif</option>
							<option value="digi-regular">Digital</option>
							<option value="digi-bold">Digital Bold</option>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<label for="gaya-huruf-sisa-antrian" class="col-6 col-form-label font-weight-medium">Gaya Huruf Sisa Antrian</label>
					<div class="col-6">
						<select class="form-control border-primary form-simulator select-simulator" data-transform="#quote-sisa-antrian" data-change="font-family" name="gaya-huruf-sisa-antrian">
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
