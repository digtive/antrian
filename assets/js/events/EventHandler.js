$(document).ready(function(){
	let con = new Connection();
	let service = new Services();

	let cache = 0;
	let lastRefresh = service.getData('Services/getLastRefresh');
	cache = lastRefresh.time;
	let sse = new EventSource(con.BASE_URL+'broadcast.php');

	sse.addEventListener('refresh',function (e) {
		if (e.data !== 'null'){
			let response = JSON.parse(e.data);
			if (response.time !== cache ){
				console.log(e.data);
				cache = response.time;
			}
		}
	});
});
