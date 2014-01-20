// $('.header').navobile({
//	cta: '.nav_toggle',
//	changeDOM: true
// });
$('#header').navobile({
	cta: '#show-navobile',
	changeDOM: true
});
$('.menu-item-has-children').each(function() {
	$(this).children('a').append('<span class="caret"></span>');
});
$('.menu-item-has-children > a').click(function() {
	$(this).parent().siblings('.menu-item').find('.sub-menu').slideUp();
	$(this).siblings('.sub-menu').slideToggle();
	return false;
});