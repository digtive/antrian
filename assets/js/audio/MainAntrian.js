class MainAntrian extends Services{

	call(url){
		let antrian = super.getData(url);
		let antrianId = antrian.data.antrian_id;
		let loketNomor = antrian.data.loket_nomor;
		let antrianNomor = antrian.data.antrian_nomor;
		let loketId = antrian.data.antrian_loket_id;
		let callCounter = this.getCookies('callCounter');
		let doCounter = parseInt(callCounter)+1;
		this.setCookies('callCounter',doCounter,1);
		this.setCookies('currentQueue',loketNomor,2);
		this.setCookies('antrianAktif-'+loketNomor,antrianNomor,2);
		this.setCookies('loketAktif-'+loketNomor,loketNomor,2);
		if (this.setActiveNextQueue(antrianId,antrianNomor,loketId)){
			console.log('success');
		}else{
			console.log('tidak ada antrian selanjutnya');
		}

	}

	setActiveNextQueue(antrianId,antrianNomor,loketId){
		let data = {
			'antrian_id' : antrianId,
			'antrian_nomor' : antrianNomor,
			'loket_id' : loketId
		};
		let editStatus = super.postData('Services/activateNextQueue',data);
		return editStatus.status === '200';
	}
}
