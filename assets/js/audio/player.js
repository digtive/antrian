$(document).ready(function(){
	
	let connection = new Connection();
	let audio = new AudioHelper();
	let antrian = new MainAntrian();

	let callCounter;
	let loketAktif;

	if (connection.getCookies('counter') === ''){
		callCounter = connection.setCookies('counter','1',1);
	}else{
		callCounter = connection.getCookies('counter');
	}
	if (connection.getCookies('loketAktif') === ''){
		loketAktif = connection.setCookies('loketAktif','1',1);
	}else{
		loketAktif = connection.getCookies('loketAktif');
	}

	setInterval(function () {
		if (connection.getCookies('counter') !== callCounter){

			swapComponent(loketAktif,connection.getCookies('loketAktif'));
			callCounter = connection.getCookies('counter');

			audio.chainPlay(connection.getCookies('loketAktif'));
		}

	},500);


	function swapComponent(loketBefore,loketSwap){
		if (loketBefore !== loketSwap){
			antrian.refresh(loketBefore,loketSwap);
			loketAktif = loketSwap;
		}
	}
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

