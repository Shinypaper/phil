<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	//Single Listing Code
	function sp_shortcode_listing_output($atts, $content = null, $code = "") {	
	
		global $wp_query;
		global $wpdb;
	    global $id;
		
		$defaults = array(
			'id'	 => '',
			'before' => '',
			'after'  => '',
			'wrap'	 => 'div',
			'listingkey'  => '',
			'dfdtype' => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );
		
		if(!empty($listingkey))
		{		
			$selectQuery = $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value like %s", 'dfd_ListingKey', $listingkey);
			$p = $wpdb->get_row($selectQuery);
			if($p){
				$id = $p->post_id;
			}
			
			$output	= get_post_meta( $id, 'dfd_'.$dfdtype,true);
			
			wp_reset_query();
			
			return $output;				
		}
		
		return "";
	}	
	
	add_shortcode("soldpress-output","sp_shortcode_listing_output");		
?>