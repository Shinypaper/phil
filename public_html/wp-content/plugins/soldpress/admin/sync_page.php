<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

	function setting_after_save_tab_sunc() 
	{
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
		{				
			$crontype = get_option( 'sc-sync-cron','wordpresscron');
			if($crontype == "wordpresscron")
			{				
				//Before We Schedule Make Sure Job Is Not Already Scheduled.
				if (!wp_next_scheduled( 'soldpress_listing_sync' ) ) {
					wp_schedule_event( 1339631940 , 'daily', 'soldpress_listing_sync');
				}
				if (!wp_next_scheduled( 'soldpress_photo_sync' ) ) {
					wp_schedule_event( time(), 'hourly', 'soldpress_photo_sync');
				}
				if (!wp_next_scheduled( 'soldpress_listintgs_cleanup_sync' ) ) {
					wp_schedule_event( time(), 'twicedaily', 'soldpress_listintgs_cleanup_sync');
				}			
			}
				
			if($crontype == "unixcron")
			{
				//UnSubscrine The Web Cron Task
				wp_clear_scheduled_hook('soldpress_listing_sync');
				wp_clear_scheduled_hook('soldpress_photo_sync');
				wp_clear_scheduled_hook('soldpress_listintgs_cleanup_sync');
			}
				
			if($crontype == "soldpresscron")
			{
				//UnSubscrine The Web Cron Task
				wp_clear_scheduled_hook('soldpress_listing_sync');
				wp_clear_scheduled_hook('soldpress_photo_sync');
				wp_clear_scheduled_hook('soldpress_listintgs_cleanup_sync');
			}
			
			$medialib = get_option( 'sc-sync-medialib',0);
			if($medialib != 1)
			{
				global $wpdb;
				$wpdb->query("DELETE FROM wp_postmeta WHERE post_id IN (SELECT id FROM wp_posts WHERE post_type = 'attachment' and `guid` like '%soldpress%');");
				$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'attachment' and `guid` like '%soldpress%'");
			}
		}
	}
 
	function sp_sync_admin_page_callback() 
	{
	
		$title = "DDF&#8482; Data Sync1";
		
		if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
	
	?>	
	
		<div class="wrap">
		<?php include_once(dirname(__FILE__).'/header.php'); ?>			
		</div>
		
<?php } ?>