<?php
	/**
	 * @author 		Sanskript Solutions
	 * @version     1.2.0
	 */
	$sp_slideshow = array();
	/*$photos       = get_children(array(
					'post_parent' => get_the_ID(),
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'order' => 'ASC',
					'orderby' => 'menu_order ID'
	));
	if ($photos) {
		*/			
			
					$photosCount = get_post_meta($post->ID,'dfd_PhotosCount',true) ;					
					$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
					$wp_upload_dir = wp_upload_dir(); 
					
					$photoindex = $photosCount - 1;
					for ($i=0; $i<=$photoindex; $i++)
					{
						$filename      = $post->post_name . '-' . $type . '-' . $i . '.jpg';
						$fileurl      = $wp_upload_dir['baseurl'] . '/soldpress/' . $filename;		
						$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;
		
						if(file_exists ($filepath))
						{						
							$sp_slideshow[]    = $fileurl;			
						}						
					}			
									
				/*	foreach ($photos as $photo) {
									$sp_slideshowimage = wp_get_attachment_url($photo->ID, 'thumbnail');
									$sp_slideshow[]    = $sp_slideshowimage;
					} 
	} */
	if ($sp_slideshow) {
?>	
				 <div class="flexslider sp-no-print">
					<ul class="thumbnails-no slides">
					<?php			
					
					$unparsedAddress = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true));	
					
					foreach ($sp_slideshow as &$sp_slideshowimage) {
									echo '<li><a class="thumbnail" href="' . $sp_slideshowimage . '" data-pp="prettyPhoto[gallery]"><img class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $unparsedAddress .'" /></a></li>';
					} 
					
					?>
					</ul>
				</div>
								
<?php
	} 
?>