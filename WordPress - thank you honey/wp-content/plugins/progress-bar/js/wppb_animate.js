jQuery(document).ready(function($) {
	$(".wppb-progress.fixed > span, .wppb-progress-full > span").each(function() {
		$(this)
			.data("origWidth", $(this).width())
			.width(0)
			.animate({
				width: $(this).data("origWidth")
			}, 1200);
	});
});