<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
 
function sp_get_map_section()
{
	global $post;
 ?>	
 
<script>
	var address = '<?php $address = addslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
	echo $address ;
	?>';	
	var map;	
	
	function initialize() {					
		var geocoder = new google.maps.Geocoder();		
		geocoder.geocode( { 'address' : address }, function( results, status ) {
			if( status == google.maps.GeocoderStatus.OK ) {
				var latlng = results[0].geometry.location;
				var mapOptions = {
					zoom: 15,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP, 
					streetViewControl: true
				};
		  
											
				map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
				
				var marker = new google.maps.Marker({
					position:results[0].geometry.location,								
					map: map,
					scrollwheel: false,
					streetViewControl:true
				});
				
				
				<?php if(get_option( 'sc-layout-streetviewmap',false)){ ?> 
				
					var mapOptionsStreet = {
						zoom: 14,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP, 
						streetViewControl: true
					};
					
					mapstreet = new google.maps.Map(document.getElementById('map-street'), mapOptionsStreet);	
					
					var panoramaOptions = {
						position: results[0].geometry.location,
						  pov: {
							heading: 0,
							pitch: 0,
							zoom: 1
						  },
						visible: true
					};
					
					var panorama = new  google.maps.StreetViewPanorama(document.getElementById("map-street"), panoramaOptions);
					mapstreet.setStreetView(panorama);
					panorama.setVisible(true);
				<?php }; ?>									
			}else{
			//	alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}	
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php if(get_option('sc-layout-ariealmap',true)){ ?> 				
<table class="table table-striped table-condensed ">
		 <caption>Map</caption>
		 <tbody>
			<tr>
				<td>
					<?php if(get_option('sc-layout-streetviewmap',false)){ ?> 
						<div id="map-street" class="well-map"></div>
					<?php }?>
					
					<div id="map-canvas" class="well-map"></div>	
												
				</td>
			</tr>
		</tbody>
</table>
<?php } 
}
?>