<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AppController extends GLOBAL_Controller {
		
		public function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");

		}
		
		public function index()
		{
			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';
			$data['waktu'] = date('h:i');

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
