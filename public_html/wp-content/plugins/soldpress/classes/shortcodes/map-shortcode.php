<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	add_action( 'wp_enqueue_scripts', 'sp_enqueue_ajax_object_script' );
	function sp_enqueue_ajax_object_script() {
		wp_localize_script( 'sp_ajax-script', 'sp_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
	}
	
	function sp_shortcode_map($atts, $content = null, $code = "") 
	{	

		$defaults = array(
			'lon'	 => '-111.824341',
			'zoom' => '3',
			'lat'  => '60.413852',
			'width'	 => '100%',
			'height' => '650px'
		);
		  
		extract( shortcode_atts( $defaults, $atts ) );	
		
		ob_start();
	
		?>
  <script>
	  jQuery(document).ready(function() 
	  {
				
		var data = {
			action: 'sp_dataservice_listing',   
		};
		
		var opts = {
		  lines: 13, // The number of lines to draw
		  length: 20, // The length of each line
		  width: 10, // The line thickness
		  radius: 30, // The radius of the inner circle
		  corners: 1, // Corner roundness (0..1)
		  rotate: 0, // The rotation offset
		  direction: 1, // 1: clockwise, -1: counterclockwise
		  color: '#000', // #rgb or #rrggbb or array of colors
		  speed: 1, // Rounds per second
		  trail: 60, // Afterglow percentage
		  shadow: false, // Whether to render a shadow
		  hwaccel: false, // Whether to use hardware acceleration
		  className: 'spinner', // The CSS class to assign to the spinner
		  zIndex: 2e9, // The z-index (defaults to 2000000000)
		  top: 'auto', // Top position relative to parent in px
		  left: 'auto' // Left position relative to parent in px
		};
		
		var target = document.getElementById('sp_map');
		var spinner = new Spinner(opts).spin(target);
		
		var center = new google.maps.LatLng(<?php echo $lat ?>,<?php echo $lon ?> );
	
		var map = new google.maps.Map(document.getElementById('map_canvas'), {
		  zoom: <?php echo $zoom?>,
		  center: center,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		});
				
		jQuery.post('<?php echo admin_url( 'admin-ajax.php' )?>', data, function(response) {

			//console.log(response);
						
			var properties = jQuery.parseJSON(response);			
			var markers = [];
				
			var infowindow = new google.maps.InfoWindow({
					content: contentString,
					size: new google.maps.Size(150,50)
				 });
				 
			for ( var i = 0; i < properties.data.length; i++ ) {
				
				var dataGeo = properties.data[i];	
				 
				var lat = dataGeo.lat;
				var lng = dataGeo.lon;
				
				var dataGeo = properties.data[i];			
				var latLng = new google.maps.LatLng(dataGeo.lat,dataGeo.lon);
				
				var marker = new google.maps.Marker({
					  position: latLng,
					  map: map,
					  title: dataGeo.post_title,
					  listingkey:dataGeo.post_excerpt,
					  listingname:dataGeo.post_name,
				  });
				  
				markers.push(marker);
				
				var contentString = '<div style="width:240px">' + dataGeo.post_title + '<\/div>';		
			}
	
			for (var i = 0; i < markers.length; i++) {
					var marker = markers[i];
					google.maps.event.addListener(marker, 'click', function () {
						infowindow.setContent('<a href="'+ '<?php echo get_post_type_archive_link('sp_property'); ?>' +this.listingname+ '">'+this.title+'</a>');
						infowindow.open(map, this);
					});
			}
			
			spinner.stop();
			
			var markerCluster = new MarkerClusterer(map, markers);	
			
		});		
	});
  </script>
  <div id="sp_map" class="sp" style="width:100%; min-height:500px;">
	<div id="map_canvas" style="width:100%; min-height:500px;" >
	</div>
  </div>
		<?php
		
		$output_string = ob_get_contents();

		ob_end_clean();
		
		return $output_string;
	}	

	add_shortcode("soldpress-map", "sp_shortcode_map");	
?>