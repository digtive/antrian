<?php
	class DevicesController extends GLOBAL_Controller{

		public function __construct()
		{
			parent::__construct();

		}

		public function index()
		{
			$data['title'] = 'Aplikasi Antrian';
			$data['page_title'] = 'Aplikasi Antrian';

			parent::authPage('devices/index',$data);
		}

		public function auth()
		{
			parent::authPage('');
		}

	}
