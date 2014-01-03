<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sp_trace($text)
{
	echo "<!--<trace>";
	echo $text . "</trace>--->";
}

function sp_let_to_num( $size ) {
     $l      = substr( $size, -1 );
     $ret    = substr( $size, 0, -1 );
     switch( strtoupper( $l ) ) {
         case 'P':
           $ret *= 1024;
         case 'T':
             $ret *= 1024;
         case 'G':
            $ret *= 1024;
        case 'M':
            $ret *= 1024;
         case 'K':
             $ret *= 1024;
     }
    return $ret;
 }	

function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a rel="nofollow" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><a rel="nofollow" href="#">…</a></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a rel="nofollow" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><a rel="nofollow" href="#">…</a></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a rel="nofollow" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}


function sp_get_default_listing_image($postid) {

	//Get PostId
		global $post;
	
		$private = get_post_meta($post->ID,'sc_private',true) ;		
		$default_image = get_option("sc-default-no-image");
		if(empty($default_image))
		{
			$default_image = plugins_url( 'images/soldpress-nophoto.png' , __FILE__ );
		}
		
		if($private == 1)
		{
			 $args = array(
			   'post_type' => 'attachment',
			   'numberposts' => -1,
			   'post_status' => null,
			   'post_parent' => $post->ID
			  );

			  $attachments = get_posts( $args );
				 if ( $attachments ) 
				 {
					
					foreach ( $attachments as $attachment ) 
					{
					   $image_attributes = wp_get_attachment_image_src( $attachment->ID ); // returns an array
					   $fileurl = $image_attributes[0];	
					   break;
					}
				 }
		}
		else
		{				
			$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
			$filename      = $postid . '-' . $type . '-' . '0' . '.jpg';		
			$filepath     = SOLDPRESS_BASEUPLOAD_FILE . '/' . $filename;
			if(file_exists($filepath))
			{
				$size = getimagesize($filepath);
				if($size)
				{
					$fileurl = SOLDPRESS_BASEUPLOAD_URL  . '/' . $filename;
				}
				else
				{
					$fileurl = $default_image;
				}
			}
			else
			{
				$fileurl =  $default_image;
			}
		}
		
		return $fileurl ;
}

function sp_limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
	  $words = str_word_count($text, 2);
	  $pos = array_keys($words);
	  $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

//
// BootStrap Functions
//

function sp_responsive_css_row($css = '')
{
	//$isResponsive = get_option( 'sc-layout-responsive',1 );
	//if($isResponsive == 1){
		$isFluid = get_option( 'sc-layout-responsive-fluid',1 );
		if($isFluid)
		{
			$css = 'row-fluid ' .$css;
		}
		else
		{
			$css = 'row ' .$css;
		}
	//}else{
	//	$css = 'row ' .$css;
	//}
	
	return $css;
}

function sp_responsive_css_container($css = '')
{
	//$isResponsive = get_option( 'sc-layout-responsive',1 );
	//if($isResponsive == 1){
		$isFluid = get_option( 'sc-layout-responsive-fluid',1 );
		if($isFluid)
		{
			$css = 'container-fluid ' .$css;
		}
		else
		{
			$css = 'container ' .$css;
		}
	//}else{
	//	$css = 'container ' .$css;
	//}
	
	return $css;
}

//
//Template Functions
//

add_filter( 'template_include', 'sp_include_template_function', 1 );

function sp_include_template_function( $template_path ) {
	if ( get_post_type() == 'sp_property' ) {
		if ( is_single() ) {
			if ( $theme_file = locate_template( array ( 'single-sp_property.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = SOLDPRESS_TEMPLATE_DIR . '/single-sp_property.php';
			}
		}
	elseif ( is_archive() ) {
			if ( $theme_file = locate_template( array ( 'archive-sp_property.php' ) ) ) {
				$template_path = $theme_file;
			} else { $template_path = SOLDPRESS_TEMPLATE_DIR . 'archive-sp_property.php';
 
			}
		}
	}
	return apply_filters('soldpress_include_template', $template_path); ;
}
	
function soldpress_get_template_part( $slug, $name = '' ) {
	//global $soldpress;
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/soldpress/slug-name.php
	if ( $name )
		$template = locate_template( array ( "{$slug}-{$name}.php", "{SOLDPRESS_TEMPLATE_DIR}{$slug}-{$name}.php" ) );

	// Get default slug-name.php
	if ( !$template && $name && file_exists( SOLDPRESS_TEMPLATE_DIR . "{$slug}-{$name}.php" ) )
		$template = SOLDPRESS_TEMPLATE_DIR . "{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/soldpress/slug.php
	if ( !$template )
		$template = locate_template( array ( "{$slug}.php", "{SOLDPRESS_TEMPLATE_DIR}{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
}

function soldpress_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	global $post;
	
	if ( $args && is_array($args) )
		extract( $args );

	$located = soldpress_locate_template( $template_name, $template_path, $default_path );

	do_action( 'soldpress_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'soldpress_after_template_part', $template_name, $template_path, $located, $args );
}

function soldpress_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	if ( ! $template_path ) $template_path = SOLDPRESS_PLUGIN_URL;
	if ( ! $default_path ) $default_path = SOLDPRESS_TEMPLATE_DIR;

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters('soldpress_locate_template', $template, $template_name, $template_path);
}


if ( ! function_exists( 'soldpress_template_property_script' ) ) {
	function soldpress_template_property_script() {			
		$location = apply_filters( 'soldpress_template_property_script_filter','sp_property_scripts.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_slideshow' ) ) {
	function soldpress_template_property_slideshow() {			
		$location = apply_filters( 'soldpress_template_property_slideshow_filter','sp_property_slideshow.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_heading' ) ) {
	function soldpress_template_property_heading() {			
		$location = apply_filters( 'soldpress_template_property_heading_filter','sp_property_heading.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_social' ) ) {
	function soldpress_template_property_social() {			
		$location = apply_filters( 'soldpress_template_property_social_filter','sp_property_social.php' );		
		soldpress_get_template( $location );
	}
}


if ( ! function_exists( 'soldpress_template_property_disclaimer' ) ) {
	function soldpress_template_property_disclaimer() {			
		$location = apply_filters( 'soldpress_template_property_disclaimer_filter','sp_property_disclaimer.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_archive' ) ) {
	function soldpress_template_archive() {			
		$location = apply_filters( 'soldpress_template_archive','sp_property_archive.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_single' ) ) {
	function soldpress_template_single() {			
		$location = apply_filters( 'soldpress_template_single','sp_property_single.php' );		
		soldpress_get_template( $location );
	}
}


if ( ! function_exists( 'soldpress_template_property_header' ) ) {
	function soldpress_template_property_header() {			
		$location = apply_filters( 'soldpress_template_property_header_filter','sp_property_header.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_footer' ) ) {
	function soldpress_template_property_footer() {			
		$location = apply_filters( 'soldpress_template_property_footer_filter','sp_property_footer.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_mls_data_footer' ) ) {
	function soldpress_template_property_mls_data_footer() {			
		$location = apply_filters( 'soldpress_template_property_mls_data_footer_filter','sp_property_mls_footer.php' );		
		soldpress_get_template( $location );
	}
}


if ( ! function_exists( 'soldpress_template_property_single_content_main' ) ) {
	function soldpress_template_property_single_content_main() {			
		$location = apply_filters( 'soldpress_template_property_single_content_main_filter','section/sp_property_main_section.php' );		
		soldpress_get_template( $location );
	}
}
		
if ( ! function_exists( 'soldpress_template_property_single_content_main_shortcode' ) ) {
	function soldpress_template_property_single_content_main_shortcode() {
		$location = apply_filters( 'soldpress_template_property_single_content_main_shortcode_filter','section/sp_property_main_section.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_single_content_aside' ) ) {
	function soldpress_template_property_single_content_aside() {			
		$location = apply_filters( 'soldpress_template_property_single_content_aside_filter','section/sp_property_main_aside.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_content_main' ) ) {
	function soldpress_template_property_archive_content_main() {			
		$location = apply_filters( 'soldpress_template_property_archive_content_main_filter','section/sp_property_main_section_archive.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_content_main_widget' ) ) {
	function soldpress_template_property_archive_content_main_widget() {			
		$location = apply_filters( 'soldpress_template_property_archive_content_main_widget_filter','section/sp_property_main_section_archive.php' );	
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_content_main_shortcode' ) ) {
	function soldpress_template_property_archive_content_main_shortcode() {			
		$location = apply_filters( 'soldpress_template_property_archive_content_main_shortcode_filter','section/sp_property_main_section_archive.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_content_aside' ) ) {
	function soldpress_template_property_archive_content_aside() {			
		$location = apply_filters( 'soldpress_template_property_archive_content_aside_filter','section/sp_property_main_aside_archive.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_grid' ) ) {
	function soldpress_template_property_archive_grid() {			
		$location = apply_filters( 'soldpress_template_property_archive_grid_filter','section/archive-grid.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_map' ) ) {
	function soldpress_template_property_archive_map() {			
		$location = apply_filters( 'soldpress_template_property_archive_map_filter','section/archive-map.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_list_loop' ) ) {
	function soldpress_template_property_archive_list_loop() {			
		$location = apply_filters( 'soldpress_template_property_archive_list_filter','section/archive-list-loop.php' );		
		soldpress_get_template( $location );
	}
}


if ( ! function_exists( 'soldpress_template_property_archive_slide_loop' ) ) {
	function soldpress_template_property_archive_slide_loop() {			
		$location = apply_filters( 'oldpress_template_property_archive_slide_loop_filter','section/archive-slide-loop.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_archive_slide_loop_shortcode' ) ) {
	function soldpress_template_property_archive_slide_loop_shortcode() {			
		$location = apply_filters( 'soldpress_template_property_archive_slide_loop_shortcode_filter','section/archive-slide-loop-shortcode.php' );		
		soldpress_get_template( $location );
	}
}


if ( ! function_exists( 'soldpress_template_property_archive_list' ) ) {
	function soldpress_template_property_archive_list() {			
		$location = apply_filters( 'soldpress_template_property_archive_list_filter','section/archive-list.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_feature_property' ) ) {
	function soldpress_template_feature_property() {			
		$location = apply_filters( 'soldpress_template_feature_property_filter','aside/feature-property.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_feature_property_shortcode' ) ) {
	function soldpress_template_feature_property_shortcode() {			
		$location = apply_filters( 'soldpress_template_feature_property_shortcode_filter','aside/feature-property.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_property_map' ) ) {
	function soldpress_template_property_map() {			
		$location = apply_filters( 'soldpress_template_property_map_filter','section/sp_property_map_section.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_search_widget' ) ) {
	function soldpress_template_search_widget() {
		$location = apply_filters( 'soldpress_template_search_widget_filter','aside/search-form.php' );		
		soldpress_get_template( $location );
	}
}

if ( ! function_exists( 'soldpress_template_search_shortcode' ) ) {
	function soldpress_template_search_shortcode() {
	
		$location = apply_filters( 'soldpress_template_search_shortcode_filter','aside/search-form.php' );		
		soldpress_get_template( $location );
	}
}

function sp_get_xml_single($sp_property_xml,$experssion)
{
	if($sp_property_xml != null)
	{
		$result = $sp_property_xml->xpath($experssion);	
		foreach ((array)$result as $title) { 
			return	$title;				
		}
	}
}

function sp_squaremeter_to_squarefeet($m){
	return round($m * 10.764);
}

//Get Post Functions

function soldpress_get_address()
{
	global $post;
	$address = addslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
	return $address ;
}

function soldpress_get_full_address()
{
	global $post;
	$address = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
	return $address ;					
}

function sp_get_address_parsed()
{
		global $post;
		
		$address = "";
		
		if(get_post_meta($post->ID,'dfd_UnparsedAddress',true)!= "")
		{
			$address = $address . get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ';		
		}
		if(get_post_meta($post->ID,'dfd_City',true)!= "")
		{
			$address = $address . get_post_meta( $post->ID, 'dfd_City', true ) . ', ';
		}
		if(get_post_meta($post->ID,'dfd_StateOrProvince',true)!= "")
		{
		$address = $address . get_post_meta( $post->ID, 'dfd_StateOrProvince', true ) . ', ';	
		}
		if(get_post_meta($post->ID,'dfd_PostalCode',true)!= "")
		{
		$address = $address . get_post_meta( $post->ID, 'dfd_PostalCode', true ) . ', ';	
		}
		
		return $address;
}

function sp_get_the_property_image_description($id)
{
	$unparsedAddress = stripslashes(get_post_meta($id,'dfd_UnparsedAddress',true));
	return $unparsedAddress;
}

function sp_get_property_image_description()
{
	global $post;
	$unparsedAddress = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true));
	return $unparsedAddress;
}

function sp_get_the_property_images_filepath($post_id,$post_excerpt)
{
	$sp_slideshow = array();	
	$private = get_post_meta($post_id,'sc_private',true) ;	
	
	if($private == 1)
	{
		 $args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post_id
		  );

		  $attachments = get_posts( $args );
			 if ( $attachments ) 
			 {
				$image_attributes = wp_get_attachment_image_src( $attachment->ID ); // returns an array
				
				foreach ( $attachments as $attachment ) {
				   $sp_slideshow[]    = $image_attributes[0];	
				  }
			 }
	}
	else
	{
		$photosCount = get_post_meta($post_id,'dfd_PhotosCount',true) ;					
		$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
		$wp_upload_dir = wp_upload_dir(); 
		
		$photoindex = $photosCount - 1;
		for ($i=0; $i<=$photoindex; $i++)
		{
			$filename      = $post_excerpt . '-' . $type . '-' . $i . '.jpg';
			$fileurl      = $wp_upload_dir['baseurl'] . '/soldpress/' . $filename;		
			$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;

			if(file_exists ($filepath))
			{						
				$sp_slideshow[]    = $filepath;			
			}						
		}
	}
	
	return $sp_slideshow;
}

function sp_get_property_images()
{
	global $post;
	$sp_slideshow = array();	
	$private = get_post_meta($post->ID,'sc_private',true) ;		
	if($private == 1)
	{
		 $args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post->ID
		  );

		  $attachments = get_posts( $args );
			 if ( $attachments ) 
			 {
			
				foreach ( $attachments as $attachment ) 
				{
					$image_attributes = wp_get_attachment_image_src(  $attachment->ID );			
				   $sp_slideshow[]    = $image_attributes[0];	
				}
			 }
	}
	else
	{	
		$photosCount = get_post_meta($post->ID,'dfd_PhotosCount',true) ;					
		$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
		$wp_upload_dir = wp_upload_dir(); 
		
		$photoindex = $photosCount - 1;
		for ($i=0; $i<=$photoindex; $i++)
		{
			$filename      = $post->post_excerpt . '-' . $type . '-' . $i . '.jpg';
			$fileurl      = $wp_upload_dir['baseurl'] . '/soldpress/' . $filename;		
			$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;

			if(file_exists ($filepath))
			{						
				$sp_slideshow[]    = $fileurl;			
			}						
		}
	}
	
	return $sp_slideshow;
}

//Returns Price With Correct Currency and Decimal Postion

function sp_get_property_price_descriprion()
{
	global $post;
	global $sp_property_xml;
	
	$price_description = "";
	
	if(isset($sp_property_xml))
	{
		if(get_post_meta($post->ID,'dfd_ListPrice',true) == 0)
		{
			//Determine if there is a lease value
			$lease = sp_get_xml_single($sp_property_xml,"/PropertyDetails/Lease");
			if(isset($lease))
			{
				$price_description = 'For Lease';
			}
			else
			{
				//Nothing For Now
			}
		}
		else
		{
			$price_description = 'For Sale';	
		}
	}
	else
	{
		$price_description = 'For Sale';		
	}
	
	return $price_description;
} 

function sp_get_the_property_price($id) 
{
	global $sp_property_xml;
	
	if(!isset($sp_property_xml))
	{
		$syncxml = get_post_meta(get_the_ID(),'dfd_xml',true); 	
										
		if(!empty($syncxml))
		{
			$xml = simplexml_load_string($syncxml,"SimpleXMLElement", LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOWARNING); 
		}
		
	}
	else
	{
			$xml = $sp_property_xml;
	}
	
	$price = "";
	if(isset($xml))
	{			
		if(get_post_meta($id,'dfd_ListPrice',true) == 0)
		{
			//Determine if there is a lease value
			$lease = sp_get_xml_single($xml,"/PropertyDetails/Lease");		
			if(isset($lease))
			{
				$leasepertime = sp_get_xml_single($xml,"/PropertyDetails/LeasePerTime");
				if(empty($leasepertime))
				{
					$price = '$' . $lease;
				}
				else
				{
					$price = '$' . $lease . ' / ' . $leasepertime;
				}		
			}
			else
			{
				//Nothing For Now
			
			}
		}
		else
		{
			$price = '$' . number_format(get_post_meta($id,'dfd_ListPrice',true));	
		}
	}
	else
	{
		$price = '$' . number_format(get_post_meta($id,'dfd_ListPrice',true));		
	}
	
	return $price;

}

function sp_get_property_price() 
{
	global $post;
	global $sp_property_xml;
	return sp_get_the_property_price($post->ID);
}

function sp_get_property_description() 
{
	global $post;
	return esc_html( get_post_meta( $post->ID, 'dfd_PropertyType', true ) );
}

function sp_get_property_size($label = false) 
{
	global $post;
	
	$v = get_post_meta( $post->ID, 'dfd_LotSizeArea', true );
	
	$mesurment = get_option("sc-layout-metric"); 
	
	if($v!= "0"){							
		if(!empty($v))
		{			
			if($mesurment == 'imperial')
			{
				$v = sp_squaremeter_to_squarefeet($v);// . ' Square Feet' ;
			}
			else
			{
				$v = $v; //. ' ' .get_post_meta($post->ID,'dfd_LotSizeUnits',true); 
			}						
		}
	}
	else
	{				
		$v = get_post_meta( $post->ID, 'dfd_BuildingAreaTotal', true );
		if($v!= "0")
		{							
			if(!empty($v))
			{			
				if($mesurment == 'imperial')
				{
					$v =  sp_squaremeter_to_squarefeet($v); // . ' Square Feet' ;
				}
				else
				{
					$v =  $v; //. ' ' .get_post_meta($post->ID,'dfd_BuildingAreaUnits',true); 
				}								
			}
		}
	}
	
	return $v;
}

function sp_get_agent_picture() 
{
	global $post;
	if(get_post_meta($post->ID,'sc-sync-picture-agent',true) != ''){	
		if(get_post_meta($post->ID,'sc-sync-picture-agent-file',true) != ''){ 
		
			$wp_upload_dir = wp_upload_dir();  
			$agent_picture = $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-agent-file',true);
		}
	}
	
	return $agent_picture;
}


function sp_get_coagent_picture() 
{
	global $post;
	if(get_post_meta($post->ID,'sc-sync-picture-agent',true) != ''){	
		if(get_post_meta($post->ID,'sc-sync-picture-coagent-file',true) != ''){ 
		
			$wp_upload_dir = wp_upload_dir();  
			$agent_picture = $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-coagent-file',true);
		}
	}
	
	return $agent_picture;
}

function sp_load_xml()
{
	global $post;
	$sp_raw_xml = get_post_meta($post->ID,'dfd_xml',true); 				
	if($sp_raw_xml != '') //use empty
	{
		global $sp_property_xml;
		$sp_property_xml = simplexml_load_string($sp_raw_xml,"SimpleXMLElement", LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOWARNING); 
	}
			
}

if ( ! function_exists( 'sp_analytics' ) ) {
	function sp_analytics() 
	{
		echo '<meta name="soldpress" content="'. SOLDPRESS_PRODUCT_VERSION .'" />'. PHP_EOL;	
		
		global $post;
		
		if(get_option( 'sc-layout-analytics',false)){
		
			$s = get_post_meta($post->ID,'dfd_AnalyticsView',true);
			$s = str_replace("<![CDATA[","",$s);
			$s = str_replace("]]>","",$s);
			echo $s . PHP_EOL;
			
			$s = get_post_meta($post->ID,'dfd_AnalyticsClick',true);
			$s = str_replace("<![CDATA[","",$s);
			$s = str_replace("]]>","",$s);
			echo $s . PHP_EOL;							
							
		}
				
		$address = soldpress_get_full_address();
		
		if (!defined('WPSEO_VERSION'))
		{
			echo '<meta name="description" content="' . get_post_meta($post->ID,'dfd_PublicRemarks',true) . '" />'. PHP_EOL;		
			echo '<meta name="keywords" content="'. $address .'" />'. PHP_EOL;	

			$image_url= sp_get_default_listing_image($post->post_extract);
			
			if(get_option("sc-layout-facebook-og",1) == 1)
			{							
				echo '<meta property="og:title" content="' . get_the_title().'" />'. PHP_EOL;			
				echo '<meta property="og:type" content="website" />'. PHP_EOL;
				echo '<meta property="og:url" content="'. get_permalink() .'" />'. PHP_EOL;
				echo '<meta property="og:image" content="' .  $image_url . '" />'. PHP_EOL;	
				echo '<meta property="og:description" content="' .  get_post_meta($post->ID,'dfd_PublicRemarks',true) . '" />'. PHP_EOL;
			}
		}
	}
}

function sp_microdata($itemprop,$itemscope,$itemtype)
{
	$schemaorg_enabled = get_option( 'sc-layout-scheme-org',0);
	
	if($schemaorg_enabled == 1)
	{
		$microdata = "";
		if(!empty($itemprop))
		{
			$microdata ='itemprop="'.$itemprop. '" ';
		}
		
		if(!empty($itemscope))
		{
			$microdata = $microdata. 'itemscope="'.$itemprop. '" ';
		}
		else
		{
			$microdata = $microdata. 'itemscope ';
		}
		
		if(!empty($itemtype))
		{
			$microdata = $microdata.'itemtype="'. $itemtype .'"';
		}
	
		return $microdata;
	}

}	

add_action('wp_ajax_sp_dataservice_listing', 'sp_dataservice_listing_callback');
add_action('wp_ajax_nopriv_sp_dataservice_listing', 'sp_dataservice_listing_callback');
function sp_dataservice_listing_callback() {

	$result = wp_cache_get( 'sp_dataservice_listing_cache' );
	
	if ( false === $result ) 
	{
			global $wpdb;
			
			$posts_array   = $wpdb->get_results("SELECT ID,post_name,post_title,post_excerpt,wpm1.meta_value as 'lat',wpm2.meta_value as 'lon' ,wpm3.meta_value as 'address'  
				FROM $wpdb->posts p
				LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
						   AND pm.meta_key = 'geo_locality' 
				LEFT JOIN $wpdb->postmeta wpm1 ON (p.ID = wpm1.post_id
						   AND wpm1.meta_key = 'geo_lat')
				LEFT JOIN $wpdb->postmeta wpm2 ON (p.ID = wpm2.post_id
						   AND wpm2.meta_key = 'geo_lon')
				LEFT JOIN $wpdb->postmeta wpm3 ON (p.ID = wpm3.post_id
						   AND wpm3.meta_key = 'dfd_UnparsedAddress')				
				WHERE post_type = 'sp_property' AND pm.post_id is not null
				AND (post_status = 'publish' OR post_status = 'private') 		
				ORDER BY post_date DESC ");
			
			wp_cache_set('sp_dataservice_listing_cache', $posts_array );
			$return['data'] = $posts_array;
			$return['cache'] = false;
	}
	else
	{
			$return['data'] = $result;
			$return['cache'] = true;
	}
		
	
	
	echo json_encode($return);
	
	die(); // this is required to return a proper result
}


?>