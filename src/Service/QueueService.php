<?php


namespace Antrian\Service;

use Antrian\helper\QueueHelper;

class QueueService
{
	public function __construct()
	{

	}

	public function call($locketId)
	{
		$QH = new QueueHelper($locketId);

		return $QH->getActiveQueue();
	}
}
