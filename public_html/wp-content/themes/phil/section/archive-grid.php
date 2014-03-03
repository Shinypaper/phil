<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $active_tab;
	
	$max_per_row = get_option( 'sc-layout-propertylistings-cloumns',3 );
	$item_grid_count = 0;	
	
	$gridSpan = 'span3';
	if($max_per_row == 1)
	{
		$gridSpan = 'span6';
	}
	else if($max_per_row == 2)
	{
		$gridSpan = 'span4';
	}
	else
	{
		$gridSpan = 'span3';
	}
?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
	if($item_grid_count == 0){
		echo '<div class="' . sp_responsive_css_row() . '" >';
	}
?>
	<div class="<?php echo $gridSpan; ?> listing-wrapper"> 
			<div class="listing">
				<div class="top">
					<div class="inner-border">
						<div class="inner-padding">
							<figure>
							  <?php $postmeta = get_post_meta($post->ID);
							  $listing_key = $postmeta['dfd_ListingKey'][0];
					echo '<a href="' . get_permalink() . '"><img alt="'. get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true) .'" src="' . sp_get_default_listing_image($listing_key) . '" /></a>';
					?>
							<?php if(get_post_meta($post->ID,'dfd_ListPrice',true) == 0) {?>
							<div class="banner"> <?php _e('For Rent','soldpress') ?></div>
							<?php } else { ?>
							<div class="banner"> <?php _e('For Sale','soldpress') ?></div>
							<?php } ?>
							</figure>
							<h3><a href="<?php the_permalink(); ?>"> <?php echo get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true); ?></a></h3>
							<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_StateOrProvince', true ) ); ?></p>
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
	</div>	<!--en -->
<?php
if($item_grid_count == $max_per_row){
	echo '</div>';
	$item_grid_count = 0;
}
else
{
	$item_grid_count = $item_grid_count +1;
}

?>	
<?php endwhile; ?>
<?php
if($item_grid_count != ($max_per_row+1)){
	if( $item_grid_count != 0)
	{
		echo '</div>';
	}
}
?>	
