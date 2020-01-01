class AudioHelper extends Connection{

	/*
	* void
	* arg1 = nomor antrian (string), arg2 = nomor loket (string)
	* membunyikan audio yang berisi nomor antrian
	* */
	chainPlay(activeQueue){
		let nomorAntrian = super.getCookies('antrianAktif-'+activeQueue);
		let loketAktif = super.getCookies('loketAktif-'+activeQueue);

		let baseUrl = this.baseUrl();
		// initialisation:
		let pCount = 0;
		let playlistUrls = [
			baseUrl+'assets/audios/in.wav',
			baseUrl+'assets/audios/nomor-urut.mp3',
			baseUrl+'assets/audios/'+nomorAntrian+'.mp3',
			baseUrl+'assets/audios/loket.mp3',
			baseUrl+'assets/audios/'+loketAktif+'.mp3',
		],

		// audio list
		howlerBank = [],
		loop = false;

		// playing i+1 audio (= chaining audio files)
		let onEnd = function(e) {
			if (loop === true ) {
				pCount = (pCount + 1 !== howlerBank.length)? pCount + 1 : 0;
			} else {
				pCount = pCount + 1;
			}
			if (howlerBank[pCount] !== undefined){
				howlerBank[pCount].play();
			}
		};

		// build up howlerBank:
		playlistUrls.forEach(function(current, i) {
			howlerBank.push(new Howl({ src: [playlistUrls[i]], onend: onEnd, buffer: true }))
		});

		// initiate the whole :
		howlerBank[0].play();
	}

}
