<?php

	function sp_upgrade_plugin() 
	{
		//Perform Version Upgrades
		$currentVerison = get_option( 'sc-version', '1300'); //If the version not found revert to new version
		
		if($currentVerison == '0922')
		{
			//We need to delete the username and password and get the user to reenter because changes have occured to the application
			update_option( 'sc-username','' ); 
			update_option( 'sc-password','');
			update_option( 'sc-password','');
			
			$currentVerison == '0957';
		}

		if($currentVerison == '0957')
		{
			//Old User - Don't change the behaviour of the sync.
			update_option( 'sc-sync-medialib',1);
				
			if(get_option('sc-layout-sidebar',0) == 1)
			{
				update_option( 'sc-layout-propertydetails-grid','full-width');
			}	
			
			$wp_upload_dir = wp_upload_dir();
			$target = $wp_upload_dir['basedir']. '/soldpress/logs';
			wp_mkdir_p( $target );
			
			$currentVerison == '1200';
		}
		
		if($currentVerison == '1200')
		{
			//Update Excerpt
			global $wpdb;
			$wpdb->query("UPDATE $wpdb->posts SET post_excerpt = post_name;");
			
			if(get_option('sc-layout-ariealmap',0) == 1)
			{
				update_option( 'sc-layout-google-ariealmap',1);
			}	
			
			$walkscore = get_option('sc-layout-walkscore',0);
			
			if(!empty($walkscore))
			{
				update_option( 'sc-api-walkscore',$walkscore);
				update_option( 'sc-layout-walkscore',1);
			}

			$currentVerison == '1300';			
		}
		
		update_option( 'sc-version', SOLDPRESS_FILE_VERSION);

	}

	add_action('admin_init', 'sp_upgrade_plugin' );
	
	
?>
