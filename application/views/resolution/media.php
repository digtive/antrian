				<div class="card setting-card" >
					<div class="card-body">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<!-- setting tab content -->
						<div class="setting-tab">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Utama</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Layanan</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
									<div class="row">
										<div class="col-5">
											<form>

												<div class="form-group row">
													<label for="warna-latar" class="col-6 col-form-label font-weight-medium">Warna Latar</label>
													<div class="col-6">
														<input type='text' class="color-picker" value="#0ba1b5" name="warna-latar" id="warna-latar"/>
													</div>
												</div>

												<div class="form-group row">
													<label for="warna-header" class="col-6 col-form-label font-weight-medium">Warna Header</label>
													<div class="col-6">
														<input type='text' class="color-picker" value="#ffe74c" name="warna-header" id="warna-header"/>
													</div>
												</div>

												<div class="form-group row mt-5">
													<div class="col-sm-12">
														<div class="d-flex justify-content-end">
															<button type="submit" class="btn btn-primary">Simpan</button>
														</div>
													</div>
												</div>

											</form>
										</div>
										<div class="col-7">

										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
							</div>
						</div>
						<!-- end setting tab content -->

					</div>

				</div>
