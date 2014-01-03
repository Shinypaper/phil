<?php
/**
 * @author 		Sanskript Solutions, Inc.
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php while ( have_posts() ) : the_post(); ?>					
	<div class="listing featured-list">
					<div class="top">
						<div class="inner-border">
							<div class="inner-padding">
							   <?php 
					/*	$photos = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
						if ($photos) {
								foreach ($photos as $photo) {
									echo '<figure><a href="' . get_permalink() . '"><image src="' . wp_get_attachment_url($photo->ID,'thumbnail') . '" /></a></figure>';
									break;
								}
						}else{
								echo '<figure><a href="' .   get_permalink()  . '"><image src="' . plugins_url( 'images/soldpress.jpg' , __FILE__ ) . '" /></a></figure>';
						}*/
						
						echo '<figure><a href="' . get_permalink() . '"><image src="' . sp_get_default_listing_image($post->post_name) . '" /></a></figure>';
						?>
								<div class="right">
									<h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>									
									<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_StateOrProvince', true ) ); ?></p>
									<div class="description"><p>
									<?php									
										echo sp_limit_text(get_post_meta( get_the_ID(), 'dfd_PublicRemarks', true ),25) 
									?></p>
									</div>
									<?php if(get_post_meta(get_the_ID(), 'dfd_ListPrice', true ) != 0) { ?>
									<div class="price-wrapper">			
										<div class="price">$<?php echo esc_html( number_format(get_post_meta( get_the_ID(), 'dfd_ListPrice', true ))); ?></div>				
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						
					</div>
					<div class="bottom">
						<div class="inner-border">
							<div class="inner-padding">
								<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_BedroomsTotal', true ) ); ?>  beds  +  <?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_BathroomsTotal', true ) ); ?> baths  +  <?php 
								if(get_post_meta( get_the_ID(), 'dfd_LotSizeArea', true ) != 0 ){
									echo esc_html( get_post_meta( get_the_ID(), 'dfd_LotSizeArea', true ) .' '. get_post_meta( get_the_ID(), 'dfd_LotSizeUnits', true )); 
								}
								else{
									echo esc_html(get_post_meta( get_the_ID(), 'dfd_BuildingAreaTotal', true ).' ' . get_post_meta( get_the_ID(), 'dfd_BuildingAreaUnits', true )); 
								}
								?></p>
							</div>
						</div>
					</div>
				</div>
<?php endwhile; ?>