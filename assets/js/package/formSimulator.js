$(document).ready(function(){

	/*-- events --*/
	$(document).on('change','.form-simulator.select-simulator',function () {
		let value  = $(this).val();
		let target = $(this).data('transform');
		let changeType = $(this).data('change');
		transform(target,value,changeType);

	});

	/*-- functions --*/
	function transform(target,value,changeType) {
		$(target).css(changeType,value);
	}

});
