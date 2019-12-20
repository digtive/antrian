<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AppController extends GLOBAL_Controller {
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('AuthModel','auth');
			$this->load->model('ComponentModel','component');
			date_default_timezone_set("Asia/Jakarta");
		}
		
		public function index()
		{
			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';

			$lisensi = parent::model('auth')->get_lisensi();

			if (get_cookie('user_app') === null){
				$expire = 86400*30*$lisensi['kadaluarsa'];
				set_cookie('user_app', $lisensi['id_app'],$expire);
			}

			$query = array(
				'app_id' => get_cookie('user_app')
			);


			$data['component']  = parent::model('component')->get_user_app($query);
			$data['container'] = json_decode($data['component']['app_container'],true);
			$data['header'] = json_decode($data['component']['app_header'],true);
			$data['loket'] = json_decode($data['component']['app_service'],true);
			$data['footer'] = json_decode($data['component']['app_footer'],true);
//			parent::cek_array($data['header']);
			parent::authPage('app/index',$data);
		}

		public function settings()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Umum';
			$data['activeMenu'] = 'umum';


			parent::settingsPages('app/settings',$data);
		}

		public function loket()
		{
			$data['title'] = 'Pengaturan Loket';
			$data['page_title'] = 'Pengaturan Loket';
			$data['settingsTitle'] = 'Pengaturan Loket';
			$data['activeMenu'] = 'loket';

			parent::settingsPages('app/loket',$data);
		}

		public function colours()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Warna';
			$data['activeMenu'] = 'warna';

			parent::settingsPages('app/colours',$data);
		}

		public function texts()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Teks';
			$data['activeMenu'] = 'teks';

			parent::settingsPages('app/texts',$data);
		}

		public function audio()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Suara';
			$data['activeMenu'] = 'suara';

			parent::settingsPages('app/audio',$data);
		}

		public function media()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Media';
			$data['activeMenu'] = 'media';

			parent::settingsPages('app/media',$data);
		}

		public function prints()
		{
			$data['title'] = 'Pengaturan Aplikasi';
			$data['page_title'] = 'Pengaturan Aplikasi';
			$data['settingsTitle'] = 'Pengaturan Hasil Cetak';
			$data['activeMenu'] = 'cetakan';

			parent::settingsPages('app/prints',$data);
		}
	}
