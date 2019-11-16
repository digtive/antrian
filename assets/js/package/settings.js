var settings = new Vue({
	el : '#dataVue',
	data : {
		warna : '',
		pesan : 'kambing',
	},
	methods : {
		gantiWarna : function () {
			console.log(this.warna);
		}
	}
});
