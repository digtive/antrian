$(document).ready(function(){
	let con = new Connection();
	let sse = new EventSource(con.BASE_URL+'broadcast.php');

	sse.addEventListener('call',function (e) {
		console.log(e.data);
	})
});
