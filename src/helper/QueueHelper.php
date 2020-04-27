<?php


namespace Antrian\helper;


use Antrian\models\Locket;

class QueueHelper
{
	private $queueId;

	private $locketId;

	private $serviceId;

	private $queueData;

	private $waitQueue;

	private $nextQueue;

	private $activeQueue;

	private $completeQueue;

	private $locket;

	public function __construct($locketId)
	{
		$this->locketId = $locketId;
		$this->locket = new Locket();
	}


	/**
	 * @return mixed
	 */
	public function getWaitQueue()
	{

		return $this->waitQueue;
	}

	/**
	 * @param mixed $waitQueue
	 */
	public function setWaitQueue($waitQueue)
	{
		$this->waitQueue = $waitQueue;
	}

	/**
	 * @return mixed
	 */
	public function getNextQueue()
	{
		return $this->nextQueue;
	}

	/**
	 * @param mixed $nextQueue
	 */
	public function setNextQueue($nextQueue)
	{
		$this->nextQueue = $nextQueue;
	}

	/**
	 * @return mixed
	 */
	public function getActiveQueue()
	{
		return $this->activeQueue;
	}

	public function setActiveQueue()
	{
		$this->activeQueue =$this->locket->join(array(
			array('table' => 'tbl_layanan',
				'relation' => 'tbl_layanan.layanan_id = tbl_loket.loket_layanan_id')
		));
	}

	public function isQueueEmpty(Locket $obj)
	{
		if ($obj->makeNumRows() <=0 ){
			return true;
		}
		return false;
	}

}
