class ServiceComponent extends Services{
	antrianNumber;
	serviceBg;

	constructor(){
		super();
		this.serviceBg = this.BASE_URL+'assets/images/background/servicecard-bg.png';
	}

	serviceComponent(){
		let service = this;
		let container = $('#queue-box-wrapper');
		let mixer = mixitup(container, {
			behavior: {
				liveSort: true
			}
		});
		$('.card-service.mix').each(function () {
			let locketId = $(this).data('loket');
			let loket = service.getData('Services/loket/'+locketId);
			$(this).attr('data-panggilan',loket.data.loket_waktu_panggilan);
		});

		setTimeout(function () {
			mixer.sort('panggilan:desc');
		},300);
	}

	getActiveQueue(locketId){
		let activeData = this.getData('Services/activeNumber/'+locketId);

		return activeData.antrian;
	}

	refresh(locketId){
		this.serviceComponent();
		let activeQueue = this.getActiveQueue(locketId);
		let activeQueueContent = $('#loket-'+locketId+' .active-queue-number');
		activeQueueContent.html(activeQueue);
		$('.active-queue-number').removeClass('flash');
		activeQueueContent.addClass('flash');
	}
}
