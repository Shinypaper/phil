<?php
/*
Plugin Name: SoldPress Premium
Plugin URI: http://www.soldpress.com
Description: SoldPress is a WordPress plug-in to enable CREA’s members to easily disseminate MLS® listing content on WordPress Sites.
Version: 1.3.4.3
Author: Sanskript Solution, Inc.
Author URI: http://www.sanskript.com
*/


	require_once(dirname(__FILE__)."/build.php");

	define('SOLDPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
	define('SOLDPRESS_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
	define('SOLDPRESS_ROOT_FILE_DIR', dirname(__FILE__));	
	define('SOLDPRESS_IMAGES_URL', plugin_dir_url( __FILE__ ) . 'images/');	
	define('SOLDPRESS_FILE',  __FILE__ );
	
	$wp_upload_dir = wp_upload_dir(); 
	define('SOLDPRESS_BASEUPLOAD_URL',$wp_upload_dir['baseurl'].'/soldpress');
	define('SOLDPRESS_BASEUPLOAD_FILE', $wp_upload_dir['basedir']. '/soldpress');
	
	define('SOLDPRESS_UPDATE_URL','http://twistoid.azurewebsites.net/home/productupdate');
	define('SOLDPRESS_API','http://twistoid.azurewebsites.net/api/license');
	define('SOLDPRESS_TEMPLATE_DIR', SOLDPRESS_PLUGIN_DIR . '/templates/13/');	//TODO://Use Setting To Get This
	
	ini_set('max_execution_time', 600);	
	ini_set('mysql.connect_timeout', 600);
	ini_set('default_socket_timeout', 600);
	ini_set('memory_limit', '-1');
	
	//define('WP_DEBUG_LOG', true);
	
	require(SOLDPRESS_PLUGIN_DIR . '/classes/upgrade/plugin-updates/plugin-update-checker.php');	
	
	$SoldPressUpdateChecker = new PluginUpdateChecker(
		SOLDPRESS_UPDATE_URL,
		__FILE__
	);
	
	require_once(SOLDPRESS_PLUGIN_DIR."/product.php");	
	require_once(SOLDPRESS_PLUGIN_DIR."/classes/twistoid/license.php");	
	require_once(SOLDPRESS_PLUGIN_DIR."/classes/data/adapter.php");
	require_once(SOLDPRESS_PLUGIN_DIR."/classes/shortcodes/shortcodes.php"); //
	require_once(SOLDPRESS_PLUGIN_DIR."/classes/widgets/widgets.php"); //
	require_once(SOLDPRESS_PLUGIN_DIR.'/settings.php');
	require_once(SOLDPRESS_PLUGIN_DIR.'/custom_field_types.php');
	require_once(SOLDPRESS_PLUGIN_DIR.'/sp_functions.php');
	//require_once(SOLDPRESS_PLUGIN_DIR.'/sp_custom_functions.php');
	require_once(SOLDPRESS_PLUGIN_DIR.'/classes/upgrade/upgrade.php');
	
	
	add_filter( 'query_vars','soldpress_query_vars' );
	//add_theme_support('post-thumbnails');
	function soldpress_query_vars( $vars )
	{
		array_push($vars, 'listingid');
		array_push($vars, 'listingkey');
		return $vars;
	}

	register_deactivation_hook(__FILE__,'deactivate_cron_hook');

	function deactivate_cron_hook(){
		wp_clear_scheduled_hook('soldpress_listing_sync');
		wp_clear_scheduled_hook('soldpress_photo_sync');
		wp_clear_scheduled_hook('soldpress_cleanup_sync');
		wp_clear_scheduled_hook('soldpress_geo_sync');
	}

	register_activation_hook(__FILE__, 'soldpress_activation');

	add_action('soldpress_listing_sync', 'soldpress_listintgs');
	add_action('soldpress_photo_sync', 'soldpress_photo');
	add_action('soldpress_geo_sync', 'soldpress_geo');
	add_action('soldpress_cleanup_sync', 'soldpress_cleanup');
	
	
	function soldpress_activation() {
		
		//update_option( 'sc-version', SOLDPRESS_FILE_VERSION);
			
		update_option( 'sc-status', '');
		update_option( 'sc-sync-start','' ); 
		update_option( 'sc-sync-end','' ); 
		
		//Create SoldPress Directory
		$wp_upload_dir = wp_upload_dir();
		
		$target = $wp_upload_dir['basedir']. '/soldpress/';
		wp_mkdir_p( $target );
		
		$target = $wp_upload_dir['basedir']. '/soldpress/logs';
		wp_mkdir_p( $target );
		
		//What Cron Mode Is Running
		if(get_option( 'sc-sync-cron','wordpresscron') == 'wordpresscron'  )
		{
			//Schedule The Events
			if (!wp_next_scheduled( 'soldpress_listing_sync' ) ) {
					wp_schedule_event( 1339631940 , 'daily', 'soldpress_listing_sync');
				}
			if (!wp_next_scheduled( 'soldpress_photo_sync' ) ) {
				wp_schedule_event( time(), 'hourly', 'soldpress_photo_sync');
			}
			if (!wp_next_scheduled( 'soldpress_geo_sync' ) ) {
				wp_schedule_event( time() +(10 *60), 'hourly', 'soldpress_geo_sync');
			}
			if (!wp_next_scheduled( 'soldpress_cleanup_sync' ) ) {
				wp_schedule_event( time() +(20 *60), 'hourly', 'soldpress_cleanup_sync');
			}	
		}
	}

	function soldpress_listintgs() {	

		$adapter= new soldpress_adapter();		
		$adapter->sync_listings();		
	}

	function soldpress_photo() {
	
		$adapter= new soldpress_adapter();
		$adapter-> sync_pictures();	
	}
	
	function soldpress_geo() {
	
		$adapter= new soldpress_adapter();
		$adapter-> sync_geo();	
	}
	
	function soldpress_cleanup() {
		$adapter= new soldpress_adapter();
		$adapter-> sync_cleanup();	
	}
	
	add_action('admin_init', 'sp_admin_init');
	function sp_admin_init() 
	{

		if ( !function_exists('is_multisite') && version_compare( $wp_version, '3.0', '<' ) ) {		
			function sp_version_warning() {
				echo '
				<div id="soldpress-warning" class="updated fade"><p><strong>soldpress requires WordPress 3.0 or higher.</strong> </p></div>';
			}		
			add_action('admin_notices', 'sp_version_warning'); 			
		}	
		
		if(get_option('sc-sync-enabled') == 0){
		
			function sp_night_sync_warning() 
			{
				echo '<div class="updated fade"><p>SoldPress daily data feeds synchronization from CREA’s Data Distribution Facility is  <strong>disabled</strong>. <a href="'.get_admin_url('','admin.php?page=soldpress-general.php&tab=sync_options').'">Enable</a><p></div>';
			}  

			add_action('admin_notices', 'sp_night_sync_warning'); 
		}
		
		if( get_option('sc-license-valid') != true ){
		
			function sp_license_key_warning() 
			{
				echo '<div class="updated fade"><p>SoldPress License Key is not set yet or invalid.</strong><a href="'.get_admin_url('','admin.php?page=soldpress-about.php').'"> Manage</a> your license for automatic upgrades.<p></div>';
			}  

			add_action('admin_notices', 'sp_license_key_warning'); 
		}
		
		if ( version_compare(PHP_VERSION, '5.3.0', '<') ) {
			
			function sp_php_version_warning() 
			{
				echo '
				<div id="soldpress-warning" class="error"><p><strong>SoldPress requires PHP version 5.3 or higher.</strong> </p></div>';
			}
			
			add_action('admin_notices', 'sp_php_version_warning');
		}
		return; 
	}
	
	function sp_plugins_adminbar() {

		global $wp_admin_bar;
	
		$wp_admin_bar->add_menu( array(
			'id' => 'soldpres_plugins_options',
			'title' => 'SoldPress'
		));
						
		$wp_admin_bar->add_menu( array(
		'parent' => 'soldpres_plugins_options',
		'id' => 'soldpress_listings',
		'title' => __( 'View Listings', 'soldpress' ),
		'href' => get_post_type_archive_link( 'sp_property' )
		));
		
		$wp_admin_bar->add_menu( array(
		'parent' => 'soldpres_plugins_options',
		'id' => 'soldpress_crea',
		'title' => __( 'REALTOR Link®', 'soldpress' ),
		'href' => 'http://tools.realtorlink.ca'
		));
		
		$wp_admin_bar->add_menu( array(
		'parent' => 'soldpres_plugins_options',
		'id' => 'soldpress_settings',
		'title' => __( 'Settings', 'soldpress' ),
		'href' => get_admin_url('','admin.php?page=soldpress-general.php'),
		));
		
		$wp_admin_bar->add_menu( array(
		'parent' => 'soldpres_plugins_options',
		'id' => 'soldpress_sanskript_support',
		'title' => __( 'Documentation', 'soldpress' ),
		'href' => 'http://soldpress.com/documentation'
		));
		
	/*	$wp_admin_bar->add_menu( array(
		'parent' => 'soldpres_plugins_options',
		'id' => 'soldpress_sanskript_creadocumentation',
		'title' => __( 'DDF Documentation', 'soldpress' ),
		'href' => 'http://crea.ca/data-distribution-facility-documentation'
		));*/
				
	}

		add_action('admin_bar_menu', 'sp_plugins_adminbar', 61);
		
	function sp_theme_hooks_check() {
		$template_directory = get_template_directory();
		
		// If footer.php exists in the current theme, scan for "wp_footer"
		$file = $template_directory . '/footer.php';
		if (is_file($file)) {
			$search_string = "wp_footer";
			$file_lines = @file($file);
			
			foreach ($file_lines as $line) {
				$searchCount = substr_count($line, $search_string);
				if ($searchCount > 0) {
					return true;
				}
			}
			
			// wp_footer() not found:
			echo "<div class=\"update-nag\">" . __("Your theme needs to be fixed. To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>&lt;?php wp_footer(); ?&gt;</code> just before the <code>&lt;/body&gt;</code> line of your theme's <code>footer.php</code> file.") . "</div>";
		}
		
		// If header.php exists in the current theme, scan for "wp_head"
		$file = $template_directory . '/header.php';
		if (is_file($file)) {
			$search_string = "wp_head";
			$file_lines = @file($file);
			
			foreach ($file_lines as $line) {
				$searchCount = substr_count($line, $search_string);
				if ($searchCount > 0) {
					return true;
				}
			}
			
			// wp_footer() not found:
			echo "<div class=\"update-nag\">" . __("Your theme needs to be fixed. To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>&lt;?php wp_head(); ?&gt;</code> just before the <code>&lt;/head&gt;</code> line of your theme's <code>header.php</code> file.") . "</div>";
		}
	}
?>