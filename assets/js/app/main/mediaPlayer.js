$(document).ready(function(){
	let media = new MediaService();
	let connection = new Connection();
	let service = new Services();

	let result = service.getData('ComponentService/getMedia');
	let mediaSource = result.data;

	let mediaData = [];

	for (let i = 0; i < mediaSource.length; i++) {
		mediaData.push({
			src: connection.BASE_URL+mediaSource[i].source,
			type: mediaSource[i].type,
			mediaType: mediaSource[i].media_type,
			imageDuration: mediaSource[i].image_duration
		});
	}

	media.setData(mediaData);
	media.play(mediaData[0]);

});
