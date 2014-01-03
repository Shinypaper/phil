/**
 * Sanskript Solutions, Inc.
 * 1.3.0
 */
 
jQuery( document ).ready(function() {

	if(jQuery().cookie)
    {
		if (jQuery('#sp_disclaimer').length > 0) {
			if (jQuery.cookie('disclaimer_accepted') != 'yes') {
				jQuery('#sp_disclaimer').modal({backdrop:'static',keyboard:false})
				jQuery('#sp_disclaimer').on('hide',function(){

					
				})
			}			
		}
	}
	
	jQuery("#sp-accept").click(function(){
			jQuery.cookie('disclaimer_accepted','yes',{expires:30,path: '/'});
			jQuery("#sp_disclaimer").modal ('hide'); 
	});
	
	jQuery("#sp-print").click(function(){
			window.print();
	});
	
	
	jQuery(".sp-social").click(function(){
			var height = jQuery(this).data("height");
			var width = jQuery(this).data("width");
			var url = jQuery(this).data("url");
			var title = jQuery(this).data("title");
			var left=(screen.width/2)-(width/2);
			var top=(screen.height/2)-(height/2);
			var targetWin=window.open(url,title,'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+width+', height='+height+', top='+top+', left='+left);
	});
		
	if(jQuery().prettyPhoto)
    {			
		jQuery("a[data-pp^='sp_prettyPhoto']").prettyPhoto({
			social_tools: false,
			theme: 'light_square',
			autoplay_slideshow: false,
		});	
	}
	
	jQuery('#sp_nav_map_tab a').click(function (e) {
	  e.preventDefault();	
	  jQuery(this).tab('show');
	});
	
	jQuery('a[href="#sp_map_tab"]').on('shown', function(e) {
			google.maps.event.trigger(map, 'resize');
	});
		
	jQuery('a[href="#sp_street_tab"]').on('shown', function(e) {
		google.maps.event.trigger(mapstreet, 'resize');
	});
	
	jQuery('a[href="#sp_birdseye_tab"]').on('shown', function(e) {
		 GetMap();
	});
	
	if(jQuery().bxSlider)
    {
		jQuery('#prop_bxslider').bxSlider({
					minSlides: 3,
					maxSlides: 8,
					adaptiveHeight: true,
					slideWidth: 200,
					slideMargin: 5,
					moveSlides:1,
					useCSS: false,
					initDelay: 0
		});
		
		/*jQuery('#prop_bxslider_tv').bxSlider({
					minSlides: 2,
					maxSlides: 8,
					adaptiveHeight: false,
					slideWidth: 400,
					slideMargin: 5,
					moveSlides:2,
					useCSS: false,
				//	initDelay: 500,
					auto: true,
					autoControls: true,
				//ticker: true,
				//	speed: 500
		});
		*/

	}

	if(jQuery().swipebox)
    {
		jQuery(".swipebox").swipebox();
	}
	
	if(jQuery().flexslider)
    {
		
		
    }

	
	
}); //End


jQuery(window).load(function() {	
		
		jQuery('.flexslider').flexslider({
		selector: ".slides > li", 
		animation: "slide",
		animationLoop: true,
		itemWidth: 256,
		itemMargin: 1,
		minItems: 1,
		prevText: "",
		nextText: "",
		});
	
        // Remove Flex Slider Navigation for Smaller Screens Like IPhone Portrait
        jQuery('.flexslider').hover(function(){
            var mobile = jQuery('body').hasClass('probably-mobile');
            if(!mobile)
            {
                jQuery('.flex-direction-nav').stop(true,true).fadeIn('slow');
            }
        },function(){
            jQuery('.flex-direction-nav').stop(true,true).fadeOut('slow');
        });
	});

			
	