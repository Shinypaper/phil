<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php // check if the repeater field has rows of data
	$images = array();

	$featured_image = sp_get_property_images();
	if( have_rows('custom_images') ):
	 
	 	// loop through the rows of data
	    while ( have_rows('custom_images') ) : the_row();
	 
	        // display a sub field value
	        $images[] = get_sub_field('custom_image');
	    endwhile;
	  
	endif; 

		if (count($featured_image) < 1 AND count($images) > 0 ) {
			$featured_image = $images;
		}
?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php
	/**
	 * @author 		Sanskript Solutions
	 * @version     1.3.0
	 */
	 
		$sp_slideshow = $featured_image;
		$image_description = sp_get_property_image_description();
					
		if ($sp_slideshow) {
				
			$result = count($featured_image);
			if($result == 1)
			{
			
				foreach ($featured_image as &$sp_slideshowimage) 
				{
						print_r($sp_slideshowimage);
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