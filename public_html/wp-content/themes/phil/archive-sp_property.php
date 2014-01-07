<?php
/**
 *
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 soldpress_template_property_script();
 $active_tab = isset( $_GET[ 'type' ] ) ? $_GET[ 'type' ] : 'grid'; 
	
?>

<?php if(get_option('sc-layout-header',false) == false){ get_header(); } ?>	
<?php echo apply_filters('soldpress_template_archive_start', ''); ?>
<div class="wrapper">
	<div class="wrapper_inner">
		<?php soldpress_template_archive();?>	
	</div>
</div>
<?php echo apply_filters('soldpress_template_archive_end', '');?>
<?php if(get_option('sc-layout-header',false) == false){ get_footer(); } ?>	