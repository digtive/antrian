$(document).ready(function(){
	
	let connection = new Connection();
	let audio = new AudioHelper();
	let antrian = new MainAntrian();
	let serviceComponent = new ServiceComponent();

	const BASE_URL = connection.BASE_URL;

	let callData = antrian.getCallData();
	serviceComponent.serviceList();
	serviceComponent.serviceComponent(callData);

	setInterval(function () {
		let call = antrian.getCallData();
		if (callData.panggilan_updated !== call.panggilan_updated){
			serviceComponent.serviceComponent(call);
			let currentQueue = call.panggilan_antrian;
			let currentLocket = call.panggilan_loket;
			play('in', 1);
			play('urut', 0);
			play(currentQueue,0);
			play('loket',0);
			play(currentLocket,0);

			// audio.chainPlay(call.panggilan_antrian,call.panggilan_loket);
			callData = call;
		}
	},1000);


	const audioMap = {
		'in': BASE_URL+'assets/audios/in.wav',
		'1': BASE_URL+'assets/audios/1.MP3',
		'2': BASE_URL+'assets/audios/2.MP3',
		'3': BASE_URL+'assets/audios/3.MP3',
		'4': BASE_URL+'assets/audios/4.MP3',
		'5': BASE_URL+'assets/audios/5.MP3',
		'6': BASE_URL+'assets/audios/6.MP3',
		'7': BASE_URL+'assets/audios/7.MP3',
		'8': BASE_URL+'assets/audios/8.MP3',
		'9': BASE_URL+'assets/audios/9.MP3',
		'out': BASE_URL+'assets/audios/out.wav',
		'urut': BASE_URL+'assets/audios/nomor-urut.MP3',
		'belas': BASE_URL+'assets/audios/belas.MP3',
		'konter': BASE_URL+'assets/audios/konter.MP3',
		'puluh': BASE_URL+'assets/audios/puluh.MP3',
		'ratus': BASE_URL+'assets/audios/ratus.MP3',
		'ribu': BASE_URL+'assets/audios/ribu.MP3',
		'11': BASE_URL+'assets/audios/sebelas.MP3',
		'10': BASE_URL+'assets/audios/sepuluh.MP3',
		'100': BASE_URL+'assets/audios/seratus.MP3',
		'loket': BASE_URL+'assets/audios/loket.MP3',
	};

	const main = new LocketAudio();

	function play(num,duration) {
		main.playAudio(num,duration);
	}

	function LocketAudio() {
		this.queue = [];
		this.playAudio = function(num,duration) {
			let self = this;
			self.queue.push(num);
			if (self.queue.length === 1) {
				self._call(duration);
			}
		};

		this._call = function(duration) {
			let self = this;
			if (self.queue.length) {
				setTimeout(() => {
					var audio = new Audio(audioMap[self.queue[0]]);
					audio.play();
					self.queue.shift();
					audio.onended = function() {
						self._call();
					};
				}, duration);
			}
		}
	}


});

