var settings = new Vue({
	el : '#dataVue',
	data : {
		warna : '',
		pesan : '',
	},
	methods : {
		gantiWarna : function () {
			console.log(this.warna);
		}
	}
});
