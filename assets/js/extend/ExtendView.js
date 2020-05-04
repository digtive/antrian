class ExtendView extends Services{
	queueNumber;

	service;

	callData;

	activeQueue;

	activeLocket;

	constructor() {
		super();
		this.setCallData();
		this.setProperty();
	}

	getCallData(){
		return this.callData;
	}

	setCallData(){
		this.callData = super.getData('Services/getLastCall');
	}

	setProperty(){
		this.activeQueue = $('#activeQueue');
		this.activeLocket = $('#activeLocket');

		this.setActiveQueue();
	}

	setActiveQueue(){
		this.activeQueue.html(this.callData.data.antrian_nomor_aktif);
		this.activeLocket.html('LOKET '+this.callData.locket.loket_alias);
	}

	refresh(){
		this.setCallData();
		this.setActiveQueue();
	}
}
