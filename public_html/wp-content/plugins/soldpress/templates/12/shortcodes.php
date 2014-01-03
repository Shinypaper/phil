<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 


class sp_shortcodes {
	
	static function search($atts, $content = null, $code = "") {	
	
		$defaults = array(
			'show_propertytype'	 => true,
			'show_city' => true,
			'show_price'  => true,
			'show_bedrooms'	 => true,
			'show_bathroom' => true,
			'show_price'  => true,
			'show_address'	 => true,
			'show_mls' => true			
		);
		
		extract( shortcode_atts( $defaults, $atts ) );	
		
		global $wp_query;
		ob_start();
		include(dirname(__FILE__).'/section/templates/bootstrap/search-form.php');		
		$output_string = ob_get_contents();
		
		ob_end_clean();
		return $output_string;
	}	
	
	//Feature Listing
	static function listing($atts, $content = null, $code = "") {	

		include_once(dirname(__FILE__).'/sp_functions.php');		
		global $wp_query;
		
		//$listingKey = $atts["ListingKey "];

		$defaults = array(
			'id'	 => get_the_ID(),
			'before' => '',
			'after'  => '',
			'wrap'	 => 'div'
		);
	
		extract( shortcode_atts( $defaults, $atts ) );
		
		if ( isset( $id ) ) 
		{
			$post = get_post($id);				
			ob_start();			
			include(dirname(__FILE__).'/section/templates/bootstrap/feature-property.php');			
			$output_string = ob_get_contents();				
			ob_end_clean();			
			$output = sprintf( '<%4$s class="sp">%1$s%3$s%2$s</%4$s>', $before, $after, $output_string, $wrap );
			return $output;		
		}
		
		return "";
	}	
		
}
	add_shortcode("soldpress-search", array("sp_shortcodes", "search"));
	add_shortcode("soldpress-listing", array("sp_shortcodes", "listing"));
		
?>