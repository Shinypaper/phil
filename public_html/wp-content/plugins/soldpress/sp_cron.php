<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
  
	ini_set( "display_errors", 1);
	set_time_limit(0);
	ignore_user_abort(true);
 
	$fileName = dirname(__FILE__) . '/../../../wp-config.php';
	require_once($fileName);

	nocache_headers();
	$sp_run_cron = false;
	//if (!defined( 'ABSPATH' ))
	//{
		if(isset($_REQUEST['code']) && $_REQUEST['code'] == substr(get_option('sc-license-type'), 0, 14))
		{
			$sp_run_cron = true;
		}	
	//}
	//else
	//{
	//	$sp_run_cron = true;
	//} 
	
	if($sp_run_cron) 
	{
		echo '<settings>';
		echo '<setting name="memory_limit" value="'. ini_get( 'memory_limit' ) .'" ></setting>'; 
		echo '<setting name="max_execution_time" value="'. ini_get( 'max_execution_time' ) .'></setting>';
		echo '<setting name="max_input_time" value="'. ini_get( 'max_input_time' ) .'" />';
		echo '<setting name="mysql.connect_timeout" value="'. ini_get( 'mysql.connect_timeout' ) .'" />';
		echo '</settings>';	
		
		require_once(dirname(__FILE__) ."/classes/data/adapter.php");
		
		$adapter= new soldpress_adapter();			
		$adapter->SetParam('trace', true);
		$adapter->SetParam('verbose', true);
		
		$cache = "false";
		if(isset($_REQUEST['cache']))
		{
			$cache = $_REQUEST['cache'];
		}
					
		if($cache == 'true')
		{
			$adapter->SetParam('cache', true);
		}
		
		
		echo '<adapter name="cache" value="'. $cache .'" />';		
		echo '<adapter name="trace" value="true" />';			
		echo '<adapter name="verbose" value="true" />';		
		
		$action = "default";
		if(isset($_REQUEST['action']))
		{
			$action = $_REQUEST['action'];		
		}
				
		if($action == 'listing')
		{
			echo '<run name="action" value="listing" />';
			$sync_listings_id = $adapter->sync_listings();	
			echo 'Listing Job:' . $sync_listings_id;
		}
		else if($action == 'listing_update'){
			echo '<run name="action" value="listing" />';
			$sync_listings_id = $adapter->sync_listings_update();	
			echo 'Listing Job:' . $sync_listings_id;
		}
		else if($action == 'picture'){
			echo '<run name="action" value="picture" />';			
			$sync_pictures_id = $adapter->sync_pictures();
			echo 'Picture Job:' . $sync_pictures_id;
		}
		else if($action == 'xml'){
			echo '<run name="action" value="xml" />';
			$sync_pictures_id = $adapter->sync_xml();
			echo 'Xml Job:' . $sync_pictures_id;
		}		
		else if($action == 'geo'){
			echo '<run name="action" value="geo" />';
			$sync_pictures_id = $adapter->sync_geo();
			echo 'GEO Job:' . $sync_pictures_id;
		}
		else if($action == 'cleanup'){
			echo '<run name="action" value="cleanup" />';			
			$sync_cleanup_id = $adapter->sync_cleanup();		
			echo 'Clean Job:'. $sync_cleanup_id;
		}
		else
		{
			echo '<run name="action" value="default" />';
			//Basic Sync
			$sync_listings_id = $adapter->sync_listings();	
			echo 'Listing Job:' . $sync_listings_id;
			$sync_pictures_id = $adapter->sync_pictures();
			echo 'Picture Job:' . $sync_pictures_id;
			$sync_pictures_id = $adapter->sync_geo();
			echo 'GEO Job:' . $sync_pictures_id;
		}
		
		echo '<run name="complete" value="true" />';
	}
 ?>