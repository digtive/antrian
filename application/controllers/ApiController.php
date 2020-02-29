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

    public function antrian()
    {
        $response = null;
        $id = $this->input->post('loket_id');
		$date = date('Y-m-d');
        $data = $this->LoketModel->getByLayanan($id);
//        $data = $this->AntrianModel->getByLayanan($id, $date);
            $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
		
            if ($data->num_rows() <= 0) {
                //$this->addQueue($id,$data->num_rows());
                $response['status'] = "400";
				
                $response['message'] = "Antrian Belum Ada";
            } else {
                if(!empty($sekarang->row_array())){
$last = $this->AntrianModel->getLastNumber($id,$date);                
				$response['status'] = 200;
                    $response['message'] = "Berhasil Memuat Data";
                    $response['data'] = $data->result_array();
                    $response['sekarang'] = $last->row_array();
                    $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                    $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
                }
                else{
					$last = $this->AntrianModel->getLastNumber($id,$date);
                    $response['status'] = 200;
                    $response['message'] = "Berhasil Memuat Data";
                    $response['data'] = $data->result_array();
                    $response['sekarang'] = $last->row_array();
                    $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                    $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
                }

            }
        echo json_encode($response);
    }
	public function loket()
    {
        $response = null;
        $data = $this->LoketModel->getJoinLoket();
        $response['status'] = 200;
        $response['message'] = "Berhasil Memuat Data";
        $response['data'] = $data->result_array();
        echo json_encode($response);
    }

}