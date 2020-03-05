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
			$this->load->model('ComponentModel','component');
		}

		public function queue()
		{
			$queueData = parent::model('antrian')->get_loket()->result_array();

			echo json_encode(array(
				'data' => $queueData,
				'status'=> '200',
				'message'=> 'menampilkan data seluruh loket yang tersedia'
			));
		}

		public function call($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));
			$serviceId = $locketData['loket_layanan_id'];
			$activeQueueObj = parent::model('antrian')
				->get_join_where(array(
					'tbl_antrian.antrian_layanan_id'=>$serviceId,
					'antrian_status' => 'aktif'
				));

			$activeQueue = $activeQueueObj->row_array();
			if ($activeQueue !== null){
				// jika antrian aktif tidak kosong
				$nextQueue = parent::model('antrian')->get_join_where(array(
					'layanan_id' => $serviceId,
					'antrian_nomor' => $activeQueue['antrian_nomor']+1
				))->row_array();

				if ($nextQueue!==null){
					parent::model('service')->edit_antrian($nextQueue['antrian_id'],array(
						'antrian_status' => 'aktif'
					));
				}

				$update = parent::model('service')->edit_antrian($activeQueue['antrian_id'],array(
					'antrian_status' => 'selesai'
				));

				if ($update > 0){
					$dataPanggilan = array(
						'panggilan_jenis' => 'call',
						'panggilan_antrian' => $activeQueue['antrian_nomor'],
						'panggilan_loket' => $locketData['loket_id'],
						'call_prefix' => $activeQueue['layanan_awalan'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
					// update tabel panggilan realtime
					parent::model('service')->update_panggilan(1,$dataPanggilan);
					echo json_encode(array(
						'status' => '200',
						'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $activeQueue,
						'message' => 'tidak ada antrian selanjutnya'
					));
				}

				$this->updateLocketTimeCalled($locketId);
			}else{
				// jika antrian aktif kosong
				$waitQueueObj = parent::model('antrian')->get_join_where(array(
					'layanan_id' => $serviceId,
					'antrian_status' => 'menunggu'
				));

				if ($waitQueueObj->row_array() !== null){
					// jika antrian menunggu tidak kosong
					$completeQueueObj = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_status' => 'selesai'
					));

					$lastCompleteQueue = $completeQueueObj->row_array();

					$nextQueue = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_nomor' => $lastCompleteQueue['antrian_nomor']+1
					))->row_array();

					$update = parent::model('service')->edit_antrian($nextQueue['antrian_id'],array(
						'antrian_status' => 'aktif'
					));

					if ($update > 0){
						echo json_encode(array(
							'status' => '200',
							'antrian' => str_pad($nextQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
							'data' => $nextQueue,
							'message' => 'mengubah antrian yang baru ditambah'
						));
					}

				}else{
					// jika antrian menunggu kosong
					echo json_encode(array(
						'status' => '404',
						'message'=>'belum ada antrian pada loket tersebut',
						'data' => array()
					));
				}

			}
		}

		public function callTo($locketId)
		{
			$activeQueue = $this->currentQueue($locketId)->row_array();
			if ($activeQueue!==null){
				// jika antrian aktif ada di loket
				// antrian dengan nomor selanjutnya
				$nextQueue = $this->getNextQueue($activeQueue['antrian_nomor']+1,$locketId);
				if ($nextQueue !== null){
					// jika antrian selanjutnya tidak kosong
					echo json_encode(array(
						'status' => '200',
						'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $activeQueue,
						'message' => 'mengaktifkan antrian selanjutnya'
					));
					parent::model('service')->edit_antrian($activeQueue['antrian_id'],array('antrian_status' => 'selesai'));
					$dataPanggilan = array(
						'panggilan_jenis' => 'call',
						'panggilan_antrian' => $activeQueue['antrian_nomor'],
						'panggilan_loket' => $activeQueue['loket_nomor'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
					parent::model('service')->update_panggilan(1,$dataPanggilan);

					parent::model('service')->edit_antrian($nextQueue['antrian_id'],array('antrian_status' => 'aktif'));
				}else{
					// jika antrian selanjutnya tidak ada
					parent::model('service')->edit_antrian($activeQueue['antrian_id'],array('antrian_status' => 'selesai'));
					$dataPanggilan = array(
						'panggilan_jenis' => 'call',
						'panggilan_antrian' => $activeQueue['antrian_nomor'],
						'panggilan_loket' => $activeQueue['loket_nomor'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
					// update tabel panggilan realtime
					parent::model('service')->update_panggilan(1,$dataPanggilan);
					echo json_encode(array(
						'status' => '200',
						'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $activeQueue,
						'message' => 'tidak ada antrian selanjutnya'
					));

				}
				$this->updateLocketTimeCalled($locketId);
			}else{
				// jika antrian aktif kosong
				$waitQueue = $this->leftQueue($locketId)->row_array();
				if ($waitQueue !== null){
					$completeQueue = parent::model('service')->get_complete_queue($locketId);
					$lastCompleteQueue = $completeQueue->row_array();
					$nextQueue = $this->getNextQueue($lastCompleteQueue['antrian_nomor']+1,$locketId);
					parent::model('service')->edit_antrian($nextQueue['antrian_id'],array('antrian_status' => 'aktif'));
					echo json_encode(array(
						'status' => '200',
						'antrian' => str_pad($nextQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $nextQueue,
						'message' => 'mengubah antrian yang baru ditambah'
					));
				}else{
					echo json_encode(array(
						'status' => '404',
						'message'=>'belum ada antrian pada loket tersebut'
					));
				}

			}

		}

		public function recallTo($locketId)
		{
			$queue = parent::model('service')->get_queue_by_locket($locketId);
			if ($queue->num_rows() > 0){
				$activeQueue = $this->currentQueue($locketId)->row_array();
				if ($activeQueue!== null){
					$antrianSelesai = parent::model('service')->get_complete_queue($locketId);
					$recall = $antrianSelesai->row_array();
					if ($antrianSelesai->num_rows() > 0){
						$dataPanggilan = array(
							'panggilan_jenis' => 'recall',
							'recall_antrian' => $recall['antrian_nomor'],
							'recall_loket' => $recall['loket_nomor'],
							'panggilan_updated' => date('Y-m-d H:i:s')
						);
						$update = parent::model('service')->update_panggilan(1,$dataPanggilan);

						echo json_encode(array(
							'status' => '200',
							'antrian' => str_pad($recall['antrian_nomor'], 3, '0', STR_PAD_LEFT),
							'data' => $recall,
							'update' => $update,
							'message' => 'menampilkan nomor recall yang terakhir kali dipanggil sebelum aktif '.$locketId
						));
					}else{
						$dataPanggilan = array(
							'panggilan_jenis' => 'recall',
							'recall_antrian' => $activeQueue['antrian_nomor'],
							'recall_loket' => $activeQueue['loket_nomor'],
							'panggilan_updated' => date('Y-m-d H:i:s')
						);
						$update = parent::model('service')->update_panggilan(1,$dataPanggilan);
						echo json_encode(array(
							'status' => '200',
							'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
							'data' => $activeQueue,
							'update' => $update,
							'message' => 'menampilkan recall untuk antrian pertama kali untuk loket '.$locketId
						));
					}
				}else{
					$antrianSelesai = parent::model('service')->get_complete_queue($locketId);
					$recall = $antrianSelesai->row_array();
					$dataPanggilan = array(
						'panggilan_jenis' => 'recall',
						'recall_antrian' => $recall['antrian_nomor'],
						'recall_loket' => $recall['loket_nomor'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
					$update = parent::model('service')->update_panggilan(1,$dataPanggilan);
					echo json_encode(array(
						'status' => '200',
						'antrian' => str_pad($recall['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $recall,
						'update' => $update,
						'message' => 'menampilkan nomor recall untuk loket '.$locketId
					));
				}
			}else{
				echo json_encode(array(
					'status' => '200',
					'antrian' => str_pad(0, 3, '0', STR_PAD_LEFT),
					'data' => array(),
					'update' => 0,
					'message' => 'belum ada antrian pada loket '.$locketId
				));
			}

		}


		/*
		 * mencari antrian yang sedang aktif
		 * */
		public function currentQueue($loketId)
		{
			$currentData = parent::model('service')->get_current_queue($loketId);
			$data = $currentData->row_array();
			$number = str_pad($data['antrian_nomor'], 3, '0', STR_PAD_LEFT);

			return $currentData;
		}

		/*
		 * get number active queue
		 * */
		public function activeNumber($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));
			$serviceId = $locketData['loket_layanan_id'];
			$completeQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status' => 'selesai'
			));

			if ($completeQueue->num_rows() > 0){
				$complete = $completeQueue->row_array();
				$format = str_pad($complete['antrian_nomor'], 3, '0', STR_PAD_LEFT);
				echo json_encode(array(
					'status' => '200',
					'message' => 'antrian yang baru saja di panggil',
					'antrian' => ucwords($complete['layanan_awalan']).'-'.$format
				));
			}else{
				echo json_encode(array(
					'status' => '200',
					'message' => 'belum ada antrian dipanggil',
					'antrian' => 'L'.$serviceId.'-000'
				));
			}

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
				'panggilan_loket' => $antrianAktif['loket_nomor'],
				'panggilan_updated' => date('Y-m-d H:i:s')
			);
			$updatePanggilan = parent::model('service')->update_panggilan($panggilanId,$dataPanggilan);
			if ($updatePanggilan > 0){
				$antrianSelanjutnya = $antrianAktif['antrian_nomor']+1;

				$dataAntrianSelanjutnya = $this->getNextQueue($antrianSelanjutnya,$loketId);

				if ($dataAntrianSelanjutnya !== null){
					$nextQueue = $dataAntrianSelanjutnya;
				}else{
					$nextQueue = array();
				}
				$this->activateNextQueue($antrianAktif['antrian_id'],$antrianSelanjutnya,$loketId);
				echo json_encode(array(
					'status' => '200',
					'data' => $antrianAktif,
					'nextQueue' => $nextQueue,
					'message' => 'berhasil mengubah data panggilan'
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
			$dataCall = parent::model('service')->get_call_by_id(1);
			$number = str_pad($dataCall['panggilan_antrian'], 3, '0', STR_PAD_LEFT);

//			array_push($dataCall,'L'.$dataCall['panggilan_loket'].'-'.$number);
			echo json_encode(array(
				'status' => '200',
				'data' => $dataCall,
				'message' => 'menampilkan data panggilan',
			));
		}

		// menambah antrian per loket
		public function takeQueue($serviceId){
			$currentData = parent::model('service')->get_queue_by_service($serviceId);

			if ($currentData->num_rows() > 0){
				$waitQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'menunggu',
					'antrian_layanan_id' => $serviceId
				));
				$activeQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'aktif',
					'antrian_layanan_id' => $serviceId
				));
				$serviceQueue = $currentData->result_array();
				$total  = count($serviceQueue);
				$lastQueue = $serviceQueue[$total-1];

				// memeriksa antrian selanjutnya/menunggu
				if ($waitQueue->num_rows() <= 0) {
					// jika antrian selanjutnya tidak kosong
						//memeriksa apakah antrian aktif ada ?
					if ($activeQueue->num_rows() > 0) {
						// jika antrian aktif sudah ada
						$dataQueue = array(
							'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
							'antrian_layanan_id' => $lastQueue['layanan_id'],
							'antrian_status' => 'menunggu'
						);
					} else {
						// jika antrian aktif tidak ada
						$dataQueue = array(
							'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
							'antrian_layanan_id' => $lastQueue['layanan_id'],
							'antrian_status' => 'aktif'
						);
					}
				} else {
					// jika antrian selanjutnya kosong jadikan antrian yang baru masuk berstatus menunggu
					$dataQueue = array(
						'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
						'antrian_layanan_id' => $lastQueue['layanan_id'],
						'antrian_status' => 'menunggu'
					);
				}

				$insertQueue = parent::model('antrian')->post_antrian($dataQueue);

				if ($insertQueue > 0){
					$queueNumber = str_pad($dataQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
					$freshWaitQueue = parent::model('antrian')->get_join_where(array(
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					));
					echo json_encode(array(
						'status' => '200',
						'message' => 'berhasil mengambil antrian, silahkan menunggu',
						'antrian_nomor' => ucwords($lastQueue['layanan_awalan']).'-'.$queueNumber,
						'service_name' => $lastQueue['layanan_nama'],
						'left_queue' => $freshWaitQueue->num_rows()
					));
				}else{
					echo json_encode(array(
						'status' => '500',
						'message' => 'kesalahan operasi mengambil antrian',
						'antrian_nomor' => 0
					));
				}
			}else{
				// jika antrian berdasarkan layanan pada DB kosong
				$dataQueue = array(
					'antrian_nomor' => 1,
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'aktif'
				);

				$insertQueue = parent::model('antrian')->post_antrian($dataQueue);
				// jika berhasil insert antrian aktif pertama
				if ($insertQueue > 0){
					$queueNumber = str_pad($dataQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
					$freshLocket = parent::model('layanan')->getOne(array('layanan_id' => $serviceId));
					$freshWaitQueue = parent::model('antrian')->get_join_where(array(
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					));
					echo json_encode(array(
						'status' => '200',
						'message' => 'berhasil mengambil antrian, silahkan menunggu',
						'antrian_nomor' => ucwords($freshLocket['layanan_awalan']).'-'.$queueNumber,
						'service_name' => $freshLocket['layanan_nama'],
						'left_queue' => $freshWaitQueue->num_rows()
					));
				}else{
					echo json_encode(array(
						'status' => '500',
						'message' => 'kesalahan operasi mengambil antrian',
						'antrian_nomor' => 0
					));
				}

			}
		}

		public function execKeyboard($key){
			$query = array(
				'app_id' => get_cookie('user_app')
			);
			$data['keyboard']  = parent::model('component')->get_keyboard_setting($query);
			$keylist = json_decode($data['keyboard']['setting_tombol'],true);
			$shortCut = array();

			foreach ($keylist as $item => $v) {
				if ($keylist[$item]['key']===$key){
						$shortCut['type'] = $keylist[$item]['type'];
						$shortCut['key'] = $keylist[$item]['key'];
						$shortCut['url'] = base_url().$keylist[$item]['url'];
						$shortCut['status'] = '200';
						$shortCut['message'] = 'berhasil menemukan shortcut';
				}
			}

			if (!empty($shortCut) && $shortCut !== null){
				echo json_encode($shortCut);
			}else{
				echo json_encode(array(
					'status' => '404',
					'message' => 'tidak dapat menemukan shortcut'
				));
			}
		}

		public function updateLocketTimeCalled($id)
		{
			$data = array(
				'loket_waktu_panggilan' =>  date('Y-m-d H:i:s')
			);
			return parent::model('loket')->editloket($id,$data);
		}

		public function loket($locketId){
			$param = array(
				'loket_id' => $locketId
			);
			$loket = parent::model('loket')->getOne($param);
			echo json_encode(array(
				'status' => '200',
				'data' => $loket,
				'message' => 'menampilkan loket per id'
			));
		}

		public function layananApi($id = null){
			if ($id!== null){
				$locket = parent::model('layanan')->get_layanan_where(array(
					'layanan_id' =>  $id
				))->row_array();
			}elseif (isset($_GET)){
				$query  = array();
				foreach ($_GET as $key => $v){
					$query[$key] = $v;
				}
				$locket = parent::model('layanan')->get_layanan_where($query)->result_array();
			}else{
				$locket = parent::model('layanan')->get_layanan()->result_array();
			}

			echo json_encode(array(
				'status' => '200',
				'message' => 'menampilkan hasil request',
				'data' => $locket
			));
		}

		public function suaraApi($id = null){
			if ($id!== null){
				$locket = parent::model('service')->get_suara_where(array(
					'suara_id' =>  $id
				))->row_array();
			}elseif (isset($_GET)){
				$query  = array();
				foreach ($_GET as $key => $v){
					$query[$key] = $v;
				}
				$locket = parent::model('service')->get_suara_where($query)->result_array();
			}else{
				$locket = parent::model('service')->get_suara();
			}

			echo json_encode(array(
				'status' => '200',
				'message' => 'menampilkan hasil request',
				'data' => $locket
			));
		}

	}
