<?php

	class LayananController extends GLOBAL_Controller{


		private $userAppID;

		public function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->userAppID = get_cookie('user_app');
			$this->load->model('ComponentModel', 'component');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('AntrianModel','antrian');
			$this->load->model('ServiceModel','service');
		}

		public function index()
		{
			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';

			parent::authPage('layanan/index',$data);
		}

		public function lists(){
			$data['title'] = 'Daftar Loket/Layanan';
			$data['page_title'] = 'Aplikasi Antrian';

			$data['dataLoket'] = parent::model('antrian')->get_loket()->result_array();
			$data['service'] = parent::model('service');

			parent::authPage('layanan/daftar',$data);
		}
	}
