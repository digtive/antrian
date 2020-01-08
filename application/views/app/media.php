				<div class="card setting-card" >
					<div class="card-body">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<h5 style="font-family: titilliumweb-bold">Media Aktif</h5>
						<div class="col-12 border-bottom mb-2">
							<div class="row">
								<div class="form-radio col-6">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="media-aktif" id="left-to-right" value="gambar" checked>
										Slide Gambar
										<i class="input-helper"></i>
									</label>
								</div>
								<div class="form-radio col-6">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="media-aktif" id="right-to-left" value="video">
										Video
										<i class="input-helper"></i></label>
								</div>
							</div>
						</div>

						<!-- setting tab content -->
						<div class="setting-tab">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Foto</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Video</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<form action="<?= base_url('ComponentService/setGambar')?>" class="form-row" method="post" enctype="multipart/form-data">
										<div class="col-5">
											<input type="text" name="media-aktif" hidden value="gambar">
											<div class="row">
												<div class="form-group col-11">
													<h5  style="font-family: titilliumweb-bold">Unggah Gambar</h5>
													<input type="file" class="dropify"
														   name="upload-gambar"
														   data-allowed-file-extensions="jpg png jpeg" id="upload-gambar" required>
												</div>
												<div class="form-group col-11">
													<h5 style="font-family: titilliumweb-bold">Durasi Slide (detik)</h5>
													<input type="number" class="form-control" name="durasi-gambar" required value="<?= $durasi?>">
												</div>
											</div>
										</div>
										<div class="col-7">
											<h5 style="font-family: titilliumweb-bold" class="mb-2">Daftar Gambar</h5>
											<ul class="list-group list-group-flush" style="height: 300px;overflow: auto">
												<?php for ($i =0; $i < count($dataGambar); $i++): ?>
													<a href="<?= $dataGambar[$i]?>" target="_blank" title="lihat gambar">
														<li class="list-group-item" style="padding: 4px !important;"><?= $titleGambar[$i]?></li>
													</a>
												<?php endfor;?>

											</ul>
										</div>

										<button type="submit" class="btn btn-primary col-12 mt-2" name="simpan">
											simpan
										</button>

									</form>
								</div>
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
							</div>
						</div>
						<!-- end setting tab content -->

					</div>

				</div>
