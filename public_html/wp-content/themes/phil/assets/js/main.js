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
	});;
});

//$('.home_banner').backstretch($('.backgroundimage').val());

$('.action_link').click(function() {
	$('.main_links').slideToggle();
});

var styles = [
	{
		"featureType": "landscape",
		"stylers": [
			{
				"hue": "#FF0300"
			},
			{
				"saturation": -100
			},
			{
				"lightness": 30.66666666666663
			},
			{
				"gamma": 1
			}
		]
	},
	{
		"featureType": "road.highway",
		"stylers": [
			{
				"hue": "#FFA200"
			},
			{
				"saturation": 100
			},
			{
				"lightness": -10.756862745098047
			},
			{
				"gamma": 1
			}
		]
	},
	{
		"featureType": "road.arterial",
		"stylers": [
			{
				"hue": "#FBFF00"
			},
			{
				"saturation": 0
			},
			{
				"lightness": 0
			},
			{
				"gamma": 1
			}
		]
	},
	{
		"featureType": "road.local",
		"stylers": [
			{
				"hue": "#00FFFD"
			},
			{
				"saturation": 0
			},
			{
				"lightness": 47
			},
			{
				"gamma": 1
			}
		]
	},
	{
		"featureType": "water",
		"stylers": [
			{
				"hue": "#5c80da"
			},
			{
				"saturation": 0
			},
			{
				"lightness": 0
			},
			{
				"gamma": 1
			}
		]
	},
	{
		"featureType": "poi",
		"stylers": [
			{
				"hue": "#9FFF00"
			},
			{
				"saturation": 0
			},
			{
				"lightness": 0
			},
			{
				"gamma": 1
			}
		]
	},{
    "featureType": "road.highway",
    "stylers": [
      { "weight": 0.1 }
    ]
  }
];

var latlong = new google.maps.LatLng(43.65323, -79.38318);

var myOptions = {
	zoom: 13,
	center: latlong,
	styles: styles
};

map = new google.maps.Map(document.getElementById("map"), myOptions);

