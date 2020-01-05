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
		
		public function call($loket)
		{
			//antrian aktif
			$dataAntrianAaktif = $this->currentQueue($loket);
			$antrianAktif = array();
			$antrianAktif;
			// antrian status menunggu
			$dataSisaAntrian = $this->leftQueue($loket);
			$antrianMenunggu = $dataSisaAntrian->result_array();
			// antrian selanjutnya yang akan di aktifkan setiap perform

			if ($dataAntrianAaktif->row_array() !==null){
				$antrianAktif = $dataAntrianAaktif->row_array();
			}else{
				if (!empty($antrianMenunggu)){
					if ($this->activateFirstRow($antrianMenunggu[0]['antrian_id']) > 0){
						$antrianAktif = $this->currentQueue($loket)->row_array();
					}
				}else{
					$antrianAktif = null;
					echo json_encode(array(
						'status' => '500',
						'message' => 'tidak ada antrian pada loket atau antrian telah selesai'
					));
				}
			}

			if ($antrianAktif !== null){
				$this->updateCall(1,$antrianAktif,$loket);
			}else{
				echo json_encode(array(
					'status' => '500',
					'message' => 'tidak ada antrian pada loket atau antrian telah selesai'
				));
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

		public function activateFirstRow($firstRow)
		{
			$dataEdit = array('antrian_status' => 'aktif');
			return parent::model('service')->edit_antrian($firstRow,$dataEdit);
		}

		public function activateNextQueue($antrianId,$antrianNomor,$loketId)
		{
			$nextQueue = $this->getNextQueue($antrianNomor,$loketId);

			if ($nextQueue !== null){
				$dataEditCurrent = array('antrian_status'=>'selesai');
				$editCurrentQueue = parent::model('service')->edit_antrian($antrianId,$dataEditCurrent);
				if($editCurrentQueue > 0){
					return parent::model('service')->edit_antrian_by_number($antrianNomor,$loketId);
				}
			}else{
				return 0;
			}

			return 0;
		}

		public function updateCall($panggilanId,$antrianAktif,$loketId)
		{
			$dataPanggilan = array(
				'panggilan_antrian' => $antrianAktif['antrian_nomor'],
				'panggilan_loket' => $antrianAktif['antrian_loket_id'],
				'panggilan_updated' => date('Y-m-d H:i:s')
			);
			$updatePanggilan = parent::model('service')->update_panggilan($panggilanId,$dataPanggilan);
			if ($updatePanggilan > 0){
				$antrianSelanjutnya = $antrianAktif['antrian_nomor']+1;
				$this->activateNextQueue($antrianAktif['antrian_id'],$antrianSelanjutnya,$loketId);
				echo json_encode(array(
					'status' => '200',
					'data' => $antrianAktif,
					'nextQueue' => $antrianSelanjutnya,
					'message' => 'masalah saat mengubah data panggilan'
				));
			}else{
				echo json_encode(array(
					'status' => '500',
					'message' => 'masalah saat mengubah data panggilan'
				));
			}
		}

		// return row array
		public function getNextQueue($antrianNomor,$loketId)
		{
			$nextData = parent::model('service')->get_next_queue($antrianNomor, $loketId);
			return $nextData;
		}

		// return Panggilan Service API
		public function getCall()
		{
			$id = 1;
			$dataCall = parent::model('service')->get_call_by_id($id);

			echo json_encode(array(
				'status' => '200',
				'data' => $dataCall,
				'message' => 'menampilkan data panggilan'
			));
		}
	}
