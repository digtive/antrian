<?php
	
	class AuthModel extends  GLOBAL_Model {
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function get_pengguna($username,$password)
		{
			$user = array(
				'username' => $username,
				'password' => $password
			);
			
			return parent::get_object_of_row('auth',$user);
		}

		public function get_lisensi($idAuth)
		{
			parent::_ODB()->join('auth','auth.id_auth = lisensi.id_user');
			parent::_ODB()->where('lisensi.id_user',$idAuth);
			return parent::_ODB()->get('lisensi')->row_array();
		}
		
		
	}
