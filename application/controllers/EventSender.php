<?php

	require __DIR__ . '/../../vendor/autoload.php';

	use Sse\SSE;
	use Sse\Data;
	use Sse\Event;
	use AppEvent\CallEvent;
	use AppEvent\EventFire;

	class EventSender extends GLOBAL_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('AntrianModel','antrian');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('LayananModel','layanan');
			$this->load->model('ServiceModel','service');
			$this->load->model('ComponentModel','component');
		}

		public function update()
		{
			if (isset($_GET['name'])){
				$path = __DIR__.'\data';
				$data = new Data('file',array('path' => './data'));

				$data->set('name',json_encode(array(
					'name' => parent::get('name'),
					'time' => time()
				)));

				echo 'berhasil';
			}
		}

		public function broadcast()
		{
			$data = new Data('file',array('path' => './data'));

			echo $data->get('name');
		}

		public function getCallUpdated()
		{
			return parent::model('service')->get_call_by_id(1);
		}

	}
