$(document).ready(function(){
	let media = new MediaService();
	let connection = new Connection();


	let data = [
		{
			src: connection.BASE_URL+'assets/videos/didi.mp4',
			type: 'video'
		},
		{
			src: connection.BASE_URL+'assets/videos/videoplayback.mp4',
			type: 'video'
		},
		{
			src: connection.BASE_URL+'assets/images/slides/bapenda.jpg',
			type: 'image'
		},
		{
			src: connection.BASE_URL+'assets/videos/sample-video.mp4',
			type: 'video'
		},

	];
	media.setData(data);
	media.play(data[0]);

});
