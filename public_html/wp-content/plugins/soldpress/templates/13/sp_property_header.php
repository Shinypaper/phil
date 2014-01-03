<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'soldpress_page_title' ) ) {

	function soldpress_page_title() {
		$page_title = the_title();		
	    echo apply_filters( 'soldpress_page_title', $page_title );
	}
}

?>

<?php if ( apply_filters( 'soldpress_show_page_title', true ) ) : ?>
	
<div class="<?php echo sp_responsive_css_row(); ?>">	
<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
?>
<div class="search-bar">
		<div class="search-title">
			<div class="search-title">
				<div class="inner">
					<div class="pull-left custom-margin">
						<?php _e('MLS','soldpress') ?>: <?php echo get_post_meta($post->ID,'dfd_ListingId',true); ?>
						
					</div>
					<div class="pull-right results-per-page custom-margin">
						<span class="text-line"><?php echo sp_get_property_price(); ?></span>
					</div>
				</div>
			</div>
			
			<div class="search-bottom">
				<div class="inner">
					<div class="pull-left custom-margin">
						<strong> <h1 itemprop="name"><?php soldpress_page_title(); ?></h1>	</strong>
					</div>
					<div class="pull-right view-type custom-margin">

					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php endif; ?>