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
		'1': BASE_URL+'assets/audios/1.mp3',
		'2': BASE_URL+'assets/audios/2.mp3',
		'3': BASE_URL+'assets/audios/3.mp3',
		'4': BASE_URL+'assets/audios/4.mp3',
		'5': BASE_URL+'assets/audios/5.mp3',
		'6': BASE_URL+'assets/audios/6.mp3',
		'7': BASE_URL+'assets/audios/7.mp3',
		'8': BASE_URL+'assets/audios/8.mp3',
		'9': BASE_URL+'assets/audios/9.mp3',
		'out': BASE_URL+'assets/audios/out.wav',
		'urut': BASE_URL+'assets/audios/nomor-urut.mp3',
		'belas': BASE_URL+'assets/audios/belas.mp3',
		'konter': BASE_URL+'assets/audios/konter.mp3',
		'puluh': BASE_URL+'assets/audios/puluh.mp3',
		'ratus': BASE_URL+'assets/audios/ratus.mp3',
		'ribu': BASE_URL+'assets/audios/ribu.mp3',
		'11': BASE_URL+'assets/audios/sebelas.mp3',
		'10': BASE_URL+'assets/audios/sepuluh.mp3',
		'100': BASE_URL+'assets/audios/seratus.mp3',
		'loket': BASE_URL+'assets/audios/loket.mp3',
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

