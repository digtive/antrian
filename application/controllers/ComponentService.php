<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComponentService extends GLOBAL_Controller {
	private $userAppID;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->userAppID = get_cookie('user_app');
		$this->load->model('ComponentModel','component');
	}

	/*
	 * modul untuk mendapatkan data user App
	 * */
	public function userApp()
	{
		$query = array(
			'app_id' => get_cookie('user_app')
		);
		$userApp = parent::model('component')->get_user_app($query);

		if ($userApp !== null){
			echo json_encode(array(
				'data' => $userApp,
				'message' => 'menampilkan data aplikasi pengguna',
				'status' => 'success'
			));
		}else{
			echo json_encode(array(
				'data' => null,
				'message' => 'tidak ada data untuk ditampilkan',
				'status' => 'error'
			));
		}
	}

	/*
	 * modul untuk menyimpan perubahan setting dari klien ke database
	 * */
	public function editHeader()
	{
		if (isset($_POST['background-header'])){
			$clientInput = array(
				"logo-position" => parent::post('logo-position'),
				"background-header" => parent::post('background-header'),
				"background-paralelogram" => parent::post('background-paralelogram'),
				"background-timer" => parent::post('background-timer'),
				"color-timer" => parent::post('color-timer'),
				"font-family-timer" => parent::post('font-family-timer'),
				"fon-size" => '45px',
				"color-date" => parent::post('color-date'),
				"font-family-date" => parent::post('font-family-date')
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_header' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID,$dataEdit);

			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		}else{
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function editFooter()
	{
		if (isset($_POST['background-footer'])){
			$clientInput = array(
				"background-footer" => parent::post('background-footer'),
				"color-footer" => parent::post('color-footer'),
				"font-family-footer" => parent::post('font-family-footer'),
				"footer-text" => parent::post('footer-text'),
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_footer' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID,$dataEdit);

			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		}else{
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function editService()
	{
		if (isset($_POST['background-queue-box'])){
			$clientInput = array(
				'background-queue-box' => parent::post('background-queue-box'),
				'background-queue-number' => parent::post('background-queue-number'),
				'background-queue-footer' => parent::post('background-queue-footer'),
				'color-number' => parent::post('color-number'),
				'color-queue-name' => parent::post('color-queue-name'),
				'color-footer' => parent::post('color-footer'),
				'color-left-queue' => parent::post('color-left-queue'),
				'font-family-number' => parent::post('font-family-number'),
				'font-family-name' => parent::post('font-family-name'),
				'font-family-footer' => parent::post('font-family-footer'),
				'font-family-left-queue' => parent::post('font-family-left-queue'),
				'border-top-footer-color' => parent::post('background-queue-number')
			);

			$dataJson = json_encode($clientInput);

			$dataEdit = array(
				'app_service' => $dataJson,
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID,$dataEdit);

			echo json_encode(array(
				'data' => null,
				'message' => 'berhasil menyimpan data',
				'status' => 'success'
			));

		}else{
			echo json_encode(array(
				'data' => null,
				'message' => 'permintaan ditolak',
				'status' => 'error'
			));
		}
	}

	public function unggahLatar()
	{
		if (isset($_POST['unggah'])){
			$config['upload_path'] = './assets/images/background/';
			$config['allowed_types'] = 'png|jpeg|jpg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('background-image-src');
			$gambarLatar = $this->upload->data('file_name');

			$dataContainer = array(
				'background-color' => parent::post('background-color'),
				'background-image' => parent::post('background-image'),
				'background-image-src' => base_url('assets/images/background/').$gambarLatar
			);

			$dataEdit = array(
				'app_container' => json_encode($dataContainer),
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID,$dataEdit);

			parent::alert('alert','edit');
			redirect('settings/parent');

		}else{
			show_404();
		}
	}

	public function unggahLogo()
	{
		if (isset($_POST['unggah'])){
			$config['upload_path'] = './assets/images/logo/';
			$config['allowed_types'] = 'png|jpeg|jpg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$this->upload->do_upload('logo-img');
			$logo = $this->upload->data('file_name');

			$dataEdit = array(
				'app_logo' => json_encode(base_url('assets/images/logo/').$logo),
				'app_date_edited' => date('Y-m-d H:i:s')
			);

			parent::model('component')->edit_component($this->userAppID,$dataEdit);

			parent::alert('alert','edit');
			redirect('settings/header');

		}else{
			show_404();
		}
	}

}