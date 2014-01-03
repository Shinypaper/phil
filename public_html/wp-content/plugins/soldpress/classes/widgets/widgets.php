<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

register_sidebar(array(
  'name' => __( 'SoldPress - Sidebar Before Listing' ),
  'id' => 'soldpress-sidebar',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Sidebar' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => __( 'SoldPress - Sidebar After Listing' ),
  'id' => 'soldpress-sidebar-after',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Sidebar' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => __( 'SoldPress - Page Heading' ),
  'id' => 'soldpress-sidebar-heading',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Details' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => __( 'SoldPress - Page Footer' ),
  'id' => 'soldpress-page-footer',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Details' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));


register_sidebar(array(
  'name' => __( 'SoldPress - Main After Listing' ),
  'id' => 'soldpress-main-after-listing',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Details' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

include_once('search-widget.php');	
include_once('listing-widget.php');	
include_once('listings-widget.php');
include_once('reso-widget.php');	
include_once('geo-widget.php');
?>