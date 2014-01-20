// $('.header').navobile({
// 	cta: '.nav_toggle',
// 	changeDOM: true
// });
$('#header').navobile({
	cta: '#show-navobile',
	changeDOM: true
});
$('.menu .menu-item').each(function() {
	console.log($(this).find('.sub-menu').length);
	if ($(this).find('.sub-menu').length) {
		$(this).children('a').append('<span class="caret"></span>');
		$(this).click(function() {
			$(this).siblings('.menu-item').find('.sub-menu').slideUp();
			$(this).find('.sub-menu').slideToggle();
		});
	}
});