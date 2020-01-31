class ServiceComponent extends Services{
	antrianNumber;
	antrianData;
	serviceContainer;
	listContainer;
	serviceBg;
	constructor(){
		super();
		this.serviceBg = this.BASE_URL+'assets/images/background/servicecard-bg.png';
		this.listContainer = $('#service-list');
		this.serviceContainer = $('#queue-box-wrapper');
		this.antrianData = super.getData('Services/queue');
	}

	serviceComponent(callData){
		this.serviceContainer.html('');
		let inject = '';
		let data = this.antrianData.data;

		let activeCall = callData;
		inject+=
			'<div class="card card-shadow grid-margin bg-white card-service" style="background-image: url('+this.serviceBg+')" id="loket-'+activeCall.loket_id+'">'+
				'<div class="card-body p-2">'+
					'<div class="row" style="height: 90px;max-height: 90px">'+
						'<div class="col-7 ">'+
							'<h3 style="color: #1d70b7;font-family: titilliumweb-bold" class="ml-1">'+activeCall.layanan_nama+'</h3>'+
						'</div>'+
						'<div class="col-5">'+
							'<h1 style="font-size: 45px;color: white;font-family: titilliumweb-bold" class="mt-3 ml-3 animated infinite flash active-queue-number">'+activeCall[0]+'</h1>'+
						'</div>'+
					'</div>'+
					'<div class="row" style="padding: 4px 8px;height: auto">'+
						'<div class="col-12 d-flex justify-content-end">'+
							'<span class="badge badge-light text-dark service-info active" style="font-family: titilliumweb-bold">'+
							'<h5 class="m-0" id="service-info">Menuju Loket : '+activeCall.loket_nama+'</h5></span>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>';

		if (data  !== null && data.length > 0){
			for (let i = 0; i < data.length; i++) {
				if (data[i].loket_id !== activeCall.loket_id){
					inject+=
						'<div class="card card-shadow grid-margin bg-white card-service" style="background-image: url('+this.serviceBg+')" id="loket-'+data[i].loket_id+'">'+
						'<div class="card-body p-2">'+
						'<div class="row" style="height: 90px;max-height: 90px">'+
						'<div class="col-7 ">'+
						'<h3 style="color: #1d70b7;font-family: titilliumweb-bold" class="ml-1">'+data[i].layanan_nama+'</h3>'+
						'</div>'+
						'<div class="col-5">'+
						'<h1 style="font-size: 45px;color: white;font-family: titilliumweb-bold" class="mt-3 ml-3 ">'+this.getActiveQueue(data[i].loket_id)+'</h1>'+
						'</div>'+
						'</div>'+
						'<div class="row" style="padding: 4px 8px;height: auto">'+
						'<div class="col-12 d-flex justify-content-end">'+
						'<span class="badge badge-light text-dark service-info active" style="font-family: titilliumweb-bold">'+
						'<h5 class="m-0" id="service-info">Menuju Loket : '+data[i].loket_nama+'</h5></span>'+
						'</div>'+
						'</div>'+
						'</div>'+
						'</div>';
				}
			} // end for loop for antrian data
			this.serviceContainer.html(inject);
		}
	}

	serviceList(){
		this.listContainer.html('');
		let inject = '';
		let data = this.antrianData.data;

		if (data  !== null && data.length > 0){
			for (let i = 0; i < data.length; i++) {
					inject+=
						'<div class="card card-shadow grid-margin bg-white card-service" style="background-image: url('+this.serviceBg+')" >'+
						'<div class="card-body p-2">'+
						'<div class="row" style="height: 90px;max-height: 90px">'+
						'<div class="col-7 ">'+
						'<h3 style="color: #1d70b7;font-family: titilliumweb-bold" class="ml-1">'+data[i].layanan_nama+'</h3>'+
						'</div>'+
						'<div class="col-5">'+
						'<h1 style="font-size: 42px;color: white;font-family: titilliumweb-bold" class="mt-3 ml-3 ">'+this.getActiveQueue(data[i].loket_id)+'</h1>'+
						'</div>'+
						'</div>'+
						'<div class="row" style="padding: 4px 8px;height: auto">'+
						'<div class="col-12 d-flex justify-content-end">'+
						'<span class="badge badge-light text-dark service-info active" style="font-family: titilliumweb-bold">'+
						'<h5 class="m-0" id="service-info">Menuju Loket : '+data[i].loket_nama+'</h5></span>'+
						'</div>'+
						'</div>'+
						'</div>'+
						'</div>';
			} // end for loop for antrian data
			this.listContainer.html(inject);
		}
	}

	setActiveNumber(active){
		this.antrianNumber = active;
	}

	getActiveQueue(locket){
		let activeData = this.getData('Services/activeNumber/'+locket);

		return activeData.antrian;
	}
}
