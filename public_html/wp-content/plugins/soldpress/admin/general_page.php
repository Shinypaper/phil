<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
	function setting_after_save_tab_general() 
	{
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_options';  	
		
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
		{			
			/*if($active_tab == 'general_options')
			{	
				//Test The Connection
				$adapter= new soldpress_adapter();
				if($adapter->connect())
				{
					$adapter-> logserverinfo();		
					
					$adapter->disconnect();
				}
			}*/
			
			if($active_tab == 'sync_options')
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
					if (!wp_next_scheduled( 'soldpress_cleanup_sync' ) ) {
						wp_schedule_event( time() +(20 *60), 'hourly', 'soldpress_cleanup_sync');
					}
					if (!wp_next_scheduled( 'soldpress_geo_sync' ) ) {
						wp_schedule_event( time() +(10 *60), 'hourly', 'soldpress_geo_sync');
					}		
				}
					
				if($crontype == "unixcron")
				{
					//UnSubscrine The Web Cron Task
					wp_clear_scheduled_hook('soldpress_listing_sync');
					wp_clear_scheduled_hook('soldpress_photo_sync');
					wp_clear_scheduled_hook('soldpress_cleanup_sync');
					wp_clear_scheduled_hook('soldpress_geo_sync');
				}
					
				if($crontype == "soldpresscron")
				{
					//UnSubscrine The Web Cron Task
					wp_clear_scheduled_hook('soldpress_listing_sync');
					wp_clear_scheduled_hook('soldpress_photo_sync');
					wp_clear_scheduled_hook('soldpress_cleanup_sync');
					wp_clear_scheduled_hook('soldpress_geo_sync');
				}
				
				$medialib = get_option( 'sc-sync-medialib',0);
				if($medialib != 1)
				{
					global $wpdb;
					$wpdb->query("DELETE FROM wp_postmeta WHERE post_id IN (SELECT id FROM wp_posts WHERE post_type = 'attachment' and `guid` like '%/soldpress/%');");
					$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'attachment' and `guid` like '%/soldpress/%'");
				}		
			}
		}
	}

	function sp_general_admin_page_callback() 
	{
		$title = "DDF&#8482; Data Sync";
		
		if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';  
	?>

		<div class="wrap">
		
		<?php include_once(dirname(__FILE__).'/header.php'); ?>
		
		<h2 class="nav-tab-wrapper">  
			<a href="?page=soldpress-general.php&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Connection Settings</a>
			<a href="?page=soldpress-general.php&tab=sync_options" class="nav-tab <?php echo $active_tab == 'sync_options' ? 'nav-tab-active' : ''; ?>">Data Sync</a> 			
		</h2>  
		
	<?php if( $active_tab == 'display_options' ) {  ?>		
		<form method="post" action="options.php">
			<?php settings_fields( 'sc-settings-credentials' ); ?>
			<p class="description"> Welcome to the SoldPress installation process. Please fill in the information below. If you do not have a username and password, An email containing user name and password is sent to the email address submitted as Technical Contact when data feeds are registered in http://tools.realtorlink.ca.  <a href="http://crea.ca/data-distribution-facility-documentation" target="_blank">More information</a></p>
			<h3 class="title">Credentials</h3>
			<table class="form-table">
				<tr valign="top">
				<th scope="row">CREA Url</th>
					<td>
						<select name="sc-url" class="" id="sc-language">
							<option value="http://data.crea.ca/Login.svc/Login" <?php selected( 'http://data.crea.ca/Login.svc/Login', get_option( 'sc-url' ) ); ?>>Production</option>
							<option value="http://sample.data.crea.ca/Login.svc/Login" <?php selected( 'http://sample.data.crea.ca/Login.svc/Login', get_option( 'sc-url' ) ); ?>>Development</option>
						</select>
					</td>
				</tr>					
				<tr valign="top">
				<th scope="row">Username <span class="description">(required)</span></th>
				<td><input type="text" class="regular-text" name="sc-username" value="<?php echo get_option('sc-username'); ?>" />
				</td>
				
				</tr>
				<tr valign="top">
				<th scope="row">Password <span class="description">(required)</span></th>
				<td><input type="password" class="regular-text" autocomplete="off" name="sc-password" value="<?php echo get_option('sc-password'); ?>" /></td>
				
				</tr>
			</table>
			<h3 class="title">General</h3>
			<table class="form-table">			
				<tr valign="top">
				<th scope="row">Language</th>
				<td>
					<select name="sc-language" class="" id="sc-language">
						<option value="en-CA" <?php selected( 'en-CA', get_option( 'sc-language' ) ); ?>>en-CA</option>
						<option value="en-FR" <?php selected( 'en-FR', get_option( 'sc-language' ) ); ?>>en-FR</option>
					</select>
				</td>
				</tr>
				<tr valign="top">
					<th scope="row">Properties Type</th>
					<td>
					<select name="sc-property-type" class="" id="sc-property-type">
						<option value="residential " <?php selected( 'residential', get_option( 'sc-property-type' ) ); ?>>Residential Properties </option>
						<option value="commercial" <?php selected( 'commercial', get_option( 'sc-property-type' ) ); ?>>Commercial Properties</option>
					</select>
					</td>
				</tr>	
				<tr valign="top">
				<th scope="row">Debug Mode</th>
				<td><input name="sc-debug" id ="sc-debug" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-debug' ) ); ?>  /></td>
				</tr>
			</table>
			<?php submit_button(); ?>  
		</form>	
		<h3 class="title">Test Connection</h3>	
		<p>Once you've saved your settings, click the link below to test your connection.</p>
		<form method="post" id="test_connection">  						
				<?php submit_button('Test Connection', 'secondary', 'test_connection', false); ?> 
		</form>	
	<?php } ?>
	
	<?php if( $active_tab == 'sync_options' ) {  ?>	
		
		<h3 class="title">General</h3>
			<form method="post" action="options.php">
				<?php settings_fields( 'sc-settings-sync' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Sync Enabled</th>
						<td>
							<input name="sc-sync-enabled" id ="sc-sync-enabled" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-sync-enabled' ) ); ?>  />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Current Time</th>
						<td>
							<?php $date = new DateTime(); echo $date->format('Y-m-d H:i:s');?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Last Update</th>
						<td>
							<?php if(get_option('sc-lastupdate' ) != ""){echo get_option('sc-lastupdate' )->format('Y-m-d H:i:s'); }?>					
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Sync Pictures to Media Library</th>
						<td>
							<input name="sc-sync-medialib" id ="sc-sync-medialib" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-sync-medialib' ) ); ?>  />					
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Cron Type</th>
						<td>
							<select name="sc-sync-cron"  id="sc-sync-cron">
								<option value="wordpresscron" <?php selected( 'wordpresscron', get_option( 'sc-sync-cron' ) ); ?>>WordPress Cron</option>
								<option value="unixcron" <?php selected( 'unixcron', get_option( 'sc-sync-cron' ) ); ?>>Unix Cron</option>
								<option value="soldpresscron" <?php selected( 'soldpresscron', get_option( 'sc-sync-cron' ) ); ?>>SoldPress WebCron</option>
							</select>	
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Extended Sync</th>
						<td>
							<input name="sc-xml-sync-enabled" id ="sc-xml-sync-enabled" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-xml-sync-enabled',0 ) ); ?>  />	
							
						</td>
						
					</tr>
					<tr valign="top">
					<th scope="row">Geocode Sync</th>
						<td>
							<input name="sc-geo-sync-enabled" id ="sc-geo-sync-enabled" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-geo-sync-enabled',0 ) ); ?>  />	
							
						</td>
						</tr>
				</table>
				<?php submit_button(); ?>  
			</form>
					<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function($){			
				$('#sc-sync-medialib').change(function() {	
					if($('#sc-sync-medialib').prop('checked'))
					{
					
					}
					else{
						alert('Warning: All listing pictures will deleted from the Media Library on Save.');
					}
				});
			});
		//]]>
		</script>

		<?php if( get_option( 'sc-sync-cron','wordpresscron') == 'wordpresscron'  ) {  ?>			
		<h3 class="title">WordPress Cron Schedule</h3>	
		<p class="description">WordPress Cron is recommend if you have dedicated hosting and under 500 Listing.</p>		
		<table class="widefat">
			<thead>
				<tr class="thead">
					<th>Job</th>
					<th>Time</th>
					<th>Schedule</th>
					<th>Interval</th>
					<th>Last Start</th>
					<th>Last End</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">
					
					<th>Job</th>
					<th>Time</th>
					<th>Schedule</th>
					<th>Interval</th>
					<th>Last Run</th>
					<th>Last End</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $time_slots = _get_cron_array();		
					$tr_class = "";
						foreach ($time_slots as $key => $jobs) {
				
							foreach ($jobs as $job => $value) {
								if($job == 'soldpress_photo_sync' || $job == 'soldpress_listing_sync' || $job == 'soldpress_cleanup_sync' || $job == 'soldpress_geo_sync'){
									echo '<tr>';
									
									if($job == 'soldpress_photo_sync'){
										echo '<td><strong>Listings Photo</strong>';
									}
									else if($job == 'soldpress_listing_sync'){
										echo '<td><strong>Listings</strong>';
									}
									else if($job == 'soldpress_cleanup_sync'){
										echo '<td><strong>Listings Cleanup</strong>';
									}
									else if($job == 'soldpress_geo_sync'){
										echo '<td><strong>Listings Geolocation</strong>';
									}
									
									if(get_option( 'sc-sync-enabled' ) == 1)
									{
										echo '<div class="row-actions" style="margin:0; padding:0;"><a href="'.wp_nonce_url('admin.php?page=soldpress-general.php&tab=sync_options&spa=runevt&job='.$job,'runevt').'">Run Now</a></div>';
									}
									echo '</td>';
									echo '<td>'.date("r", $key).'</td>';							
									$schedule = $value[key($value)];
									echo '<td>'.(isset($schedule["schedule"]) ? $schedule["schedule"] : "").'</td>';
									echo '<td class="aright">'.(isset($schedule["interval"]) ? $schedule["interval"] : "").'</td>';	
									if(get_option('sc-'.$job.'-start' ) == ""){
										echo '<td class="aright">';
									}
									else{
										echo '<td class="aright">'. Date('r',get_option('sc-'.$job.'-start' )) ;
									}
									echo '</td>';
									if(get_option('sc-'.$job.'-end' ) == ""){
										echo '<td class="aright">';
									}
									else{									
										echo '<td class="aright">'. Date('r',get_option('sc-'.$job.'-end' )) ;
									}
									echo '</td>';
									echo '</tr>';
									if ($tr_class == ""){
										$tr_class = "entry-row alternate ";
									}
									else{
										$tr_class = "entry-row";
									}
								}
							}
						}
				?>
			</tbody>
		</table>
		<?php } ?>
		
		<?php if( get_option( 'sc-sync-cron','wordpresscron') == 'unixcron'  ) {  ?>
		<h3 class="title">Unix Cron</h3>
		<p class="description">Unix Cron is recommended if you have shared hosting and 500-10000 Listing.</p>
		<p class="description">1 GB of memory is recommended for 5000+ listings</p>			
			<?php
				include_once(SOLDPRESS_PLUGIN_DIR .'classes/cron/sp_cron_functions.php');	
				
				$commands = array(sp_get_binary_path('curl'),sp_get_binary_path('wget'),sp_get_binary_path('lynx', ' -dump'),sp_get_binary_path('ftp'));
				
				$command = sp_pick($commands[0], $commands[1], $commands[2], $commands[3], '<em>{wget or similar command here}</em>');
				
				$cron_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?code=' .  substr(get_option('sc-license-type'), 0, 14); 
				
				$cron_listing_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=listing&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron__picture_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=picture&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron_xml_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=xml&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron_geo_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=geo&code=' .  substr(get_option('sc-license-type'), 0, 14);
				
				$cron_command = attribute_escape('0 * * * * '. $command . " '" . $cron_url . "'" );
				
				$cron_command_listing = attribute_escape('0 * * * * '. $command . " '". $cron_listing_url . "'");
				$cron_command_picutre = attribute_escape('0 * * * * '. $command . " '". $cron__picture_url . "'");
				$cron_command_xml = attribute_escape('0 * * * * '. $command . " '" . $cron_xml_url . "'");
				$cron_command_geo = attribute_escape('0 * * * * '. $command . " '" . $cron_geo_url . "'");
					
					
			?>
			<h4>Cron command:</h4>
              <div><?php echo $cron_command   ?></div>  

			<h4>Advance Cron command:</h4>
              <div><?php echo $cron_command_listing   ?></div> 
			  <div><?php echo $cron_command_picutre   ?></div> 
			  <div><?php echo $cron_command_xml   ?></div> 
			  <div><?php echo $cron_command_geo   ?></div> 
			  <table class="widefat">
			  
			<thead>
				<tr class="thead">
					<th>Job</th>
					<th>Last Start</th>
					<th>Last End</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">					
					<th>Job</th>
					<th>Last Start</th>
					<th>Last End</th>
				</tr>
			</tfoot>
			<tbody>
				<tr>			
				<td>Listing Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_listing_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_listing_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Picture Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_photo_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_photo_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Xml Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_xml_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_xml_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Geolocation Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_geolocation_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_geolocation_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>CleanUp Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_cleanup_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_cleanup_sync-end' )) ;?></td>
				</tr>
				
			</tbody> 
		<?php } ?>
				
		<?php if( get_option( 'sc-sync-cron','wordpresscron') == 'soldpresscron'  ) {  ?>
		<h3 class="title">SoldPress WebCron</h3>  
		<p class="description"><a href="http://www.sanskript.com/product/soldpress-webcron/">SoldPress WebCron</a> is subscription service that allows you to get reliable listing updates on your server.</p>
			  <?php
				include_once(SOLDPRESS_PLUGIN_DIR.'classes/cron/sp_cron_functions.php');					
				$commands = array(sp_get_binary_path('curl'),sp_get_binary_path('wget'),sp_get_binary_path('lynx', ' -dump'),sp_get_binary_path('ftp'));
				$command = sp_pick($commands[0], $commands[1], $commands[2], $commands[3], '<em>{wget or similar command here}</em>');		
				$cron_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?code=' .  substr(get_option('sc-license-type'), 0, 14);
				
				$cron_listing_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=listing&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron__picture_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=picture&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron_xml_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=xml&code=' .  substr(get_option('sc-license-type'), 0, 14);
				$cron_geo_url = SOLDPRESS_PLUGIN_URL . 'sp_cron.php?action=geo&code=' .  substr(get_option('sc-license-type'), 0, 14);					
			?>	
              <h4>SoldPress Cron-ready URL:</h4>
              <div><?php echo $cron_url ?></div>	
			   <h4>SoldPress Cron-ready Advance URL:</h4>
              <div><?php echo $cron_listing_url ?></div>
			  <div><?php echo $cron__picture_url ?></div>
			  <div><?php echo $cron_xml_url ?></div>
			  <div><?php echo $cron_geo_url ?></div>
			  <table class="widefat">
			<thead>
				<tr class="thead">
					<th>Job</th>
					<th>Last Start</th>
					<th>Last End</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="thead">					
					<th>Job</th>
					<th>Last Start</th>
					<th>Last End</th>
				</tr>
			</tfoot>
			<tbody>
				<tr>			
				<td>Listing Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_listing_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_listing_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Picture Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_photo_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_photo_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Xml Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_xml_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_xml_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>Geolocation Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_geolocation_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_geolocation_sync-end' )) ;?></td>
				</tr>
				<tr>			
				<td>CleanUp Sync</td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_cleanup_sync-start' )) ;?></td>
				<td class="aright"> <? echo Date('r',get_option('sc-soldpress_cleanup_sync-end' )) ;?></td>
				</tr>
				
			</tbody>
		<?php } ?>
	
	<?php } ?>	
	<?php
		global $wpdb;
		
		if (isset($_POST["test_connection"])) {  
				
			$adapter= new soldpress_adapter();
			if($adapter->connect())
			{
				$adapter-> logserverinfo();		
				
				$adapter->disconnect();
			}
			
		}
		
		if (isset($_POST["sync"])) {  
		
			do_action('soldpress_listing_sync');
		}
	?>
	</div>
<?php } ?>