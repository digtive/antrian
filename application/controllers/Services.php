<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Services extends GLOBAL_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Jakarta");
			$this->load->model('AntrianModel','antrian');
			$this->load->model('LoketModel', 'loket');
			$this->load->model('LayananModel','layanan');
			$this->load->model('ServiceModel','service');
		}

		public function antrianLoket($loketID)
		{
			$antrianLoket = parent::model('service')->get_antrian_by_loket($loketID);
			$data = $antrianLoket->result_array();

			if ($this->input->is_ajax_request()) {
				if (!empty($data)){
					echo json_encode(array(
						'message' => 'menampilkan data antrian per loket',
						'data' => $data
					));
				}else{
					echo json_encode(array(
						'message' => 'antrian pada loket tersebut belum tersedia',
						'data' => array()
					));
				}
			}
		}
		
		public function call($loket)
		{
			$dataAntrian = $this->currentQueue($loket);
			$barisAntrianAktif = $dataAntrian->row_array();
			$antrianSelanjutnya = $this->leftQueue($loket);
			$dataAntrianSelanjutnya = $antrianSelanjutnya->result_array();

			if (!empty($dataAntrianSelanjutnya)){
				$sisaAntrian = $antrianSelanjutnya->num_rows();
			}else{
				$sisaAntrian = 0;
			}

			if ($barisAntrianAktif !== null){
				echo json_encode(array(
					'data' => $barisAntrianAktif,
					'sisa_antrian' => $sisaAntrian,
					'status' => '200',
					'message' => 'menampilkan antrian aktif'
				));
			}else{
				echo json_encode(array(
					'data' => array(),
					'sisa_antrian' => $sisaAntrian,
					'status' => '500',
					'message' => 'tidak atau belum ada antrian aktif'
				));
			}
		}

		public function activateNextQueue()
		{
			$antrianId = parent::post('antrian_id');
			$antrianNomor = parent::post('antrian_nomor');
			$loketId = parent::post('loket_id');

			$dataEditCurrent = array('antrian_status'=>'selesai');
			$editCurrentQueue = parent::model('service')->edit_antrian($antrianId,$dataEditCurrent);
			$antrianSelanjutnya = (int)$antrianNomor+1;

			if ($editCurrentQueue > 0){
				$editNextQueue = parent::model('service')->edit_antrian_by_number($antrianSelanjutnya,$loketId);

				if ($editNextQueue > 0){
					echo json_encode(array(
						'status' => '200',
						'message' => 'berhasil mengubah status antrian selanjutnya'
					));
				}else{
					echo json_encode(array(
						'status' => '500',
						'message' => 'kesalahan mengubah data status antrian berikutnya',
					));
				}
			}else{
				echo json_encode(array(
					'status' => '500',
					'message' => 'kesalahan mengubah data status antrian aktif',
				));
			}
		}


		/*
		 * mencari antrian yang sedang aktif
		 * */
		public function currentQueue($loketId)
		{
			$currentData = parent::model('service')->get_current_queue($loketId);

			return $currentData;
		}

		/*
		 * menghitung sisa antrian berdasarkan id loket dan status antrian
		 * */
		public function leftQueue($loketId)
		{
			$leftQueue = parent::model('service')->get_left_queue($loketId);

			return $leftQueue;
		}
	}
