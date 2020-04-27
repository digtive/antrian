<?php


	namespace Antrian\models;


	use Antrian\helper\Database;

	class Queue extends Database
	{
		public $table = 'tbl_antrian';

		private $property = array(
			'id' => 'antrian_id',
			'date_create' => 'antrian_date_created'
		);

		public function __construct()
		{
			parent::__construct($this->table, $this->property);
		}

	}
