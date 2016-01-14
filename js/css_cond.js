jQuery(document).ready(function ($) {
	$('#jauge td').each(function () {
		var jauge = $(this).html();
		if(jauge < 0) {
			var parent = $(this).parent();
			parent.css('background-color','rgb(208,136,136)');
			parent.mouseenter(function () {
				$(this).css('background-color','rgb(194,103,103)');
			});
			parent.mouseleave(function () {
				$(this).css('background-color','rgb(208,136,136)');
			});
		}
		if(jauge < -50) {
			var parent = $(this).parent();
			parent.css('background-color','rgb(179,70,70)');
			parent.mouseenter(function () {
				$(this).css('background-color','rgb(151,60,60)');
			});
			parent.mouseleave(function () {
				$(this).css('background-color','rgb(179,70,70)');
			});
		}

	});
	$('#inscription td').each(function () {
		var jauge = $(this).html();
		var parent = $(this).parent();
		if(jauge === "Validée") {
			parent.css('background-color','rgb(190,224,175)');
			parent.mouseenter(function () {
				$(this).css('background-color','rgb(151,206,128)');
			});
			parent.mouseleave(function () {
				$(this).css('background-color','rgb(190,224,175)');
			});
		}
	});
});