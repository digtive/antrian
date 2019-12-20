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
}
