<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle; ?></h4>
		<div class="setting-tab">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
					   aria-controls="pills-home" aria-selected="true">Edit Layanan</a>
				</li>
			</ul>

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<form class=" pt-4"
						  action="<?= base_url("ComponentService/editLayanan/" . $currentData['layanan_id']) ?>"
						  method="post">
						<div class="form-group row">
							<label for="locket_name" class="col-3 col-form-label font-weight-medium">
								Nama Layanan
							</label>
							<div class="col-9 mb-3">
								<input type="text" value="<?= $currentData['layanan_nama'] ?>" class="form-control"
									   id="locket_name" name="service_name" placeholder="Nama Layanan" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="locket_number" class="col-3 col-form-label font-weight-medium">Awalan
								Layanan</label>
							<div class="col-9 mb-3">
								<input value="<?= $currentData['layanan_awalan'] ?>" type="text" class="form-control bt-max-lenght" maxlength="1"
									   id="locket_number" placeholder="awalan layanan (contoh A atau 1)" name="service_prefix" style="text-transform: uppercase" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-6">
								<a href="<?= base_url('settings/loket')?>"   class="btn btn-secondary col-12" >BATALKAN</a>
							</div>
							<div class="col-6">
								<button type="submit" name="submit" class="btn btn-primary col-12">SIMPAN</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

