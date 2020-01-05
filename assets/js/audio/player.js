$(document).ready(function(){
	
	let connection = new Connection();
	let audio = new AudioHelper();
	let antrian = new MainAntrian();

	let callData = antrian.getCallData();
	// let callUpdated = callData.data.panggilan_updated;

	setInterval(function () {
		let call = antrian.getCallData();
		if (callData.panggilan_updated !== call.panggilan_updated){
			console.log('loket - '+call.panggilan_loket+' antrian : '+call.panggilan_loket);
			audio.chainPlay(call.panggilan_nomor,call.panggilan_loket);

			callData = call;
		}
	},500);

	/*
	* event
	* */
	$(document).keypress(function (key) {
		let btnSetting = key.originalEvent.key;
		if (btnSetting === '1'){
			antrian.call('Services/call/1');
		}
		if (btnSetting === '2'){
			antrian.call('Services/call/2');
		}
		if (btnSetting === '3'){
			antrian.call('Services/call/3');
		}
		if (btnSetting === '4'){
			antrian.call('Services/call/4');
		}

		if (btnSetting === 'r'){
			antrian.recall('Services/recall');
		}

	});



});

