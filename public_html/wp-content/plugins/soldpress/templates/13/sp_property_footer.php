<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'soldpress_footer_powered_title' ) ) {

	function soldpress_footer_powered_title() {	
	    echo apply_filters( 'soldpress_footer_powered_title_filter', 'Powered by <a title="SoldPress" href="http://www.soldpress.com">SoldPress</a>. <!-- ©2013 Sanskript Solutions, Inc. All rights reserved.-->' );
	}
}

?>
<section>
	<p>
		<small>
			<img alt="realtor association logo" src="<?php echo SOLDPRESS_IMAGES_URL .'realtor.jpg'; ?>" /> <img alt="mls logo" src="<?php echo SOLDPRESS_IMAGES_URL . 'mls.jpg'; ?>" /> <?php _e('MLS®, REALTOR®, and the associated logos are trademarks of The Canadian Real Estate Association','soldpress') ?>
		</small> 
	</p> 
	<?php if ( apply_filters( 'soldpress_show_page_powered', true ) ) : ?>
	<p>
		<small>
			<?php soldpress_footer_powered_title() ?>
		</small>
	</p>
	<?php endif; ?>
</section>
