<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	//Single Listing Code
	function sp_shortcode_listing($atts, $content = null, $code = "") {	
	
		global $wp_query;
		global $wpdb;
	    global $id;
		
		$defaults = array(
			'id'	 => '',
			'before' => '',
			'after'  => '',
			'wrap'	 => 'div',
			'listingkey'  => '',
			'listingtype' => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );
		
		if($listingkey != '')
		{
			
			$selectQuery = $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value like %s", 'dfd_ListingKey', $listingkey);
			$p = $wpdb->get_row($selectQuery);
			if($p){
				$id = $p->post_id;
			}
		}
		else
		{
			if($id == '')
			{
				//If no Id Listing Key or Id Get Random
				$selectQuery = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='sp_property' ORDER BY RAND() LIMIT %d", 1);
				
				$p = $wpdb->get_row($selectQuery);
				if($p){
					$id = $p->ID;
				}	
			}					 
		}
				
		if ( isset( $id ) ) 
		{
			if($id  != '')
			{
				$post = get_post($id);	
				if($post)
				{
					ob_start();			
					if($listingtype == 'full')
					{		
						echo 'In Development';
						//include_once(SOLDPRESS_TEMPLATE_DIR . 'sp_property_section.php');	
						//soldpress_template_property_single_content_main_shortcode();	
					}
					else
					{	
						echo '<div class="sp properties">';	
						soldpress_template_feature_property_shortcode();
						echo '</div>';							
					}			
					
					$output_string = ob_get_contents();				
					ob_end_clean();	
				}
				else
				{
					$output_string = apply_filters( 'soldpress_no_listings', 'Sorry, no listings matched your criteria' ) ;
				}
				
				$output = sprintf( '<%4$s class="sp">%1$s%3$s%2$s</%4$s>', $before, $after, $output_string, $wrap );
				
				wp_reset_query();
				return $output;	
			}			
		}
		
		return "";
	}	
	
	add_shortcode("soldpress-listing","sp_shortcode_listing");		
?>