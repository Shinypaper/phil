<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; 
	
	function sp_admin_menu() {
		
		$settings_page = add_menu_page('SoldPress Plugin Settings', 'SoldPress', 'administrator', 'soldpress-general.php', 'sp_general_admin_page_callback',plugins_url( '/images/soldpress-home-admin.png' , __FILE__ ));		
		$general_page = add_submenu_page( 'soldpress-general.php' , 'SoldPress Plugin Settings', 'DDF&#8482; Data Sync', 'manage_options', 'soldpress-general.php', 'sp_general_admin_page_callback' );	
		$layout_page = add_submenu_page(  'soldpress-general.php' , 'SoldPress Plugin Settings', 'Appearance', 'manage_options', 'soldpress-layout.php', 'sp_layout_admin_page_callback' );		
		$about_page = add_submenu_page( 'soldpress-general.php', 'SoldPress Plugin Settings', 'About', 'manage_options', 'soldpress-about.php', 'sp_about_admin_page_callback' ); 
		
		add_action( 'admin_init', 'sp_register_settings' );
		add_action('load-'.$settings_page, 'setting_after_save_tab_general');
		add_action('load-'.$general_page, 'setting_after_save_tab_general');
		add_action('load-'.$layout_page, 'setting_after_save_tab_layout');
		add_action('load-'.$about_page, 'setting_after_save_tab_about');
	}

	add_action( 'admin_menu', 'sp_admin_menu' );
	
	
	
	
	include_once(dirname(__FILE__).'/admin/general_page.php');
	include_once(dirname(__FILE__).'/admin/layout_page.php');				
	include_once(dirname(__FILE__).'/admin/about_page.php');	
	
	function sp_register_settings() {

		//General
		register_setting( 'sc-settings-credentials', 'sc-username' );
		register_setting( 'sc-settings-credentials', 'sc-password'/*, 'sanitize_password' */ );
		register_setting( 'sc-settings-credentials', 'sc-url' );
		register_setting( 'sc-settings-credentials', 'sc-template' );
		register_setting( 'sc-settings-credentials', 'sc-language' );	
		register_setting( 'sc-settings-credentials', 'sc-property-type' );
		register_setting( 'sc-settings-credentials', 'sc-debug' );
		
		//Data Managment
		register_setting( 'sc-settings-sync', 'sc-sync-enabled' );
		register_setting( 'sc-settings-sync', 'sc-sync-days' );
		register_setting( 'sc-settings-sync', 'sc-sync-cron' );
		register_setting( 'sc-settings-sync', 'sc-xml-sync-enabled' );
		register_setting( 'sc-settings-sync', 'sc-sync-medialib' );
		register_setting( 'sc-settings-sync', 'sc-geo-sync-enabled' );
		
		//register_setting( 'sc-settings-sync', 'sc-lastupdate' );
		
		//General
		register_setting( 'sc-settings-layout', 'sc-slug' );
		register_setting( 'sc-settings-layout', 'sc-slug-category' );
		
		register_setting( 'sc-settings-layout', 'sc-layout-header' );
		register_setting( 'sc-settings-layout', 'sc-layout-responsive' );
		register_setting( 'sc-settings-layout', 'sc-layout-responsive-fluid' );
		register_setting( 'sc-settings-layout', 'sc-layout-metric' );
		register_setting( 'sc-settings-layout', 'sc-layout-analytics' );
		register_setting( 'sc-settings-layout', 'sc-layout-theme' );
		register_setting( 'sc-settings-layout', 'sc-layout-footer' );
		register_setting( 'sc-settings-layout', 'sc-layout-facebook-og' );
		register_setting( 'sc-settings-layout', 'sc-layout-scheme-org' );
		register_setting( 'sc-settings-layout', 'sc-default-no-image' );

		
		register_setting( 'sc-settings-layout', 'sc-layout-jquery-prettyPhoto' );
		register_setting( 'sc-settings-layout', 'sc-layout-jquery-cookie' );
		register_setting( 'sc-settings-layout', 'sc-layout-google-maps' );
		register_setting( 'sc-settings-layout', 'sc-layout-gmap3' );
		register_setting( 'sc-settings-layout', 'sc-layout-flexslider' );
		register_setting( 'sc-settings-layout', 'sc-layout-soldpress' );
		register_setting( 'sc-settings-layout', 'sc-layout-font-awesome' );
		register_setting( 'sc-settings-layout', 'sc-layout-bxslider' );
		register_setting( 'sc-settings-layout', 'sc-layout-slidejs' );
		register_setting( 'sc-settings-layout', 'sc-layout-swipebox' );
		
		register_setting( 'sc-settings-layout', 'sc-api-walkscore' );
		register_setting( 'sc-settings-layout', 'sc-api-bing' );
		register_setting( 'sc-settings-layout', 'sc-google-api' );
		
		register_setting( 'sc-settings-layout', 'sc-map-zoom' );
		register_setting( 'sc-settings-layout', 'sc-map-latitude' );
		register_setting( 'sc-settings-layout', 'sc-map-longitude' );
		
		//	register_setting( 'sc-settings-layout', 'sc-layout-primarycolor' );
		//	register_setting( 'sc-settings-layout', 'sc-layout-secondarycolor' );
		//	register_setting( 'sc-settings-layout', 'sc-layout-soldpresslogo' );
			
		//Property Detail
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-ariealmap' );
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-streetviewmap' );	
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-walkscore' );	
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-google-ariealmap' );	
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-birdseye' );	
		
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-sidebar' );
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-false' );	
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-agentlisting' );
		register_setting( 'sc-settings-layout-propertydetails', 'sc-layout-propertydetails-grid' );
	
				
		//Property Listings	
		register_setting( 'sc-settings-layout-propertylisting', 'sc-layout-propertylistings-grid' );
		register_setting( 'sc-settings-layout-propertylisting', 'sc-layout-propertylistings-orderby' );
		register_setting( 'sc-settings-layout-propertylisting', 'sc-layout-propertylistings-orderby-direction' );
		register_setting( 'sc-settings-layout-propertylisting', 'sc-layout-propertylistings-cloumns' );
		
		//About
		register_setting( 'sc-settings-about', 'sc-license' );
		
		if (isset($_GET["spa"])) {
			$sp_action = $_GET["spa"];
			if ($sp_action != '') {
				if(check_admin_referer($sp_action)){
					switch ($sp_action) {
						case "unsevt":
							$job = $_GET['job'];
							wp_clear_scheduled_hook($job);						
							wp_redirect(remove_query_arg(array('job', 'spa','_wpnonce'), stripslashes($_SERVER['REQUEST_URI'])));
							exit();
							break;
						case "runevt":
							$job = $_GET['job'];							
							do_action($job);
							wp_redirect(remove_query_arg(array('job', 'spa','_wpnonce'), stripslashes($_SERVER['REQUEST_URI'])));
							exit();
							break;
						 case "testevt":
							$adapter= new soldpress_adapter();
							if($adapter->connect())
							{
								return $adapter-> logserverinfo();		
							}
							exit();
							break;
					}
				}
			}							
		}
	}

	/*function sanitize_password( $new ) 
	{
	
	}
	*/
	
	//
	//	Styles Section
	//
	function sp_admin_styles()  
	{ 

	  wp_register_style( 'bootstrap-style', 
		 plugins_url( 'lib/bootstrap/css/bootstrap-sp.min.css' , __FILE__ ), 
		array(), 
		'2.3.1', 
		'all' );
		
	  wp_enqueue_style( 'bootstrap-style' );
	  
	  wp_register_style( 'soldpress-style', 
		plugins_url( 'style/soldpress.css' , __FILE__ ), 
		array(), 
		'0.9.5', 
		'all' );
		
	   wp_enqueue_style( 'soldpress-style' );
	}

	add_action('admin_enqueue_scripts', 'sp_admin_styles');

	
	function sp_admin_soldpress_scripts() {
		wp_enqueue_script('jquery', false, array(), false, true);
		wp_enqueue_script(
			'bootstrap',
			 plugins_url( 'lib/bootstrap/js/bootstrap.min.js' , __FILE__ ), 
			array('jquery'), 
			'2.3.1', 
			true);
	}
	add_action( 'admin_enqueue_scripts', 'sp_admin_soldpress_scripts' ); 
	
?>