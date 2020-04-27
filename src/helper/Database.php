<?php


namespace Antrian\helper;


use Antrian\models\Locket;
use phpDocumentor\Reflection\Types\Array_;

class Database extends \GLOBAL_Model
{
	private $table;

	private $property;

	private $object;

	public function __construct($table,array $property)
	{
		parent::__construct();
		$this->property = $property;
		$this->table = $table;
	}

	/**
	 * @author bagussjm
	 * @param $query
	 * @return $this
	 * @version 1.0.0
	 */

	public function get($query = array())
	{
		if (!empty($query)){
			$this->object =  parent::get_object_of_row($this->table,$query);
			return $this;
		}
		$this->object =  parent::get_object_of_table($this->table);
		return $this;
	}

	public function join($join,$query = array())
	{
		if (!empty($query)){
			foreach ($join as $item):
				$this->db->join($item['table'],$item['relation']);
			endforeach;
			$this->object =  $this->db->get_where($this->table,$query);
			return $this;
		}
		foreach ($join as $item):
			$this->db->join($item['table'],$item['relation']);
		endforeach;
		$this->object =  $this->db->get_where($this->table,$query);
		return $this;
	}

	/**
	 * @param $id
	 * @return $this
	 */

	public function find($id)
	{
		$query = array(
			$this->property['id'] => $id
		);
		$this->object = parent::get_object_of_row($this->table,$query);
		return $this;
	}


	public function makeResultArray()
	{
		return $this->object->result_array();
	}

	public function makeRowArray()
	{
		return $this->object->row_array();
	}

	public function makeNumRows()
	{
		return $this->object->num_rows();
	}

}
