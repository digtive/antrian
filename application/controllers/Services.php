<?php

	require __DIR__ . '/../../vendor/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
	use Mike42\Escpos\EscposImage;

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

			$switchedQueue  = parent::model('antrian')
				->get_switched_queue(array(
					'antrian_jenis_panggilan' => 'alihan',
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'menunggu'
				),'antrian_date_created','asc')->row_array();

			$activeQueue = $activeQueueObj->row_array();

			if ($activeQueue !== null){
				// jika antrian aktif tidak kosong
				if ($activeQueue['antrian_jenis_panggilan'] === 'terusan'){
					$nextQueue = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_nomor' => $activeQueue['antrian_nomor']+1,
						'antrian_jenis_panggilan' => 'terusan'
					))->row_array();
				}else{
					$completeQueueObj = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_status' => 'selesai',
						'antrian_jenis_panggilan' => 'terusan'
					));

					$lastCompleteQueue = $completeQueueObj->row_array();

					$nextQueue = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_nomor' => $lastCompleteQueue['antrian_nomor']+1,
						'antrian_jenis_panggilan' => 'terusan'
					))->row_array();
				}

				if ($nextQueue!==null){
					if ($switchedQueue !== null){
						$switchedQueueTime = strtotime($switchedQueue['antrian_date_created']);
						$nextQueueTime = strtotime($nextQueue['antrian_date_created']);

						if ($switchedQueueTime < $nextQueueTime){
							parent::model('service')->edit_antrian($switchedQueue['antrian_id'],array(
								'antrian_status' => 'aktif'
							));
						}else{
							parent::model('service')->edit_antrian($nextQueue['antrian_id'],array(
								'antrian_status' => 'aktif'
							));
						}
					}else{
						parent::model('service')->edit_antrian($nextQueue['antrian_id'],array(
							'antrian_status' => 'aktif'
						));
					}

				}else{
					if ($switchedQueue!==null){
						parent::model('service')->edit_antrian($switchedQueue['antrian_id'],array(
							'antrian_status' => 'aktif'
						));
					}
				}

				$this->setActiveQueueOutput($activeQueue,$locketId);

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
						'antrian_status' => 'selesai',
						'antrian_jenis_panggilan' => 'terusan'
					));

					$lastCompleteQueue = $completeQueueObj->row_array();

					$nextQueue = parent::model('antrian')->get_join_where(array(
						'layanan_id' => $serviceId,
						'antrian_nomor' => $lastCompleteQueue['antrian_nomor']+1,
						'antrian_jenis_panggilan' => 'terusan'
					))->row_array();

					$activeData = array();
					if ($nextQueue!==null && $switchedQueue!==null){
						$switchedQueueTime = strtotime($switchedQueue['antrian_date_created']);
						$nextQueueTime = strtotime($nextQueue['antrian_date_created']);
						if ($switchedQueueTime < $nextQueueTime){
							$activeData = $switchedQueue;
						}else{
							$activeData = $nextQueue;
						}
					}elseif ($nextQueue !==null){
						$activeData = $nextQueue;
					}elseif ($switchedQueue!== null){
						$activeData = $switchedQueue;
					}

					$this->setActiveQueueOutput($activeData,$locketId);

					$this->updateLocketTimeCalled($locketId);


				}else{
					// jika antrian menunggu kosong
					echo json_encode(array(
						'status' => '404',
						'antrian' => '000',
						'message'=>'belum ada antrian pada loket tersebut',
						'data' => array()
					));
				}
			}

		}

		public function recall($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));
			$serviceId = $locketData['loket_layanan_id'];
//			$completeQueueObj = parent::model('antrian')
//				->get_join_where(array(
//					'tbl_antrian.antrian_layanan_id'=>$serviceId,
//					'tbl_antrian.antrian_loket_id' => $locketId,
//					'antrian_status' => 'selesai'
//				));

			$completeQueueObj  = parent::model('antrian')
				->get_switched_queue(array(
					'tbl_antrian.antrian_layanan_id'=>$serviceId,
					'tbl_antrian.antrian_loket_id' => $locketId,
					'antrian_status' => 'selesai'
				),'antrian_date_created','desc');

			if ($completeQueueObj->num_rows() > 0)
			{
				$completeQueue = $completeQueueObj->row_array();
				if ($completeQueue['antrian_jenis_panggilan'] === 'alihan'){
					$dataPanggilan = array(
						'panggilan_jenis' => 'switchRecall',
						'recall_antrian' => $completeQueue['antrian_nomor'],
						'recall_loket' => $locketData['loket_nomor'],
						'switchcall_prefix' => $completeQueue['antrian_suara_alihan_prefix'],
						'switchcall_path' => $completeQueue['layanan_suara_nama'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
				}else{
					$dataPanggilan = array(
						'panggilan_jenis' => 'recall',
						'recall_antrian' => $completeQueue['antrian_nomor'],
						'recall_loket' => $locketData['loket_nomor'],
						'recall_prefix' => $completeQueue['layanan_awalan'],
						'recall_path' => $completeQueue['layanan_suara_awalan'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
				}

				$update = parent::model('service')->update_panggilan(1,$dataPanggilan);

				if ($update>0){
					echo json_encode(array(
						'status' => '200',
						'antrian' => ucwords($completeQueue['layanan_awalan']).'-'.str_pad($completeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
						'data' => $completeQueue,
						'update' => $update,
						'message' => 'menampilkan nomor recall yang terakhir kali dipanggil di loket '.$locketData['loket_nama']
					));
				}

			}else{
				echo json_encode(array(
					'status' => '200',
					'antrian' => str_pad(0, 3, '0', STR_PAD_LEFT),
					'data' => array(),
					'update' => 0,
					'message' => 'belum ada antrian pada loket '.$locketData['loket_nama']
				));
			}
		}

		/*-- API for switch to other service  --*/
		public function switchApi($serviceId)
		{
			if (isset($_POST)){
				$dataSwitch = array(
					'antrian_nomor' => parent::post('nomor'),
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'alihan',
					'antrian_nomor_alihan' => parent::post('text'),
					'antrian_suara_alihan_prefix' => parent::post('suara_awalan'),
					'antrian_suara_alihan' => parent::post('suara')
				);

				$switchDataValidation = parent::model('antrian')->get_join_where(array(
					'antrian_layanan_id' => $serviceId,
					'antrian_nomor_alihan' =>parent::post('text')
				))->row_array();


				if ($switchDataValidation !== null){
					echo json_encode(array(
						'status' => '500',
						'message' => 'antrian tersebut telah di alihkan ke layanan yang dituju'
					));
				}else{
					$insertQueue = parent::model('antrian')->post_antrian($dataSwitch);
					if ($insertQueue > 0){
						echo json_encode(array(
							'status' => '200',
							'message' => 'berhasil mengalihkan antrian ke layanan lain'
						));
					}
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
			$serviceData = parent::model('layanan')->get_layanan_where(array(
				'layanan_id' => $serviceId
			))->row_array();

			$completeQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_loket_id' => $locketId,
				'antrian_status' => 'selesai'
			));
			$switchedQueue  = parent::model('antrian')
				->get_switched_queue(array(
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'selesai'
				),'antrian_date_created','desc');


			if ($switchedQueue->num_rows() > 0){
				$complete = $switchedQueue->row_array();
				echo json_encode(array(
					'status' => '200',
					'message' => 'antrian yang baru saja di panggil',
					'antrian' => $complete['antrian_nomor_aktif']
				));
			}else{
				echo json_encode(array(
					'status' => '200',
					'message' => 'belum ada antrian dipanggil',
					'antrian' => $serviceData['layanan_awalan'].'-000'
				));
			}

		}

		/*
		 * menghitung sisa antrian berdasarkan id loket dan status antrian
		 * */
		public function leftQueue($locketId)
		{
			$locketData = parent::model('loket')->getOne(array(
				'loket_id' => $locketId
			));
			$serviceId = $locketData['loket_layanan_id'];
			$activeQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status' => 'aktif'
			));

			$leftQueue = parent::model('antrian')->get_join_where(array(
				'antrian_layanan_id' => $serviceId,
				'antrian_status' => 'menunggu'
			));

			if ($leftQueue->num_rows() > 0){
				$sisaAntrian = $activeQueue->num_rows()+$leftQueue->num_rows();
			}else{
				$sisaAntrian = $activeQueue->num_rows();
			}

			echo json_encode(array(
				'status' => '200',
				'sisa_antrian' => $sisaAntrian,
				'message' => 'menampilkan sisa antrian pada layanan'
			));
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
			$switchedQueue  = parent::model('antrian')
				->get_switched_queue(array(
					'antrian_jenis_panggilan' => 'alihan',
					'antrian_layanan_id' => $serviceId,
					'antrian_status' => 'menunggu'
				),'antrian_date_created','desc')->row_array();

			if ($currentData->num_rows() > 0){
				$waitQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'menunggu',
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'terusan'
				));
				$activeQueue = parent::model('antrian')->get_join_where(array(
					'antrian_status' => 'aktif',
					'antrian_layanan_id' => $serviceId,
					'antrian_jenis_panggilan' => 'terusan'
				));

				$serviceQueue = $currentData->result_array();
				$total  = count($serviceQueue);
				$lastQueue = $serviceQueue[$total-1];

				// memeriksa antrian selanjutnya/menunggu
				if ($waitQueue->num_rows() <= 0) {
					if ($activeQueue->num_rows() > 0) {
						$dataQueue = array(
							'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
							'antrian_layanan_id' => $lastQueue['layanan_id'],
							'antrian_status' => 'menunggu'
						);
					} else {
						if ($switchedQueue!==null){
							// jika antrian aktif tidak ada
							$dataQueue = array(
								'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
								'antrian_layanan_id' => $lastQueue['layanan_id'],
								'antrian_status' => 'menunggu'
							);
						}else{
							// jika antrian aktif tidak ada
							$dataQueue = array(
								'antrian_nomor' => ($lastQueue['antrian_nomor'] + 1),
								'antrian_layanan_id' => $lastQueue['layanan_id'],
								'antrian_status' => 'aktif'
							);
						}

					}
				} else {
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
				if ($switchedQueue!==null){
					$dataQueue = array(
						'antrian_nomor' => 1,
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'menunggu'
					);
				}else{
					$dataQueue = array(
						'antrian_nomor' => 1,
						'antrian_layanan_id' => $serviceId,
						'antrian_status' => 'aktif'
					);
				}


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

		public function setActiveQueueOutput($activeQueue,$locketId)
		{
			if ($activeQueue['antrian_jenis_panggilan'] === 'terusan'){
				$format = ucwords($activeQueue['layanan_awalan']).'-'.str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT);
			}else{
				$format = $activeQueue['antrian_nomor_alihan'];
			}
			$update = parent::model('service')->edit_antrian($activeQueue['antrian_id'],array(
				'antrian_status' => 'selesai',
				'antrian_loket_id' => $locketId,
				'antrian_nomor_aktif' => $format
			));

			if ($activeQueue['antrian_jenis_panggilan'] === 'terusan'){
				$jenis = 'call';
			}else{
				$jenis = 'switch';
			}

			if ($update > 0){

				if ($activeQueue['antrian_jenis_panggilan'] === 'alihan'){
					$dataPanggilan = array(
						'panggilan_jenis' => $jenis,
						'panggilan_antrian' => $activeQueue['antrian_nomor'],
						'panggilan_loket' => $locketId,
						'call_prefix' => $activeQueue['layanan_awalan'],
						'switchcall_prefix' => $activeQueue['antrian_suara_alihan_prefix'],
						'switchcall_path' => $activeQueue['antrian_suara_alihan'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
				}else{
					$dataPanggilan = array(
						'panggilan_jenis' => $jenis,
						'panggilan_antrian' => $activeQueue['antrian_nomor'],
						'panggilan_loket' => $locketId,
						'call_prefix' => $activeQueue['layanan_awalan'],
						'panggilan_updated' => date('Y-m-d H:i:s')
					);
				}

				// update tabel panggilan realtime
				parent::model('service')->update_panggilan(1,$dataPanggilan);

				echo json_encode(array(
					'status' => '200',
					'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT),
					'data' => $activeQueue,
					'message' => 'menampilkan antrian yang sedang dipanggil'
				));
			}
		}

		public function receiptPrint()
		{
			if (isset($_POST)){
				$queueNumber = parent::post('queue_number');
				$serviceName = parent::post('service_name');
				$leftQueue = parent::post('left_queue');

				$connector = new FilePrintConnector("php://stdout");
				$printer = new Printer($connector);

				/* Initialize */
				$printer -> initialize();

				/* Line feeds */
				$printer -> text($serviceName);
				$printer -> feed(7);
				$printer -> text($queueNumber);
				$printer -> feedReverse(3);
				$printer -> text("Sisa Antrian : ".$leftQueue);
				$printer -> feed();
				$printer -> cut();

				redirect('layanan/daftar');
			}
		}

		/*
		 * APIs
		 * */

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
