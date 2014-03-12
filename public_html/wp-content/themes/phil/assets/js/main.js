// $('#sidebar').navobile({
// 	cta: '#show-navobile',
// 	changeDOM: true
// });
$('.menu-item-has-children').each(function() {
	$(this).children('a').append('<span class="caret"></span>');
});
$('.menu-item-has-children > a').click(function() {
	$(this).parent().siblings('.menu-item').find('.sub-menu').slideUp();
	$(this).siblings('.sub-menu').slideToggle();
	return false;
});

$('.page_image').height($(window).height());

$(window).resize(function() {
	$('.page_image').height($(window).height());
});

$('#show-nav').click(function() {
	var active;
	$('#sidebar').hasClass('active')? active = '-200px': active = 0;
	$('#sidebar').animate({
		left: active},
		300, function() {
		active?$('#sidebar').removeClass('active'):$('#sidebar').addClass('active');
	});
});

//$('.home_banner').backstretch($('.backgroundimage').val());

$('.action_link').click(function() {
	$('.main_links').slideToggle();
});
