<?php


namespace Antrian\Service;

use Antrian\helper\QueueHelper;
use Antrian\models\Queue;

class QueueService
{

	private $queue;

	public function __construct()
	{
		$this->queue = new Queue();
	}

	public function call($locketId)
	{
		$qh = new QueueHelper($locketId);

		if ($qh->isEmptyQueue($qh->getFirstInQueue())){
			$this->onFirstQueueEmpty($qh);
		}else{
			$this->onFirstQueueExist($qh);
		}

	}

	public function onFirstQueueExist(QueueHelper $queueHelper)
	{
		$firstIn = $queueHelper->getFirstInQueue();
		//change all active queue to complete
		if ($this->queue->setFirstToComplete($queueHelper)){
			// next step is get firstIn queue in table after active queue has set to complete
			$this->queue->setFirstIn($queueHelper->getServiceId());

			if (!$queueHelper->isEmptyQueue($this->queue->getFirstIn())){
				$nextQueue = $this->queue->getFirstIn()->makeRowArray();
				$this->queue->setNextToActive($nextQueue['antrian_id']);
			}

			// set json output to API, last called queue as callData
			$activeQueue = $firstIn->makeRowArray();
			$queueHelper->jsonOutput('200','berhasil memanggil antrian',$activeQueue,array(
				'antrian' => str_pad($activeQueue['antrian_nomor'], 3, '0', STR_PAD_LEFT)
			));

		}else{
			// fail update data on server
			$queueHelper->jsonOutput('500','kesalahan operasi antrian');
		};
	}

	public function onFirstQueueEmpty(QueueHelper $qh)
	{
		$qh->jsonOutput('404','belum ada antrian pada loket tersebut',array(),array(
			'antrian' => '000'
		));
	}
}
