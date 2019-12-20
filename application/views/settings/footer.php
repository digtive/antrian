			</div>

		</div>

	</div>
</div>
<!-- container-scroller -->
<!-- PLUGINS FOR ENTIRE SYSTEMS  -->
<script src="<?= base_url() ?>assets/js/plugins/vue.js"></script>
<script src="<?= base_url() ?>assets/js/package/settings.js"></script>

<!-- plugins:js -->
<script src="<?= base_url('assets/node_modules/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/moment/moment.js')?>"></script>
<script src="<?= base_url('assets/node_modules/moment/moment-with-locales.js')?>"></script>
<script src="<?= base_url('assets/node_modules/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') ?>"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/progressbar.js/dist/progressbar.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/inputmask/dist/jquery.inputmask.bundle.js"></script>
<script src="<?= base_url()?>assets/node_modules/inputmask/dist/inputmask/phone-codes/phone.js"></script>
<script src="<?= base_url()?>assets/node_modules/inputmask/dist/inputmask/phone-codes/phone-be.js"></script>
<script src="<?= base_url()?>assets/node_modules/inputmask/dist/inputmask/phone-codes/phone-ru.js"></script>
<script src="<?= base_url()?>assets/node_modules/inputmask/dist/inputmask/bindings/inputmask.binding.js"></script>
<script src="<?= base_url()?>assets/node_modules/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/dropzone/dist/dropzone.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-file-upload/js/jquery.uploadfile.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-asGradient/dist/jquery-asGradient.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/moment/min/moment.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?= base_url()?>assets/node_modules/jquery.repeater/jquery.repeater.min.js"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<script src="<?= base_url('assets/') ?>node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/morris.js/morris.min.js"></script>
<script src="<?= base_url('assets/') ?>node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="<?= base_url('assets/') ?>js/off-canvas.js"></script>
<script src="<?= base_url('assets/') ?>js/hoverable-collapse.js"></script>
<script src="<?= base_url('assets/') ?>js/misc.js"></script>
<script src="<?= base_url('assets/') ?>js/settings.js"></script>
<script src="<?= base_url('assets/') ?>js/todolist.js"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="<?= base_url('assets/') ?>js/dashboard.js"></script>
<script src="<?= base_url()?>assets/js/form-addons.js"></script>
<script src="<?= base_url()?>assets/js/x-editable.js"></script>
<script src="<?= base_url()?>assets/js/dropify.js"></script>
<script src="<?= base_url()?>assets/js/dropzone.js"></script>
<script src="<?= base_url()?>assets/js/jquery-file-upload.js"></script>
<script src="<?= base_url()?>assets/js/formpickers.js"></script>
<script src="<?= base_url()?>assets/js/form-repeater.js"></script>

<!-- End custom js for this page-->

<!-- Custom js for this page-->
<script src="<?= base_url('assets/js/plugins/countdown.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/moment.js') ?>"></script>
<script src="<?= base_url('assets/') ?>js/dashboard.js"></script>
<script src="<?= base_url('assets/js/app/waktu.js') ?>"></script>
<script src="<?= base_url()?>assets/js/app/formColor.js"></script>
<script src="<?= base_url('assets/js/package/timer.js') ?>"></script>
<script src="<?= base_url('assets/js/package/formSimulator.js') ?>"></script>
<!-- End custom js for this page-->

<!-- components setting to server [API] -->
<script type="text/javascript" src="<?= base_url('assets/js/components/header.js')?>"></script>




<script>
    $(document).ready(function () {
        let baseUrl = window.location.origin+'/antrian/';
        // $(document).keypress(function (key) {
        //     let btnSetting = key.originalEvent.key;
        //     if (btnSetting === 'h'){
        //         window.location.href = baseUrl;
        //     }
        // });

        let settingAlert = setInterval(function () {
			$('.setting-alert').fadeOut('slow');
        },2000);
    })
</script>


</body>

</html>
