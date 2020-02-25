<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComponentController extends GLOBAL_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('ComponentModel','component');
		$this->load->model('LoketModel','loket');
		$this->load->model('LayananModel','layanan');
	}

	public function index()
	{
		$data['title'] = 'Aplikasi Antrian';
		$data['page_title'] = 'Aplikasi Antrian';
		$data['waktu'] = date('h:i');

		parent::authPage('app/index',$data);
	}

	public function parent()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan  Aplikasi';
			$data['activeMenu'] = 'parent';

			$query = array(
				'app_id' => get_cookie('user_app')
			);

			$data['component']  = parent::model('component')->get_user_app($query);
			$data['container'] = json_decode($data['component']['app_container'],true);
//		parent::cek_array($data['container']);

			parent::settingsPages('components/parent',$data);
		}
	}

	public function header()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Header Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Header Aplikasi';
			$data['activeMenu'] = 'header';

			$query = array(
				'app_id' => get_cookie('user_app')
			);

			$data['component']  = parent::model('component')->get_user_app($query);
			$data['headerComponent'] = json_decode($data['component']['app_header'],true);
			$data['logo'] = json_decode($data['component']['app_logo'],true);

			parent::settingsPages('components/header',$data);
		}
	}

	public function footer()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Footer Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Footer Aplikasi';
			$data['activeMenu'] = 'footer';

			$query = array(
				'app_id' => get_cookie('user_app')
			);

			$data['component']  = parent::model('component')->get_user_app($query);
			$data['footerComponent'] = json_decode($data['component']['app_footer'],true);
//		parent::cek_array($data['footerComponent']);

			parent::settingsPages('components/footer',$data);
		}
	}

	public function loket()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Loket Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
			$data['activeMenu'] = 'loket';

			$query = array(
				'app_id' => get_cookie('user_app')
			);
			$data['component']  = parent::model('component')->get_user_app($query);
			$data['serviceComponent'] = json_decode($data['component']['app_service'],true);
			$data['loket'] = parent::model('loket')->getJoinLoket();
			$data['layanan'] = parent::model('layanan')->get_layanan();
			$data['nextLocket'] = $data['loket']->num_rows()+1;
//			parent::cek_array($data['nextLocket']);
			parent::settingsPages('components/loket',$data);
		}
	}
	public function tombol()
	{
		if ($this->session->userdata('username') === null){
			redirect('layanan/registrasi');
		}else{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Tombol Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Tombol Aplikasi';
			$data['activeMenu'] = 'tombol';

			$query = array(
				'app_id' => get_cookie('user_app')
			);
			$data['keyboard']  = parent::model('component')->get_keyboard_setting($query);
			$data['dataLoket'] = parent::model('loket')->getJoinLoket()->result_array();
			$data['keyList'] = json_decode($data['keyboard']['setting_tombol'],true);

			parent::settingsPages('components/tombol',$data);
		}
	}
	public function editLoket(){
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Loket Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
		$data['activeMenu'] = 'loket';
		$query = array(
			'app_id' => get_cookie('user_app')
		);
		$data['component']  = parent::model('component')->get_user_app($query);
		$data['serviceComponent'] = json_decode($data['component']['app_service'],true);
		$data['loket'] = parent::model('loket')->getJoinLoket();
		$data['layanan'] = parent::model('layanan')->get_layanan();
		parent::settingsPages('components/loket_edit',$data);
	}
	
}
