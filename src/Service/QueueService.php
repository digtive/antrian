<?php


namespace Antrian\Service;

use Antian\Helper\QueueHandler;

class QueueService
{
	public function __construct()
	{

	}

	public function call($locketId)
	{
		$QH = new QueueHandler($locketId);

		return $QH->getActiveQueue();
	}
}
