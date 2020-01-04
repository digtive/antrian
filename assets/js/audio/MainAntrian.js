class MainAntrian extends Services{
	queueData = [];

	call(url){
		this.queueData = [];
		this.queueData = super.getData(url);
	}

	recall(url){
		super.getData(url);
	}

	/*
	* void
	* arg1 = loket panggilan sebelumnya (String [Cookies]), arg2 = loket yang sedang di panggil (String [Cookies])
	* description: refresh queue component
	* */
	refresh(queueBefore,swapQueue){
		if (queueBefore !== swapQueue){
			$("#loket-"+queueBefore+"").swap({
				target: "loket-"+swapQueue,
				opacity: "0.5",
				speed: 500,
			});
		}
	}

	/*
	* return counter value;
	*
	* */
	getCounter(){
		return this.counter;
	}

	getActiveLoket(){
		return this.loketAktif;
	}
}
