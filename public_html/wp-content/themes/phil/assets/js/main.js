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
	zoom: 12,
	center: latlong,
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	styles: styles
};

map = new google.maps.Map(document.getElementById("map"), myOptions);