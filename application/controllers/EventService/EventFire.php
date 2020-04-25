<?php

	namespace AppEvent;

	use Sse\SSE;

	class EventFire{

		private $data;

		public function __construct($data)
		{
			$this->data = $data;
			$this->fire();
		}

		public function fire()
		{
			$sse = new SSE();
			$callData = $this->data;

			// You can limit how long the SSE handler to save resources
			$sse->exec_limit = 10;

			// Add the event handler to the SSE handler
			$sse->addEventListener('bio',new CallEvent($callData));

			// Kick everything off!
			$sse->start();
		}

	}

