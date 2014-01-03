<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$max_per_row = 3;
	$item_grid_count = 0;	
?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
	if($item_grid_count == 0){
		echo '<div class="' . sp_responsive_css_row() . '" >';
	}
?>
	<div class="span3 listing-wrapper">
			<div class="listing">
				<div class="top">
					<div class="inner-border">
						<div class="inner-padding">
							  <?php 
							  /*
					$photos = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
					if ($photos) {
							foreach ($photos as $photo) {
							
								echo '<figure><a href="' . get_permalink() . '"><img alt="'. get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true) .'" src="' . wp_get_attachment_url($photo->ID,'thumbnail') . '" /></a></figure>';
								break;
							}
					}else{
							echo '<figure><a href="' .   get_permalink()  . '"><img alt="Blank Image" src="' . plugins_url( 'images/soldpress.jpg' , __FILE__ ) . '" /></a></figure>';
					}*/
	
					echo '<figure><a href="' . get_permalink() . '"><img alt="'. get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true) .'" src="' . sp_get_default_listing_image($post->post_name) . '" /></a></figure>';
					?>
							<h3><a href="<?php the_permalink(); ?>"> <?php echo get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true); ?></a></h3>
							<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_StateOrProvince', true ) ); ?></p>
						</div>
					</div>
					
				</div>
			</div>
			<?php if(get_post_meta(get_the_ID(), 'dfd_ListPrice', true ) != 0) { ?>
			<div class="price-wrapper" style="display: block;">			
				<div class="price">$<?php echo esc_html( number_format(get_post_meta( get_the_ID(), 'dfd_ListPrice', true ))); ?></div>				
			</div>
			<?php } ?>
		</div>	
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
if($item_grid_count != $max_per_row){
	if( $item_grid_count != 0)
	{
		echo '</div>';
	}
}
?>	
