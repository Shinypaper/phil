<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	function sp_shortcode_search($atts, $content = null, $code = "") {	
	
		global $show_propertytype;
		global $show_city;
		global $show_price;
		global $show_bedrooms;
		global $show_bathroom;
		global $show_address;
		global $show_mls;
		global $show_waterfront;
		global $show_province;
		global $show_transaction;
		
		$defaults = array(
			'show_propertytype'	 => true,
			'show_city' => true,
			'show_price'  => true,
			'show_bedrooms'	 => true,
			'show_bathroom' => true,
			'show_price'  => true,
			'show_address'	 => true,
			'show_mls' => true,
			'show_province' => true,
			'show_transaction' => true	
		);
		
		extract( shortcode_atts( $defaults, $atts ) );	
		
		ob_start();
				
		soldpress_template_search_shortcode();
		
		$output_string = ob_get_contents();
		
		ob_end_clean();
		
		return $output_string;
	}	//p

	add_shortcode("soldpress-search", "sp_shortcode_search");	
?>