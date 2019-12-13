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
        $id = $this->input->post('layanan_id');
        $date = date('Y-m-d');

        $data = $this->AntrianModel->getByLayanan($id, $date);

//        $data = $this->AntrianModel->getByLayanan($id, $date);
            $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
            if ($data->num_rows() <= 0) {
                //$this->addQueue($id,$data->num_rows());
                $response['status'] = "400";
                $response['message'] = "Antrian Belum Ada";
            } else {
                $response['status'] = 200;
                $response['message'] = "Berhasil Memuat Data";
                $response['data'] = $data->result_array();
                $response['sekarang'] = $sekarang->row_array();
                $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
                //$this->addQueue($id,1);
            }


        echo json_encode($response);
    }

    public function call()
    {
        $response = null;
        $id = $this->input->post('layanan_id');
        $date = date('Y-m-d');
        $data = $this->AntrianModel->getByLayanan($id, $date);
        $sekarang = $this->AntrianModel->getCurrentNumber($id, $date)->row_array();
        if ($data) {
            if ($data->num_rows() <= 0) {
                $response['status'] = "400";
                $response['message'] = "Antrian Belum Ada";
            } else {
                $getnextid = $this->AntrianModel->getFirstWait($id, $date)->row_array();
                $update = array("antrian_status" => 'selesai');
                $this->AntrianModel->editantrian($sekarang['antrian_id'], $update);
                $update = array("antrian_status" => 'aktif');
                $this->AntrianModel->editantrian($getnextid['antrian_id'], $update);
                $data = $this->AntrianModel->getByLayanan($id, $date);
                $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
                $response['status'] = 200;
                $response['message'] = "Berhasil Memuat Data";
                $response['data'] = $data->result_array();
                $response['sekarang'] = $sekarang->row_array();
                $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
                $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
            }
        }
        else{
            $response['status'] = 403;
            $response['message'] = "Antrian Berikutnya Belum Tersedia";
        }

        echo json_encode($response);

    }

    public function recall()
    {
        $response = null;
        $id = $this->input->post('layanan_id');
        $date = date('Y-m-d');
        $data = $this->AntrianModel->getByLayanan($id, $date);

        $sekarang = $this->AntrianModel->getCurrentNumber($id, $date);
        if ($data->num_rows() <= 0) {
            $response['status'] = "400";
            $response['message'] = "Antrian Belum Ada";
        } else {
            $response['status'] = 200;
            $response['message'] = "Berhasil Memuat Data";
            $response['data'] = $data->result_array();
            $response['sekarang'] = $sekarang->row_array();
            $response['total'] = $this->AntrianModel->getTotalQueue($id, $date)->num_rows();
            $response['sisa'] = $this->AntrianModel->getRestQueue($id, $date)->num_rows();
        }
        echo json_encode($response);
    }

    public function addQueue($id, $type)
    {
        $data = null;
        $nomor = null;
        $status = 'menunggu';
        if ($type == 0) {
            $nomor = 1;
            $status = 'aktif';
        } else {
            $date = date('Y-m-d');
            $data = $this->AntrianModel->getByLayanan($id, $date)->row_array();
            $nomor = $data['antrian_nomor'] + 1;
        }
        $loket = $this->LoketModel->getByLayanan($id)->row_array();
        $data = array("antrian_nomor" => $nomor,
            "antrian_layanan_id" => $id,
            "antrian_loket_id" => $loket['loket_id'],
            "antrian_status" => $status);
        $this->AntrianModel->post_antrian($data);
    }

    public function errorhandling()
    {
        echo 'Layanan tidak tersedia';
    }

}