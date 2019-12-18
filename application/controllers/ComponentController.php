<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComponentController extends GLOBAL_Controller {

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

	public function header()
	{
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Header Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Header Aplikasi';
		$data['activeMenu'] = 'header';


		parent::settingsPages('components/header',$data);
	}

	public function footer()
	{
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Footer Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Footer Aplikasi';
		$data['activeMenu'] = 'footer';


		parent::settingsPages('components/footer',$data);
	}

	public function loket()
	{
		$data['title'] = 'Pengaturan Aplikasi';
		$data['page_title'] = 'Pengaturan Loket Aplikasi';
		$data['settingsTitle'] = 'Pengaturan Loket Aplikasi';
		$data['activeMenu'] = 'loket';


		parent::settingsPages('components/loket',$data);
	}

}
