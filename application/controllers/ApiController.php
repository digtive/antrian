<?php
/**
 * Created by PhpStorm.
 * User: azhar
 * Date: 10/12/19
 * Time: 22:10
 */

class ApiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AntrianModel');
        $this->load->model('LoketModel');
        $this->load->model('LayananModel');
    }

    public function index()
    {
        $pilihan = $this->uri->segment(3);
        switch ($pilihan) {
            case 'layanan':
                $this->layanan();
                break;
            case 'antrian':
                $this->antrian();
                break;
            default :
                $this->errorhandling();
                break;
        }
    }

    public function layanan()
    {
        $response = null;
        $data = $this->LayananModel->get_layanan();
        $response['status'] = 200;
        $response['message'] = "Berhasil Memuat Data";
        $response['data'] = $data->result_array();
        echo json_encode($response);
    }
	public function loket(){
		$response = null;
		$layanan = $this->input->post('layanan_id');
		$data = $this->LoketModel->get_by_layanan($layanan);
		$response['status'] = 200;
        $response['message'] = "Berhasil Memuat Data";
        $response['data'] = $data->result_array();
        echo json_encode($response);
	}
	public function getAntrian(){
		$response = null;
		$layanan = $this->input->post('layanan_id');
		$data = $this->AntrianModel->getActive($layanan);
		$waiting = $this->AntrianModel->getWaiting($layanan);
		$response['status'] = 200;
		$response['message'] = 'Berhasil Memuat Data';
		if($data->num_rows()>0){
		$response['data_active'] = $data->row_array();			
		}
		else{
			$data = array("antrian_id"=> "0",
        "antrian_nomor"=> "0",
        "antrian_layanan_id"=> "9",
        "antrian_loket_id"=> null,
        "antrian_nomor_aktif"=> null,
        "antrian_jenis_panggilan"=> "0",
        "antrian_nomor_alihan"=> null,
        "antrian_suara_alihan_prefix"=>null,
        "antrian_suara_alihan"=> null,
        "antrian_date_created"=> "0",
        "antrian_status"=> "habis");
			$response['data_active'] =$data; 
		}
		$response['data_waiting'] = $waiting->num_rows();
		echo json_encode($response);
	}
	public function alihan(){
		
	}
}
