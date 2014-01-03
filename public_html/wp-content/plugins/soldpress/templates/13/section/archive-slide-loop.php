<?php
/**
 * @author 		Sanskript Solutions, Inc.
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $active_tab
?>
<ul id="prop_bxslider" class="bxslider">	
<?php while ( have_posts() ) : the_post(); ?>
<li> 
<div class="<?php echo 'span12'; ?> listing-wrapper">
			<div class="listing">
				<div class="top">
					<div class="inner-border">
						<div class="inner-padding">
							<figure>
							     <?php 
					echo '<a href="' . get_permalink() . '"><img alt="'. get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true) .'" src="' . sp_get_default_listing_image($post->post_excerpt) . '" /></a>';
					?>
							<?php if(get_post_meta($post->ID,'dfd_ListPrice',true) == 0) {?>
							<div class="banner"> <?php _e('For Rent','soldpress') ?></div>
							<?php } else { ?>
							<div class="banner"> <?php _e('For Sale','soldpress') ?></div>
							<?php } ?>
							</figure>
							<h3><a href="<?php the_permalink(); ?>"> <?php echo get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true); ?></a></h3>
							<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?></p>
						</div>
					</div>
						
				</div>
				<div class="bottom">
				<div class="inner-border">
					<div class="inner-padding">
						<p>
							<?php echo get_post_meta(get_the_ID(),'dfd_BedroomsTotal',true); ?> bedrooms + <?php echo get_post_meta(get_the_ID(),'dfd_BathroomsTotal',true); ?> bathrooms </p> 
					</div>
				</div>
				</div>
			</div>
			<div class="price-wrapper" style="display: block;">			
				<div class="price"><?php echo sp_get_the_property_price(get_the_ID())  ?></div>				
			</div>
		</div>	
</li>
<?php endwhile; ?>
</ul>

