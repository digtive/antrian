$(document).ready(function(){
	let con = new Connection();
	let sse = new EventSource(con.BASE_URL+'broadcast.php');
	let cache = 0;

	sse.addEventListener('call',function (e) {
		let data = JSON.parse(e.data);
		if (data.time !== cache ){
			console.log(data);
			cache = data.time;
		}
	})
});
