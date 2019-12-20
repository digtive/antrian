<?php
	
	class ComponentModel extends  GLOBAL_Model {
		private $table;

        public function __construct()
        {
            parent::__construct();
			$this->table = 'tbl_app';
        }

        /*
         * get modules
         * */
        public function get_user_app($query)
		{
			return parent::get_array_of_row($this->table, $query);
		}

		/*
		 * SERVICES
		 * save changes from client
		 * */

        public function edit_component($appId,$dataEdit)
		{
			parent::update_table_with_status($this->table,'app_id',$appId,$dataEdit);
		}

    }
