<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class PendaftarController extends GLOBAL_Controller {
		
		public function __construct()
		{
			parent::__construct();
			if (!parent::hasLogin())
			{
				redirect(site_url());
			}else
			{
				$this->load->model('PendaftarModel');
			}
		}
		
		public function index()
		{
			$data['title'] = 'Data Seluruh Pendaftar';
			$data['page_title'] = 'Data Pendaftar Administrasi Pernikahan';
			$data['menu'] = 'sidebar-icon-only';
			
			$data['pendaftar'] = parent::model('PendaftarModel')->get_pendaftar();
			
			parent::template('pendaftar/index',$data);
		}
		
		public function detail($pendaftar)
		{
			if (!empty($pendaftar)){
				$data['pendaftar'] = parent::model('PendaftarModel')->get_single_pendaftar($pendaftar);
				$data['detail']    = parent::model('PendaftarModel')->get_single_detail($pendaftar);
				$data['berkas']    = parent::model('PendaftarModel')->get_single_dokumen($pendaftar);
				
				if ($data['berkas'] !== null){
					$data['berkas'] = $data['berkas'];
				}else{
					$data['berkas'] = array();
				}
				
				if(!empty($data['detail'])){
					$data['ayah']      = json_decode($data['detail']['detail_ayah'], true);
					$data['ibu']       = json_decode($data['detail']['detail_ibu'], true);
					$data['istri']     = json_decode($data['detail']['detail_istri'], true);
					$data['ayahIstri'] = json_decode($data['detail']['detail_ayah_istri'], true);
					$data['ibuIstri']  = json_decode($data['detail']['detail_ibu_istri'], true);
				}else{
					$data['detail'] = array();
				}
				
//				parent::cek_type($data['detail']);
				$data['title'] = $data['pendaftar']['pendaftar_nama'];
				$data['page_title'] = '';
				$data['menu'] = 'sidebar-icon-only';
				
				parent::template('pendaftar/detail',$data);
			}else{
				show_404();
			}
		}
		
		public function tambah()
		{
			$data['title'] = 'Tambah Data Pendaftar';
			$data['page_title'] = 'Tambah Data Pendaftar Pernikahan';
			$data['menu'] = '';
			
			parent::template('pendaftar/tambah',$data);
		}
		
		public function add()
		{
			if (isset($_POST['tambah'])){
				$pendaftar = array(
					'pendaftar_nama'	=> parent::post('nama'),
					'pendaftar_tempat_lahir' => parent::post('tempat-lahir'),
					'pendaftar_tgl_lahir'   => parent::post('tgl-lahir'),
					'pendaftar_nik'     => parent::post('nik'),
					'pendaftar_kewarganegaraan' => parent::post('kewarganegaraan'),
					'pendaftar_agama'   => parent::post('agama'),
					'pendaftar_pekerjaan'   => parent::post('pekerjaan'),
					'pendaftar_pendidikan'  => parent::post('pendidikan'),
					'pendaftar_alamat'      => parent::post('alamat')
				);
				
				$insert = $this->PendaftarModel->add_pendaftar($pendaftar);
				if ($insert > 0){
					parent::alert('alert','insert');
					redirect('pendaftar');
				}else{
					parent::alert('alert','error');
					redirect('pendaftar/tambah');
				}
				
			}else{
				show_404();
			}
		}
		
		public function ubah($pendaftar)
		{
			if (!empty($pendaftar)){
				$data['pendaftar'] = parent::model('PendaftarModel')->get_single_pendaftar($pendaftar);
				
				$data['title'] = 'Ubah Data Pendaftar '.$data['pendaftar']['pendaftar_nama'];
				$data['page_title'] = 'Ubah Data Pendaftar '.$data['pendaftar']['pendaftar_nama'];
				$data['menu'] = '';
				
				parent::template('pendaftar/ubah',$data);
			}else{
				show_404();
			}
		}
		
		public function update($pendaftar)
		{
			if (isset($_POST['ubah'])){
				if (!empty($pendaftar)){
					$dataPendaftar = array(
						'pendaftar_nama'	=> parent::post('nama'),
						'pendaftar_tempat_lahir' => parent::post('tempat-lahir'),
						'pendaftar_tgl_lahir'   => parent::post('tgl-lahir'),
						'pendaftar_nik'     => parent::post('nik'),
						'pendaftar_kewarganegaraan' => parent::post('kewarganegaraan'),
						'pendaftar_agama'   => parent::post('agama'),
						'pendaftar_pekerjaan'   => parent::post('pekerjaan'),
						'pendaftar_pendidikan'  => parent::post('pendidikan'),
						'pendaftar_alamat'      => parent::post('alamat')
					);
					
					$update = parent::model('PendaftarModel')->ubah_pendaftar($pendaftar,$dataPendaftar);
					
					if ($update > 0){
						parent::alert('alert','update');
						redirect('pendaftar');
					}else{
						parent::alert('alert','error');
						redirect('pendaftar/ubah/'.$idPendaftar);
					}
				}else{
					show_404();
				}
			}else{
				show_404();
			}
		}
		
		public function hapus($pendaftar)
		{
			if (!empty($pendaftar)){
				$deleteStatus = parent::model('PendaftarModel')->delete_pendaftar($pendaftar);
				if ($deleteStatus > 0){
					parent::alert('alert','delete');
					redirect('pendaftar');
				}else{
					parent::alert('alert','error');
					redirect('pendaftar');
				}
			}else{
				show_404();
			}
		}
		
		public function kelengkapan($pendaftar)
		{
			if (!empty($pendaftar)){
				$data['pendaftar'] = parent::model('PendaftarModel')->get_single_pendaftar($pendaftar);
				
				$data['title'] = 'Kelengkapan '.$data['pendaftar']['pendaftar_nama'];
				$data['page_title'] = 'Lengkapi data '.$data['pendaftar']['pendaftar_nama'];
				$data['menu'] = '';
				
				parent::template('pendaftar/kelengkapan',$data);
			}else{
				show_404();
			}
		}
		
		public function tambahKelengkapan()
		{
			if (isset($_POST['lengkapi'])){
				$id_pendaftar     = parent::post('id-pendaftar');
				
				$detail_ayah = array(
					'nama' => parent::post('nama-ayah'),
					'tempat_lahir' => parent::post('tempat-lahir-ayah'),
					'tgl_lahir' => parent::post('tgl-lahir-ayah'),
					'nik'   => parent::post('nik-ayah'),
					'kewarganegaraan' => parent::post('kewarganegaraan-ayah'),
					'agama' => parent::post('agama-ayah'),
					'pekerjaan' => parent::post('pekerjaan-ayah'),
					'pendidikan' => parent::post('pendidikan-ayah'),
					'alamat' => parent::post('alamat-ayah')
				);
				$detail_ibu = array(
					'nama' => parent::post('nama-ibu'),
					'tempat_lahir' => parent::post('tempat-lahir-ibu'),
					'tgl_lahir' => parent::post('tgl-lahir-ibu'),
					'nik'   => parent::post('nik-ibu'),
					'kewarganegaraan' => parent::post('kewarganegaraan-ibu'),
					'agama' => parent::post('agama-ibu'),
					'pekerjaan' => parent::post('pekerjaan-ibu'),
					'pendidikan' => parent::post('pendidikan-ibu'),
					'alamat' => parent::post('alamat-ibu')
				);
				$detail_istri = array(
					'nama' => parent::post('nama-istri'),
					'tempat_lahir' => parent::post('tempat-lahir-istri'),
					'tgl_lahir' => parent::post('tgl-lahir-istri'),
					'nik'   => parent::post('nik-istri'),
					'kewarganegaraan' => parent::post('kewarganegaraan-istri'),
					'agama' => parent::post('agama-istri'),
					'pekerjaan' => parent::post('pekerjaan-istri'),
					'pendidikan' => parent::post('pendidikan-istri'),
					'alamat' => parent::post('alamat-istri')
				);
				$detail_ayah_istri = array(
					'nama' => parent::post('nama-ayah-istri'),
					'tempat_lahir' => parent::post('tempat-lahir-ayah-istri'),
					'tgl_lahir' => parent::post('tgl-lahir-ayah-istri'),
					'nik'   => parent::post('nik-ayah-istri'),
					'kewarganegaraan' => parent::post('kewarganegaraan-ayah-istri'),
					'agama' => parent::post('agama-ayah-istri'),
					'pekerjaan' => parent::post('pekerjaan-ayah-istri'),
					'pendidikan' => parent::post('pendidikan-ayah-istri'),
					'alamat' => parent::post('alamat-ayah-istri')
				);
				$detail_ibu_istri = array(
					'nama' => parent::post('nama-ibu-istri'),
					'tempat_lahir' => parent::post('tempat-lahir-ibu-istri'),
					'tgl_lahir' => parent::post('tgl-lahir-ibu-istri'),
					'nik'   => parent::post('nik-ibu-istri'),
					'kewarganegaraan' => parent::post('kewarganegaraan-ibu-istri'),
					'agama' => parent::post('agama-ibu-istri'),
					'pekerjaan' => parent::post('pekerjaan-ibu-istri'),
					'pendidikan' => parent::post('pendidikan-ibu-istri'),
					'alamat' => parent::post('alamat-ibu-istri')
				);
				
				$detail_pendaftar = array(
					'detail_ayah' => json_encode($detail_ayah),
					'detail_ibu'    => json_encode($detail_ibu),
					'detail_istri'  => json_encode($detail_istri),
					'detail_ayah_istri' => json_encode($detail_ayah_istri),
					'detail_ibu_istri' => json_encode($detail_ibu_istri),
					'pendaftar_id' => $id_pendaftar
				);
				
				$insertion = parent::model('PendaftarModel')->insert_detail_pendaftar($detail_pendaftar);
				
				if ($insertion > 0)
				{
					parent::alert('alert','insert');
					redirect('pendaftar/detail/'.$id_pendaftar);
				}else{
					parent::alert('alert','error');
					redirect('pendaftar/kelengkapan/'.$id_pendaftar);
				}
				
			}else{
				show_404();
			}
		}
		
		public function berkas()
		{
			$data['title'] = 'Kelengkapan Berkas Pendaftar';
			$data['page_title'] = '';
			$data['menu'] = '';
			
			$data['pendaftars'] = parent::model('PendaftarModel')->get_pendaftar();
			
			if (isset($_GET['cariPendaftar'])){
				$id_pendaftar = parent::get('pendaftar');
				$data['pendaftar'] = parent::model('PendaftarModel')->get_single_pendaftar($id_pendaftar);
			}else{
				$data['pendaftar'] = array();
			}
			
			parent::template('pendaftar/berkas',$data);
		}
		
		public function syarat()
		{
			$data['title'] = 'Kelengkapan Berkas Pendaftar';
			$data['page_title'] = '';
			$data['menu'] = '';
			$data['pendaftars'] = parent::model('PendaftarModel')->get_pendaftar();
			
			if (isset($_GET['syarat'])){
				$pendaftarID = parent::get('syarat');
				$dokumenPendaftar = parent::model('PendaftarModel')->get_single_dokumen($pendaftarID);
				$arrayDokumen = json_decode($dokumenPendaftar['dokumen_data'],true);
//				parent::cek_array($arrayDokumen);
				if ($dokumenPendaftar !==  null){
					$data['dokumen'] = $arrayDokumen;
					$data['berkas']  = $dokumenPendaftar;
				}else{
					$data['dokumen'] = array();
				}
				$data['pendaftar'] = parent::model('PendaftarModel')->get_single_pendaftar($pendaftarID);
			}else{
				$data['pendaftar'] = array();
			}
			
			parent::template('pendaftar/syarat',$data);
		}
		
		
		
	}