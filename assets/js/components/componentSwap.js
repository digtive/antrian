$(document).ready(function(){
	$(".go-swap").click(function() {
		$("#loket-1").swap({
			target: "loket-4", // Mandatory. The ID of the element we want to swap with
			opacity: "0.5", // Optional. If set will give the swapping elements a translucent effect while in motion
			speed: 500, // Optional. The time taken in milliseconds for the animation to occur
		});
	});
});
