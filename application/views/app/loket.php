				<div class="card setting-card" id="settings-card">
					<div class="card-body" id="dataVue">
						<h4 class="card-title pb-3 border-bottom"><?= $settingsTitle;?></h4>

						<!-- setting tab content -->
						<div class="setting-tab">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Layanan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Tombol Pintasan</a>
								</li>
							</ul>

							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<div class="card bg-facebook ">
										<div class="card-body simple-card-body">
											<h3>Nama Layanan</h3>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
							</div>
						</div>
						<!-- end setting tab content -->


					</div>
				</div>
