<?php
/**
 * @author 		Sanskript Solutions, Inc.
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $active_tab
?>
		
<div class="listing featured-list <?php echo $post->ID ?>">
	<div class="top">
		<div class="inner-border">
			<div class="inner-padding">
			   <?php  echo '<figure><a href="' . get_permalink($post->ID) . '"><image width="244" height="163" src="' . sp_get_default_listing_image(get_post_meta($post->ID,'dfd_ListingKey',true)) . '" class="attachment-property-thumb-image wp-post-image" alt="14 Steed Crt, Brantford" title="14 Steed Crt, Brantford"/></a></figure>';
			   ?> 
				<div class="right">
					<h3><a href="<?php echo get_permalink($post->ID); ?>"> <?php echo $post->post_title; ?></a></h3>									
					<p><?php echo esc_html( get_post_meta( $post->ID, 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( $post->ID, 'dfd_StateOrProvince', true ) ); ?></p>
					<div class="description"><p>
					<?php									
						echo sp_limit_text(get_post_meta( $post->ID, 'dfd_PublicRemarks', true ),25) 
					?></p>
					</div>
					<?php if(get_post_meta($post->ID, 'dfd_ListPrice', true ) != 0) { ?>
					<div class="price-wrapper">			
						<div class="price"><?php echo sp_get_property_price() ?></div>				
					</div>
					<?php } ?>
				</div>
			</div>
		</div>		
	</div>
	<div class="bottom">
		<div class="inner-border">
			<div class="inner-padding">
				<p><?php echo esc_html( get_post_meta( $post->ID, 'dfd_BedroomsTotal', true ) ); ?>  <?php _e('beds','soldpress') ?>  +  <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_BathroomsTotal', true ) ); ?> <?php _e('baths','soldpress') ?>  
				<?php 								
					$v = get_post_meta( $post->ID, 'dfd_LotSizeArea', true );
					$mesurment = get_option("sc-layout-metric"); 
					if($v!= "0"){							
						if(!empty($v))
						{			
							if($mesurment == 'imperial')
							{
								echo '+ ' . sp_squaremeter_to_squarefeet($v) . ' Square Feet' ;
							}
							else
							{
								echo '+ ' .  $v . ' ' .get_post_meta($post->ID,'dfd_LotSizeUnits',true); 
							}						
						}
					}
					else
					{				
						$v = get_post_meta( $post->ID, 'dfd_BuildingAreaTotal', true );
						if($v!= "0")
						{							
							if(!empty($v))
							{			
								if($mesurment == 'imperial')
								{
									echo '+ ' . sp_squaremeter_to_squarefeet($v) . ' Square Feet' ;
								}
								else
								{
									echo '+ ' .  $v . ' ' .get_post_meta($post->ID,'dfd_BuildingAreaUnits',true); 
								}								
							}
						}
					}				
				?></p>
			</div>
		</div>
	</div>
</div>
