$(document).ready(function(){
	let con = new Connection();
	let services = new Services();

	$(document).keypress(function (key) {
		let btnSetting = key.originalEvent.key;
		console.log(btnSetting);
	});
});
