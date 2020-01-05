<?php
	
	class ServiceModel extends  GLOBAL_Model
	{

		public function __construct()
		{
			parent::__construct();
		}

		/*
		 * menghitung sisa antrian
		 * */
		public function get_left_queue($loketId)
		{
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('tbl_antrian.antrian_loket_id', $loketId);
			$this->db->where('antrian_status', 'menunggu');
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->join('tbl_loket', 'tbl_loket.loket_id = tbl_antrian.antrian_loket_id');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor', 'asc');
			$query = $this->db->get();
			return $query;
		}

		/*
		 * mencari antrian yang sedang aktif pada loket tertentu
		 * */
		public function get_current_queue($loketId)
		{
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('tbl_antrian.antrian_loket_id', $loketId);
			$this->db->where('antrian_status', 'aktif');
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->join('tbl_loket', 'tbl_loket.loket_id = tbl_antrian.antrian_loket_id');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor', 'asc');
			$query = $this->db->get();
			return $query;
		}

		/*
		 * get data antrian by loket ID
		 * */
		public function get_antrian_by_loket($loketID)
		{
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('tbl_antrian.antrian_loket_id', $loketID);
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->join('tbl_loket', 'tbl_loket.loket_id = tbl_antrian.antrian_loket_id');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor', 'asc');
			$query = $this->db->get();
			return $query;
		}

		/*
		 * get data antrian setelah antrian terbaru
		 * */
		public function get_next_queue($antrianNomor, $loketId)
		{
			$this->db->select('*');
			$this->db->from('tbl_antrian');
			$this->db->where('tbl_antrian.antrian_loket_id', $loketId);
			$this->db->where('tbl_antrian.antrian_nomor', $antrianNomor);
			$this->db->where('date_format(antrian_date_created,"%Y-%m-%d")', date('Y-m-d'));
			$this->db->join('tbl_loket', 'tbl_loket.loket_id = tbl_antrian.antrian_loket_id');
			$this->db->join('tbl_layanan', 'tbl_layanan.layanan_id = tbl_antrian.antrian_layanan_id');
			$this->db->order_by('antrian_nomor', 'asc');
			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_call_by_id($id)
		{
			$query = array('panggilan_id',$id);
			$call = parent::get_object_of_row('tbl_panggilan',$query);
			return $call->row_array();
		}

		/*
		 * dinamis edit data kolom antrian berdasarkan id
		 * */
		public function edit_antrian($antrianId,$dataEdit){
			return parent::update_table_with_status('tbl_antrian','antrian_id',$antrianId,$dataEdit);
		}

		/*
		 * dinamis edit antrian berdasarkan query
		 * */
		public function query_edit_antrian($key,$value,$data)
		{
			return parent::update_table_with_status('tbl_antrian',$key,$value,$data);
		}

		/*
		 * edit spesific
		 * */
		public function edit_antrian_by_number($antrianSelanjutnya,$loketId)
		{
			$data = array(
				'antrian_status' => 'aktif'
			);
			parent::_ODB()->where('antrian_loket_id',$loketId);
			parent::_ODB()->where('antrian_nomor',$antrianSelanjutnya);
			parent::_ODB()->update('tbl_antrian',$data);
			return parent::_ODB()->affected_rows();
		}

		public function update_panggilan($panggilanId,$dataPanggilan)
		{
			return parent::update_table_with_status('tbl_panggilan','panggilan_id',$panggilanId,$dataPanggilan);
		}
    }
