<?php

	namespace AppEvent;

	use Sse\SSE;
	use Sse\Data;

	class EventData{
		private $data;

		public function __construct()
		{
			$this->data = new Data('file',array('path' => './data'));
		}

		public function fire($event,$data)
		{
			if (!array_key_exists('time',$data)){
				$data['time'] = time();
			}
			$this->data->set($event,json_encode($data));
		}

		public function get($key)
		{
			return $this->data->get($key);
		}

	}

