$(document).on('click', '.launch', function() {
	var type = $(this).data('type');
	manu.getAction("CelebContent", {
		type : type
	}, function(data) {
		// override corresponding div with response data
		$("#contentDiv").html(data);
	});
});

$(document).on('change', '#searchbox', function() {
	var name = $(this).attr('value');
	manu.getAction("SearchCeleb",{name:name}, function(data){
		alert("hello");
	});
});

$(document).on('click', '.changestate', function() {
	$(".changestate").removeClass("active");
	$(this).addClass("active")
});

