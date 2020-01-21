
<div class="card setting-card" id="dataVue">
	<div class="card-body" style="overflow: hidden">
		<h4 class="card-title pb-3 border-bottom mb-3"><?= $settingsTitle;?></h4>
			<div class="setting-tab">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Tampilan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-daftar-loket" role="tab" aria-controls="pills-profile" aria-selected="false">Daftar Loket</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<h3>Preview</h3>
				<div class="row mb-3" >
					<div class="col-12">
						<div id="queue-box-wrapper-simulator">
							<div class="queue-box" style="background-color: <?= $serviceComponent['background-queue-box']?>;" id="queue-box-simulator">
								<div class="queue-name">
									<h2 class="font-weight-light" style="color: <?= $serviceComponent['color-queue-name']?>;font-size: 28px;font-family: <?= $serviceComponent['font-family-name']?>" id="text-loket-simulator">
										Nama Loket
									</h2>
								</div>
								<div class="queue-number d-flex justify-content-end" style="background-color: <?= $serviceComponent['background-queue-number']?>;" id="queue-number-simulator">
									<h1 class="queue-number-content" style="font-family: <?= $serviceComponent['font-family-number']?>';font-weight: bolder;color: <?= $serviceComponent['color-number']?>" id="queue-number-content-simulator">A008</h1>
								</div>
								<div class="queue-footer d-flex justify-content-between" style="border-top: 4px <?= $serviceComponent['border-top-footer-color']?> solid;background-color:  <?= $serviceComponent['background-queue-footer']?>" id="queue-footer-simulator">
									<span style="color: <?= $serviceComponent['color-footer']?>;font-family: <?= $serviceComponent['font-family-footer']?>" id="quote-antrian">Menuju Loket : 3</span>
									<span style="color: <?= $serviceComponent['color-left-queue']?>;font-family: <?= $serviceComponent['font-family-left-queue']?>" id="quote-sisa-antrian">Sisa Antrian : 4</span>
								</div>
							</div>
						</div>
					</div>
				</div>


				<form action="#" class="row pt-4 border-top" method="post" id="serviceComponentData">
					<div class="col-6">
						<div class="row mt-2">
							<div class="col-12" ><h4 style="font-family: titilliumweb-bold">Warna</h4></div>
							<label for="background-queue-box" class="col-6 col-form-label font-weight-medium">Latar Loket</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['background-queue-box']?>" name="background-queue-box" data-transform="#queue-box-simulator" data-change="background-color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="background-queue-number" class="col-6 col-form-label font-weight-medium">Latar Antrian</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['background-queue-number']?>" name="background-queue-number" data-transform="#queue-number-simulator" data-change="background-color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="background-queue-footer" class="col-6 col-form-label font-weight-medium">Latar Footer</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['background-queue-footer']?>" name="background-queue-footer" data-transform="#queue-footer-simulator" data-change="background-color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="color-number" class="col-6 col-form-label font-weight-medium">Teks Antrian</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['color-number']?>" name="color-number" data-transform="#queue-number-content-simulator" data-change="color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="color-queue-name" class="col-6 col-form-label font-weight-medium">Teks Layanan</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?=$serviceComponent['color-queue-name'] ?>" name="color-queue-name" data-transform="#text-loket-simulator" data-change="color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="color-footer" class="col-6 col-form-label font-weight-medium">Teks Footer</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['color-footer'] ?>" name="color-footer" data-transform="#quote-antrian" data-change="color"/>
							</div>
						</div>
						<div class="row mt-2">
							<label for="color-left-queue" class="col-6 col-form-label font-weight-medium">Teks Sisa Antrian</label>
							<div class="col-6">
								<input type='text' class="color-picker" value="<?= $serviceComponent['color-left-queue']?>" name="color-left-queue" data-transform="#quote-sisa-antrian" data-change="color"/>
							</div>
						</div>
					</div>

					<!-- text setting -->
						<div class="col-6">
							<div class="row mt-2">
								<div class="col-12">
									<h4>Text</h4>
								</div>
								<label for="font-family-number" class="col-6 col-form-label font-weight-medium">Gaya Huruf Antrian</label>
								<div class="col-6">
									<select class="form-control border-primary form-simulator select-simulator" data-transform="#queue-number-content-simulator" data-change="font-family" name="font-family-number">
										<option value="<?= $serviceComponent['font-family-number']?>"><?= $serviceComponent['font-family-number']?></option>
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
								<label for="font-family-name" class="col-6 col-form-label font-weight-medium">Gaya Huruf Layanan</label>
								<div class="col-6">
									<select class="form-control border-primary form-simulator select-simulator" data-transform="#text-loket-simulator" data-change="font-family" name="font-family-name">
										<option value="<?= $serviceComponent['font-family-name']?>"><?= $serviceComponent['font-family-name']?></option>
										<option value="roboto-bold">Roboto</option>
										<option value="girassol-regular">Girassol</option>
										<option value="titilliumweb-bold">Titillium Web</option>
										<option value="sans-serif">Sans Serif</option>
										<option value="digi-regular">Digital</option>
										<option value="digi-bold">Digital Bold</option>
									</select>
								</div>
							</div>
							<div class="row mt-2">
								<label for="font-family-footer" class="col-6 col-form-label font-weight-medium">Gaya Huruf Footer</label>
								<div class="col-6">
									<select class="form-control border-primary form-simulator select-simulator" data-transform="#quote-antrian" data-change="font-family" name="font-family-footer">
										<option value="<?= $serviceComponent['font-family-footer']?>"><?= $serviceComponent['font-family-footer']?></option>
										<option value="roboto-bold">Roboto</option>
										<option value="girassol-regular">Girassol</option>
										<option value="titilliumweb-bold">Titillium Web</option>
										<option value="sans-serif">Sans Serif</option>
										<option value="digi-regular">Digital</option>
										<option value="digi-bold">Digital Bold</option>
									</select>
								</div>
							</div>
							<div class="row mt-2">
								<label for="font-family-left-queue" class="col-6 col-form-label font-weight-medium">Gaya Huruf Sisa Antrian</label>
								<div class="col-6">
									<select class="form-control border-primary form-simulator select-simulator" data-transform="#quote-sisa-antrian" data-change="font-family" name="font-family-left-queue">
										<option value="<?= $serviceComponent['font-family-left-queue']?>">Roboto</option>
										<option value="roboto-bold">Roboto</option>
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
								<button type="button" name="simpan" class="btn btn-primary col-12" id="serviceSubmitBtn">simpan</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="pills-daftar-loket" role="tabpanel" aria-labelledby="pills-profile-tab">
					<button href="#" type="button" data-toggle="modal" data-target="#exampleModal" name="tambah" class="btn btn-primary col-3 float-left mb-1" id="serviceSubmitBtn"><i class="icon-plus"></i>Tambah Loket</button>
					
					<div class = "table-responsive-sm">
						<table class = "table">
							<thead class="thead-dark">
								<tr>
									<th>No</th>
									<th>Nama Loket</th>
									<th>Nomor Loket</th>
									<th>Layanan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
									foreach($loket->result() as $l){
								?>
									<tr>
										<td><?= $no++?></td>
										<td><?= $l->loket_nama?></td>
										<td><?= $l->loket_nomor?></td>
										<td><?= $l->layanan_nama?></td>
										<td>
											<a href="<?= base_url("ComponentService/editLoket/".$l->loket_id)?>"class="btn btn-warning"><i class="fa fa-pencil"></i></a>
											<a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="<?= base_url("ComponentService/deleteLocket/".$l->loket_id)?>"class="btn btn-danger"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
									}
								?>
							</tbody>
						</table>
				</div>
			</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Loket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form class = "row pt-4" action = "<?= base_url("ComponentService/addLocket")?>" method="post">
                <div class="form-group row">
					<label for="locket_name" class="col-sm-2 col-form-label font-weight-medium">Nama Loket</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="locket_name" name="locket_name" placeholder="Nama Loket">
					</div>
					<label for="locket_number" class="col-sm-2 col-form-label font-weight-medium">Nomor Loket</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="locket_number" placeholder="Nomor Loket" name="locket_number">
					</div>
					<label for="font-family-timer" class="col-sm-2 col-form-label font-weight-medium">Layanan</label>
					<div class="col-sm-10">
						<select name="locket_services" class="form-control border-primary form-simulator select-simulator" data-transform="#time-content" data-change="font-family" name="font-family-timer">
							<?php
								foreach($layanan->result() as $s){
							?>
								<option value="<?= $s->layanan_id?>"><?= $s->layanan_nama?></option>	
							<?php
								}
							?>
						</select>
					</div>
				</div>
            </div>
			     <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>

        </div>
    </div>
</div>
