<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	function sp_shortcode_listings($atts, $content = null, $code = "") {	

		include_once(SOLDPRESS_TEMPLATE_DIR.'/sp_property_section.php');	
		
		global $wp_query;
		global $title;
		
		$defaults = array(			
			'type'     => 'grid',
			'before' => '',
			'after'  => '',
			'wrap'	 => 'div',
			'title' => ''
		  );
		  
		extract( shortcode_atts( $defaults, $atts ) );
		
		$shorcode = "sc";
		
		if(!empty($atts))
		{
			foreach ( $atts as $key =>  $val)
			{		
				if(strstr($key, 'dfd'))
				{
					$metaquery[] = array(
													'key' => $key,
													'value' => $val,
													'compare' => 'LIKE'
									);  
				}
			}
		}
		
		if(empty($metaquery))
		{
			$shorcode = "";
		}
							
		global $active_tab;							
		$active_tab = isset( $_GET[ 'type' ] ) ? $_GET[ 'type' ] : 'grid'; 	
		include(SOLDPRESS_TEMPLATE_DIR . '/archive-filter.php');
		
		global $post;

		ob_start();	
		if ( have_posts() ) 
		{	
			soldpress_template_property_archive_content_main_shortcode();
		}
		else
		{
			echo apply_filters( 'soldpress_no_listings', 'Sorry, no listings matched your criteria' ) ;
		}
		
		$output_string = ob_get_contents();				
		ob_end_clean();			
		$output = sprintf( '<%4$s class="sp">%1$s%3$s%2$s</%4$s>', $before, $after, $output_string, $wrap );
		
		wp_reset_query();
		return $output;	

		
	}		

	add_shortcode("soldpress-listings", "sp_shortcode_listings");
	
?>