<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
function sp_get_map_section()
{
	global $post;
 ?>	
 
<script>
	var address = '<?php echo urlencode(soldpress_get_address());?>';	
	var map;	
	
	function initialize() 
	{					
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
					//	center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP, 
						streetViewControl: true
					};
					
					mapstreet = new google.maps.Map(document.getElementById('map-street'), mapOptionsStreet);	
					

									
					var sv = new google.maps.StreetViewService();
					sv.getPanoramaByLocation(latlng, 50, processSVData);												
					function processSVData(data, status) 
					{
						if (status == google.maps.StreetViewStatus.OK) {
						
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
						}
						else{
						
							document.getElementById("map-street").className = "no-map"; 
							document.getElementById("map-street").innerHTML='<p class="msg negative">We\'re sorry, but Google Streetview is currently unavailable for this property.</p>'
						}
					}
				<?php }; ?>									
			}else{
			//	alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}	
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
 
<script type="text/javascript">
 var bing_map = null;
 function GetMap()
 {
	// Initialize the map
	
	<?php 
	
	$bingapi = get_option("sc-api-bing");
		
	?>
	 bing_map = new Microsoft.Maps.Map(document.getElementById("map-birdseye"), { credentials: "<?php echo $bingapi?>", mapTypeId: Microsoft.Maps.MapTypeId.birdseye });
	  bing_map.getCredentials(MakeGeocodeRequest);

 }

 function MakeGeocodeRequest(credentials)
 {
	
	var address = '<?php echo urlencode(soldpress_get_address());?>';	
	var geocodeRequest = "http://dev.virtualearth.net/REST/v1/Locations?query=" + address + "&output=json&jsonp=GeocodeCallback&key=" + credentials;

	CallRestService(geocodeRequest);
 }

 function GeocodeCallback(result)
 {
   //alert("Found location: " + result.resourceSets[0].resources[0].name);

	if (result &&
		   result.resourceSets &&
		   result.resourceSets.length > 0 &&
		   result.resourceSets[0].resources &&
		   result.resourceSets[0].resources.length > 0)
	{
	   // Set the map view using the returned bounding box
	   var bbox = result.resourceSets[0].resources[0].bbox;
	   var viewBoundaries = Microsoft.Maps.LocationRect.fromLocations(new Microsoft.Maps.Location(bbox[0], bbox[1]), new Microsoft.Maps.Location(bbox[2], bbox[3]));
	   bing_map.setView({ bounds: viewBoundaries});

	   // Add a pushpin at the found location
	   var location = new Microsoft.Maps.Location(result.resourceSets[0].resources[0].point.coordinates[0], result.resourceSets[0].resources[0].point.coordinates[1]);
	   var pushpin = new Microsoft.Maps.Pushpin(location);
	   bing_map.entities.push(pushpin);
	}
	else
	{
			document.getElementById("map-birdseye").className = "no-map"; 
			document.getElementById("map-street").innerHTML='<p class="msg negative">We\'re sorry, but Bing Birdseye is currently unavailable for this property.</p>'
	}
 }

 function CallRestService(request)
 {
	var script = document.createElement("script");
	script.setAttribute("type", "text/javascript");
	script.setAttribute("src", request);
	document.body.appendChild(script);
 }

	
</script>
<?php if(get_option('sc-layout-ariealmap',false)){ ?> 				
	<div class="well3">
	<ul class="nav nav-tabs" id="mapTab">
	  <?php if(get_option('sc-layout-google-ariealmap',false)){ ?> 
	  <li class="active">
		<a data-toggle="tab" href="#sp_map_tab"><?php _e("Map","soldpress")?><!--<i class="icon-map-marker"></i>--></a>
	  </li>
	   <?php }?>
	  <?php if(get_option('sc-layout-streetviewmap',false)){ ?> 
	  <li>
		<a data-toggle="tab" href="#sp_street_tab"><?php _e("Street View","soldpress")?><!--<i class="icon-road"></i>--></a>
	  </li>
	  <?php }?>
	    <?php if(get_option('sc-layout-birdseye',false)){ ?> 
	  <li>
		<a data-toggle="tab" href="#sp_birdseye_tab"><?php _e("Birds Eye","soldpress")?><!--<i class="icon-road"></i>--></a>
	  </li>
	  <?php }?>
	  <?php if(get_option('sc-layout-walkscore',false)){ ?> 
	  <li>
		<a data-toggle="tab" href="#sp_walkscore_tab"><?php _e("WalkScore","soldpress")?></a>
	  </li>
	  <?php }?>
	</ul>
 
	<div class="tab-content">
		<div id="myTabContent" class="tab-content">
		 <?php if(get_option('sc-layout-google-ariealmap',false)){ ?> 
		  <div class="tab-pane active" id="sp_map_tab">
			<div id="map-canvas" class="well-map"></div>
		  </div>
		   <?php }?>
		   <?php if(get_option('sc-layout-streetviewmap',false)){ ?> 
		  <div class="tab-pane" id="sp_street_tab">	
			<div id="map-street" class="well-map"></div>
		  </div>
		  <?php }?>
		  <?php if(get_option('sc-layout-birdseye',false)){ ?> 
		  <div class="tab-pane" id="sp_birdseye_tab">
			<?php 	
				if(empty($bingapi))
				{
					echo 'bing api missing';
				}	
			?>
			 <div id="map-birdseye" class="well-map" style="position:relative"></div>
		  </div>
		  <?php }?>
		  <?php if(get_option('sc-layout-walkscore',false)){ ?> 
		  <div class="tab-pane" id="sp_walkscore_tab">
			<iframe marginheight="0" marginwidth="0" height="282px" frameborder="0" scrolling="no" width="100%" src="http://www.walkscore.com/serve-walkscore-tile.php?wsid=<?php echo get_option('sc-layout-walkscore',false); ?>&amp;street=<?php echo soldpress_get_address(); ?>&amp;layout=horizontal&amp;transit_score=true&amp;public_transit=false&amp;commute=true&amp;show_reviews=false&amp;no_link_description=false&amp;map_modules=walkability&amp;height=282&amp;footheight=18&amp;width=500" style="float: left; margin: 0px; outline: none; text-align: left; text-decoration: none; padding: 0px; font-style: normal; font-variant: normal; letter-spacing: normal; word-spacing: normal; text-transform: none; vertical-align: baseline; text-indent: 0px; text-shadow: none; white-space: normal; background-image: none; background-color: transparent; border: 0px;">
			</iframe>
			</div>
			<?php }?>
		</div>
	</div>
	</div>
<?php } 
}
?>