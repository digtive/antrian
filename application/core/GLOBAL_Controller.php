<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GLOBAL_Controller extends CI_Controller
{
    public $userID;
    public $userLevel;
    public $userName;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel','auth');

        if ($this->session->has_userdata('sess_id')) {
            $this->userID = $this->session->userdata('sess_id');
            $this->userName = $this->session->userdata('sess_user');
            $this->userLevel = $this->session->userdata('sess_level');
        }
        $this->licenseCheck();
    }

    /*
     * helper lives here
     * include templating helper, debugging & error helper, core helper
     * */

    // system helper
    public function model($model)
    {
        return $this->$model;
    }

    public function _clientMAC()
	{
		$_IP_SERVER = $_SERVER['SERVER_ADDR'];
		$_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
		if($_IP_ADDRESS == $_IP_SERVER)
		{
			ob_start();
			system('ipconfig /all');
			$_PERINTAH  = ob_get_contents();
			ob_clean();
			$_PECAH = strpos($_PERINTAH, "Physical");
			$_HASIL = substr($_PERINTAH,($_PECAH+36),17);
		}
		else {
			$_PERINTAH = "arp -a $_IP_ADDRESS";
			ob_start();
			system($_PERINTAH);
			$_HASIL = ob_get_contents();
			ob_clean();
			$_PECAH = strstr($_HASIL, $_IP_ADDRESS);
			$_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
			$_HASIL = substr($_PECAH_STRING[1], 0, 17);
		}
		return $_HASIL;
	}

	public function UserMAC()
	{
		$userByMac = $this->auth->get_lisensi_where(array(
			'mac_pengguna' => $this->_clientMAC()
		));

		return $userByMac;
	}

	public function licenseCheck()
	{
		$userMac = $this->UserMAC()->row_array();
		if ($userMac!== null){
			$expireDate = strtotime($userMac['tanggal_tempo']);
			$todayDate = strtotime(date('Y-m-d H:i:s'));

			if ($todayDate > $expireDate){
				$data['message'] = 'Masa Lisensi Anda Berakhir';
				$this->authPage('credits/expire',$data);
				exit();
			}

		}else{
			$data['message'] = 'Anda Belum Memiliki Akun Untuk Mengelola Aplikasi';
			$this->authPage('credits/expire',$data);
			exit();
		}
	}

    /*
 * in addition, you can set user rule based of your session
 * ex : http:yoursite/youruserrule/otherinformation
 * */
    public function setRule()
    {
        $hak = $this->session->userdata['pengguna_hak_akses'];
        if ($hak == null) {
            redirect('login');
        } else {
            if ($this->uri->segment(1) != $hak) {
                redirect(base_url('dashboard'));
            };
        }
    }

    public function post($value)
    {
        return $this->input->post($value);
    }

    public function get($value)
    {
        return $this->input->get($value);
    }

    public function cek_array($arr)
    {
        echo "<pre>";
        print_r($arr);
        exit;
    }

    public function cek_type($var)
    {
        echo "<pre>";
        var_dump($var);
        exit;
    }

    public function hasLogin()
    {
        return $this->session->has_userdata('sess_user') ? true : false;
    }

    //	templating helper
    public function template($content, $data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view($content, $data);
        $this->load->view('templates/footer', $data);
    }

    public function settingsPages($content,$data)
	{
		$this->load->view('settings/header', $data);
		$this->load->view($content, $data);
		$this->load->view('settings/footer', $data);
	}

    public function authPage($content, $data)
    {
        $this->load->view($content, $data);
    }

    public function alert($name, $value)
    {
        $this->session->set_flashdata($name, $value);
    }

}
