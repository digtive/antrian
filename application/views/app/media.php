				<div class="card setting-card" >
					<div class="card-body">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<h5 style="font-family: titilliumweb-bold">Media Aktif</h5>
						<div class="col-12 border-bottom mb-2">
							<div class="row">
								<?php if ($mediaAktif === 'gambar'): ?>
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
								<?php else:?>
									<div class="form-radio col-6">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="media-aktif" id="left-to-right" value="gambar" >
											Slide Gambar
											<i class="input-helper"></i>
										</label>
									</div>
									<div class="form-radio col-6">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="media-aktif" id="right-to-left" value="video" checked>
											Video
											<i class="input-helper"></i></label>
									</div>
								<?php endif;?>
							</div>
						</div>

						<!-- setting tab content -->
						<div class="setting-tab">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Foto</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Video</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<form action="<?= base_url('ComponentService/setGambar')?>" class="form-row" method="post" enctype="multipart/form-data">
										<div class="col-5">
											<input type="text" name="gambar-option" hidden value="">
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
											<div class="list-wrapper media-gambar-list" style="height: 300px;overflow: auto">
												<ul class="d-flex flex-column-reverse todo-list">
													<?php for ($i =0; $i < count($dataGambar); $i++): ?>
														<li  style="padding: 4px !important;">
															<a href="<?= $dataGambar[$i]?>" target="_blank" title="lihat gambar">
																<?= $titleGambar[$i]?>
															</a>
															<a href="<?= base_url('ComponentService/deleteGambar/'.$i)?>" class="delete mdi mdi-close-circle-outline" ></a>
														</li>
													<?php endfor;?>
												</ul>
											</div>
										</div>

										<button type="submit" class="btn btn-primary col-12 mt-2" name="simpan" id="gambar-submit-btn" style="display: none">
											simpan
										</button>

									</form>
								</div>

								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<form action="<?= base_url('ComponentService/setVideo')?>" class="form-row" method="post" enctype="multipart/form-data">
										<div class="col-5">
											<input type="text" name="video-option" hidden value="">
											<div class="row">
												<div class="form-group col-11">
													<h5  style="font-family: titilliumweb-bold">Unggah Video</h5>
													<input type="file" class="dropify"
														   name="upload-video"
														   data-allowed-file-extensions="mp4 avi webm mpeg" id="upload-gambar" required>
												</div>
											</div>
										</div>
										<div class="col-7">
											<h5 style="font-family: titilliumweb-bold" class="mb-2">Daftar Putar Video</h5>
											<ul class="list-group list-group-flush" style="height: 300px;overflow: auto">
												<a href="#" target="_blank" title="lihat gambar">
													<li class="list-group-item" style="padding: 4px !important;">hitam biru.mp4</li>
												</a>
											</ul>
										</div>

										<button type="submit" class="btn btn-primary col-12 mt-2" name="simpan" id="video-submit-btn" style="display: none">
											simpan
										</button>

									</form>
								</div>
							</div>
						</div>
						<!-- end setting tab content -->

					</div>

				</div>
