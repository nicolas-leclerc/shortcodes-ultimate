jQuery(document).ready(function ($) {
	// Spoiler
	$('.su-spoiler-title').click(function (e) {
		var // Spoiler elements
		$title = $(this),
			$spoiler = $title.parent();
		// Open/close spoiler
		$spoiler.toggleClass('su-spoiler-closed');
		// Close other spoilers in accordion
		$spoiler.parent('.su-accordion').children('.su-spoiler').not($spoiler).addClass('su-spoiler-closed');
		e.preventDefault();
	});
	// Accordion
	$('.su-accordion .su-spoiler-title').click(function (e) {
		if ($(this).hasClass('su-spoiler-closed')) $(this).parent().siblings().addClass('su-spoiler-closed');
		e.preventDefault();
	});
	// Tabs
	$('.su-tabs-nav').delegate('span:not(.su-tabs-current)', 'click', function () {
		$(this).addClass('su-tabs-current').siblings().removeClass('su-tabs-current').parents('.su-tabs').find('.su-tabs-pane').hide().eq($(this).index()).show();
	});
	$('.su-tabs-pane').hide();
	$('.su-tabs-nav span:first-child').click();
	// Tables
	$('.su-table tr:even').addClass('su-even');
});