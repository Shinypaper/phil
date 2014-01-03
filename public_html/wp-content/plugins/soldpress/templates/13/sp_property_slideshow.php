<?php
	/**
	 * @author 		Sanskript Solutions
	 * @version     1.3.0
	 */
	 
		$sp_slideshow = sp_get_property_images();
		$image_description = sp_get_property_image_description();
					
		if ($sp_slideshow) {
				
			$result = count($sp_slideshow);
			
			if($result == 1)
			{
			
				foreach ($sp_slideshow as &$sp_slideshowimage) 
				{
				
						echo '<div class="flexslider sp-no-print"><ul class="thumbnails"><li class="thumbnail"><a href="' . $sp_slideshowimage . '" class="swipebox"><img itemprop="image" class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li></ul></div>';					
				} 
			}
			else
			{
	?>	
	
		<div class="flexslider sp-no-print">
						<ul class="thumbnails1-no slides">
						<?php			
							$image_schema_org_count = 0;	
							/*foreach ($sp_slideshow as &$sp_slideshowimage) 
							{
											if($image_schema_org_count == 0){
												echo '<li><a href="' . $sp_slideshowimage . '" data-pp="sp_prettyPhoto[gallery]"><img itemprop="image" class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li>';
											}
											else
											{
												echo '<li><a  href="' . $sp_slideshowimage . '" data-pp="sp_prettyPhoto[gallery]"><img class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li>';
											}
											$image_schema_org_count++;
							} */
							
							foreach ($sp_slideshow as &$sp_slideshowimage) 
							{
											if($image_schema_org_count == 0){
												echo '<li><a href="' . $sp_slideshowimage . '" class="swipebox"><img itemprop="image" class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li>';
											}
											else
											{
												echo '<li><a  href="' . $sp_slideshowimage . '" class="swipebox"><img class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li>';
											}
											$image_schema_org_count++;
							} 
						
						?>
						</ul>
					</div>
									
<?php
			} 
	} 
?>