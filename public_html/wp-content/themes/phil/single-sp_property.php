<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Load CSS and Java Script
soldpress_template_property_script();

add_action('wp_head', 'sp_analytics');
				
$sp_raw_xml = get_post_meta($post->ID,'dfd_xml',true); 				
if($sp_raw_xml != '')
{
	$sp_property_xml = simplexml_load_string($sp_raw_xml,"SimpleXMLElement", LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOWARNING); 
}
			
include_once(SOLDPRESS_TEMPLATE_DIR.'/sp_property_section.php');	

	
?>
	
<?php if(get_option('sc-layout-header',false) == false){ get_header(); } ?>	
<?php echo apply_filters('soldpress_template_single_start', '');?>
<div class="container">
	<div class="main">
		<?php soldpress_template_single();?>	
	</div>
</div>
<?php echo apply_filters('soldpress_template_single_end', ''); ?>
<?php if(get_option('sc-layout-footer',false) == false){ get_footer(); } ?>