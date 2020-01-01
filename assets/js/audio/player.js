$(document).ready(function(){
	
	let connection = new Connection();
	let helper = new AudioHelper();
	let service = new Services();
	let antrian = new MainAntrian();

	// variable helper
	let dataRecall = [];

	let callCounter;
	if (connection.getCookies('callCounter') !== ''){
		callCounter = connection.getCookies('callCounter');
	}else{
		connection.setCookies('callCounter','1',1);
	}

	setInterval(function () {
		if (connection.getCookies('callCounter') !== callCounter){
			callCounter = connection.getCookies('callCounter');

			helper.chainPlay(connection.getCookies('currentQueue'));
		}else{
			callCounter = connection.getCookies('callCounter');
		}
	},1000);



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

	});



});

