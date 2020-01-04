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
			//antrian aktif
			$dataAntrian = $this->currentQueue($loket);
			$barisAntrianAktif = $dataAntrian->row_array();
			// antrian status menunggu
			$dataSisaAntrian = $this->leftQueue($loket);
			$dataAntrianSelanjutnya = $dataSisaAntrian->result_array();

			// menentukan jumlah sisa antrian
			if (!empty($dataAntrianSelanjutnya)){
				$sisaAntrian = $dataSisaAntrian->num_rows();
			}else{
				$sisaAntrian = 0;
			}

			if ($barisAntrianAktif !== null){
				$current = $barisAntrianAktif;
				$antrianSelanjutnya = $current['antrian_nomor']+1;
				$nextQueue  = parent::model('service')->get_next_queue($antrianSelanjutnya,$loket);

				$this->setCookieData($current['antrian_nomor'],$loket,2);


				if ($nextQueue !== null){
					if ($this->activateNextQueue($current['antrian_id'],$current['antrian_nomor'],$loket)){
						echo json_encode(array(
							'data' => $barisAntrianAktif,
							'sisa_antrian' => $sisaAntrian,
							'status' => '200',
							'message' => 'menampilkan antrian aktif'
						));
					}else{
						echo json_encode(array(
							'data' => $barisAntrianAktif,
							'sisa_antrian' => $sisaAntrian,
							'status' => '500',
							'message' => 'masalah mengubah status antrian berikutnya'
						));
					}
				}else{
					echo json_encode(array(
						'data' => $barisAntrianAktif,
						'sisa_antrian' => $sisaAntrian,
						'status' => '500',
						'message' => 'antrian telah selesai'
					));
				}

			}else{
				echo json_encode(array(
					'data' => array(),
					'sisa_antrian' => $sisaAntrian,
					'status' => '500',
					'message' => 'tidak atau belum ada antrian aktif hari ini'
				));
			}
		}

		public function recall()
		{
			if (isset($_COOKIE['counter'])){
				$dataCounter = (int)$_COOKIE['counter'];
				$counter = $dataCounter+1;
				if ($counter >10){
					setcookie('counter','1',time()+(86400*1),'/');
				}else{
					setcookie('counter',$counter,time()+(86400*1),'/');
				}

				echo json_encode(array(
					'status' => '200',
					'message' => 'recall antrian'
				));
			}
		}

		public function activateNextQueue($antrianId,$antrianNomor,$loketId)
		{
			$antrianSelanjutnya = (int)$antrianNomor+1;
			$nextQueue  = parent::model('service')->get_next_queue($antrianSelanjutnya,$loketId);
			$dataEditCurrent = array('antrian_status'=>'selesai');
			$editCurrentQueue = parent::model('service')->edit_antrian($antrianId,$dataEditCurrent);

			if ($nextQueue!== null){

				if ($editCurrentQueue > 0){
					$editNextQueue = parent::model('service')->edit_antrian_by_number($antrianSelanjutnya,$loketId);

					return $editNextQueue > 0 ? true : false;
				}else{
					return false;
				}

			}else{
				return $editCurrentQueue > 0 ? true : false;
			}

		}

		/*
		 * set cookie for play audios and current queue indicator
		 * */
		public function setCookieData($nomorAntrian,$loketAktif,$day)
		{
			$day = time()+(86400*$day);
			if (!isset($_COOKIE['counter'])){
				setcookie('counter','1',$day,'/');
			}else{
				$currentCounter = get_cookie('counter');
				$counter = (int)$currentCounter;
				$counterValue = $counter+1;
				if ($counter > 10){
					setcookie('counter','1',$day,'/');
				}else{
					setcookie('counter',$counterValue,$day,'/');
				}
			}

			setcookie('loketAktif',$loketAktif,$day,'/');
			setcookie('antrian-'.$loketAktif,$nomorAntrian,$day,'/');
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
