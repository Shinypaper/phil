<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

 	function setting_after_save_tab_about () 
	{		
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'activation_options';  	
		
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
		{
			include_once(SOLDPRESS_PLUGIN_DIR.'classes/twistoid/license.php');
			sp_register();
		}
	}
	
	function sp_about_admin_page_callback() 
	{
		$title = "About";
		
		if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'activation_options';  
	
	?>	
		<div class="wrap">
		
		<?php include_once(dirname(__FILE__).'/header.php'); ?>
		
		<h2 class="nav-tab-wrapper">  
		<a href="?page=soldpress-about.php&tab=activation_options" class="nav-tab <?php echo $active_tab == 'activation_options' ? 'nav-tab-active' : ''; ?>">License Key</a>
		<a href="?page=soldpress-about.php&tab=system_options" class="nav-tab <?php echo $active_tab == 'system_options' ? 'nav-tab-active' : ''; ?>">System</a> 			
		<?php if(get_option('sc-debug',false) == '1'){ ?> 
		<a href="?page=soldpress-about.php&tab=debug_options" class="nav-tab <?php echo $active_tab == 'debug_options' ? 'nav-tab-active' : ''; ?>">Debug</a>  
		<?php }?>
		</h2> 
		
		<?php if( $active_tab == 'activation_options' ) {  ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'sc-settings-about' ); ?>	
				<h3 class="title">License</h3>
				<table class="form-table">
					<tr>
					<th scope="row">Domain</th>
						<td>
							<?php echo sp_get_host(); ?>					
						</td>
					</tr>
					<tr>
					<th scope="row">License Key</th>
						<td>
							<input type="text" class="regular-text" id ="sc-license" name="sc-license" value="<?php echo get_option('sc-license',''); ?>" />						
						</td>
					</tr>
					<tr>
					<?php if( get_option('sc-license-valid') != true ) {  ?>	
					<th scope="row">License Type</th>
						<td>
							<p>Specified license is invalid or your license has expired.</p>
							
						<!--	<p> A Valid License will keep your product updated. This can help reduce secuirty and perfomance issues. Additioanly, having an outdate plugin can result in your plugin being outdate and not with CREA Policy and Procedures.</p>-->
									
						</td>
					</tr>
					<?php }?>
				</table>
				<?php submit_button(); ?> 				
		</form>		
			
			
			
			<h3 class="title">Support Options</h3>
			<p>Support <a href="http://support.sanskript.com">http://support.sanskript.com</a><br /></p>
			<p>Facebook <a href="http://facebook.com/sanskript">http://facebook.com/sanskript</a><br /></p>
			<p>Twitter <a href="http://twitter.com/sanskript">http://twitter.com/sanskript</a><br /></p>
			<p>Web Site <a href="http://www.sanskript.com">http://www.sanskript.com</a><br /><br /></p>			
			Have a Question. Please post the Question to our <a href="http://support.sanskript.com/customer/portal/emails/new">Support Form</a>

		</div>	
		<?php } ?>
			<?php if( $active_tab == 'log' ) {  ?>
		<?php include_once(dirname(__FILE__).'/log_page.php');?>
	<?php } ?>
	
	<?php if( $active_tab == 'phpinfo' ) {  ?>
		<?php include_once(dirname(__FILE__).'/phpinfo_page.php');?>
	<?php } ?>
		
		<?php if( $active_tab == 'system_options' ) {  ?>
		<h3>Plugin</h3>	
		<table class="form-table">
					<tr>
					<th scope="row">Product ID</th>
						<td>
							<?php echo SOLDPRESS_PRODUCT_ID; ?>					
						</td>
					</tr>
					<tr>
					<th scope="row">Product Version</th>
						<td>
							<?php echo SOLDPRESS_PRODUCT_VERSION; ?>								
						</td>
					</tr>
					<tr>
					<th scope="row">Product Build Date</th>
						<td>
							<?php echo SOLDPRESS_PRODUCT_DATE;  ?>								
						</td>
					</tr>
					<tr>
					<th scope="row">Product Build Time</th>
						<td>
							<?php echo SOLDPRESS_PRODUCT_TIME; ?>								
						</td>
					</tr>
					<tr>
					<th scope="row">Product Build Version</th>
						<td>
							<?php echo SOLDPRESS_FILE_VERSION; ?>								
						</td>
					</tr>
			</table>
			<h3>Plugin (Current)</h3>
			<table class="form-table">
				 <tr>
					  <th scope="row"><?php _e( 'Product Build Version','soldpress' ); ?>:</th>
					  <td><?php echo get_option( 'sc-version', '0922'); ?></td>
				  <tr>
              </tr>					
			</table>
		<h3>System</h3>				
		<table class="form-table">
              <tr>
                  <th scope="row"><?php _e( 'Home URL','soldpress' ); ?>:</th>
                  <td><?php echo home_url(); ?></td>
              </tr>
              <tr>
                  <th scope="row"><?php _e( 'Site URL','soldpress' ); ?>:</th>
                  <td><?php echo site_url(); ?></td>
              </tr>
              <tr>
                  <th scope="row"><?php _e( 'WP Version','soldpress' ); ?>:</th>
                  <td><?php if ( is_multisite() ) echo 'WPMU'; else echo 'WP'; ?> <?php echo bloginfo('version'); ?></td>
              </tr>
              <tr>
                  <th scope="row"><?php _e( 'Web Server Info','soldpress' ); ?>:</th>
                  <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] );  ?></td>
              </tr>
             <tr>
                 <th scope="row"><?php _e( 'PHP Version','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ); ?></td>
             </tr>
             <tr>
                 <th scope="row"><?php _e( 'MySQL Version','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'mysql_get_server_info' ) ) echo esc_html( mysql_get_server_info() ); ?></td>
             </tr>
             <tr>
                 <th scope="row"><?php _e( 'WP Memory Limit','soldpress' ); ?>:</th>
                 <td><?php
                     $memory = sp_let_to_num( WP_MEMORY_LIMIT );
 
                     if ( $memory < 67108864 ) {
                         echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 64MB. See: <a href="%s">Increasing memory allocated to PHP</a>', 'soldpress' ), wp_convert_bytes_to_hr( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
                     } else {
                         echo '<mark class="yes">' . wp_convert_bytes_to_hr( $memory ) . '</mark>';
                     }
                 ?></td>
             </tr>
			    <?php
                 $posting = array();
 
                 // fsockopen/cURL
                 $posting['fsockopen_curl']['name'] = __( 'fsockopen/cURL','soldpress');
                 if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
                    if ( function_exists( 'fsockopen' ) && function_exists( 'curl_init' )) {
                        $posting['fsockopen_curl']['note'] = __('Your server has fsockopen and cURL enabled.', 'soldpress' );
                     } elseif ( function_exists( 'fsockopen' )) {
                         $posting['fsockopen_curl']['note'] = __( 'Your server has fsockopen enabled, cURL is disabled.', 'soldpress' );
                     } else {
                         $posting['fsockopen_curl']['note'] = __( 'Your server has cURL enabled, fsockopen is disabled.', 'soldpress' );
                     }
                     $posting['fsockopen_curl']['success'] = true;
                 } else {
                    $posting['fsockopen_curl']['note'] = __( 'Your server does not have fsockopen or cURL enabled - PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider.', 'soldpress' ). '</mark>';
                     $posting['fsockopen_curl']['success'] = false;
                 }
				 
				 $posting = apply_filters( 'soldpress_debug_posting', $posting ); 
                 foreach( $posting as $post ) { $mark = ( isset( $post['success'] ) && $post['success'] == true ) ? 'yes' : 'error';                     ?>
                     <tr>
                         <td><?php echo esc_html( $post['name'] ); ?>:</td>
                        <td>
                            <mark class="<?php echo $mark; ?>">
                                 <?php echo $post['note'] ; ?>
                             </mark>
                        </td>
                    </tr>
                     <?php
                }
            ?>
             <tr>
                 <th scope="row"><?php _e( 'WP Debug Mode','soldpress' ); ?>:</th>
                 <td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . __( 'Yes', 'soldpress' ) . '</mark>'; else echo '<mark class="no">' . __( 'No', 'soldpress' ) . '</mark>'; ?></td>
             </tr>
             <tr>
                 <th scope="row"><?php _e( 'WP Max Upload Size','soldpress' ); ?>:</th>
                 <td><?php echo wp_convert_bytes_to_hr( wp_max_upload_size() ); ?></td>
             </tr>
             <tr>
                 <th scope="row"><?php _e('PHP Post Max Size','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'ini_get' ) ) echo wp_convert_bytes_to_hr( sp_let_to_num( ini_get('post_max_size') ) ); ?></td>
             </tr>
             <tr>
                 <th scope="row"><?php _e('PHP Time Limit','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'ini_get' ) ) echo ini_get('max_execution_time'); ?></td>
             </tr>
			 <tr>
                 <th scope="row"><?php _e('Available memory size ','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'ini_get' ) ) echo ini_get('memory_limit'); ?></td>
             </tr>
			<tr>
                 <th scope="row"><?php _e('Script input time ','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'ini_get' ) ) echo ini_get('max_input_time'); ?></td>
             </tr>
			<tr>
                 <th scope="row"><?php _e('MySql Connect Timeout ','soldpress' ); ?>:</th>
                 <td><?php if ( function_exists( 'ini_get' ) ) echo ini_get('mysql.connect_timeout'); ?></td>
             </tr>
			</table>
			<?php } ?>
			
			<?php if( $active_tab == 'debug_options' ) {  ?>
			<h3 class="title"><?php _e('Debug','soldpress') ?></h3>
			<?php

			$wp_upload_dir = wp_upload_dir();
			$properties_cache = $wp_upload_dir['basedir'] . '/soldpress/master.json';	
			?>

			<a target="_blank" href="?page=soldpress-about.php&tab=log"><?php _e('Log Files','soldpress') ?></a>
			<a target="_blank" href="?page=soldpress-about.php&tab=phpinfo"><?php _e('Php Info','soldpress') ?></a>
			<a target="_blank" href="<?php echo $properties_cache ?>"><?php _e('Properties Cache','soldpress') ?></a>
			
			<h3 class="title"><?php _e('Advance','soldpress') ?></h3>
			<form method="post" id="sync_connection"> 
				Debug</br>
				<p>
				<?php submit_button('Query On', 'secondary', 'queryon', false); ?> 
				<?php submit_button('Query Off', 'secondary', 'queryoff', false); ?> 
				<?php submit_button('Delete Debug Log', 'secondary', 'deletelog', false); ?>				
				</p>
				Sync</br>
				<p>
				<?php submit_button('Manual Sync', 'secondary', 'sync', false); ?> 
				<?php submit_button('Clear Sync Settings', 'secondary', 'clearsettings', false); ?> 
				<?php submit_button('Back Date Sync', 'secondary', 'syncdatesettings', false); ?>	
				</p>
				Picture Test</br>
				<p>
				<?php submit_button('Picture Test', 'secondary', 'picture_test', false); ?> 
				</p>
				<p>						
				Delete (Warning)</br>
				<?php submit_button('Display All Listings', 'secondary', 'listings', false); ?> 	
				<?php submit_button('Clear Listings', 'secondary', 'delete', false); ?> 					
				<?php submit_button('Delete Photo Meta', 'secondary', 'removephotometadata', false); ?> 
				<?php submit_button('Delete Agent Photo Meta', 'secondary', 'removeagentphotometadata', false); ?> 
				</p>
				<p>						
				Stats</br>
				<?php submit_button('Stats', 'secondary', 'stats', false); ?> 	
				<?php submit_button('Index', 'secondary', 'index', false); ?> 	
				</p>
			</form>
		
	<?php } ?>
	
	<?php
		global $wpdb;
		
		if (isset($_POST["queryon"])) { 
			echo 'queryon';
			update_option("sc-debug-action",1);
		}
		
		if (isset($_POST["queryoff"])) { 
			echo 'queryoff';
			update_option("sc-debug-action",0);
		}
		
		if (isset($_POST["test_connection"])) {  
				
			$adapter= new soldpress_adapter();
			if($adapter->connect())
			{
				$adapter-> logserverinfo();		
				
				$adapter->disconnect();
			}
			
		} 
		
		if (isset($_POST["picture_test"])) {  
				
			$adapter= new soldpress_adapter();
			if($adapter->connect())
			{	
				$adapter->getpropertyobject('12870357','LargePhoto');			
				echo 'dump';
				$adapter->disconnect();
			}
			
		} 
		
		if (isset($_POST["mark_picture_synced"])) 
		{  
				
		} 
		
		if (isset($_POST["sync"])) {  
		
			do_action('soldpress_listing_sync');
		}
		
		if (isset($_POST["deletelog"])) { 
				echo 'deletelog';
				$wp_upload_dir = wp_upload_dir();
				unlink($wp_upload_dir['basedir']. '/soldpress/soldpress-log-id.txt');
		}
		
		if (isset($_POST["delete"])) {  
			$mycustomposts = get_posts( array( 'post_type' => 'sp_property', 'numberposts' => 500) );
				foreach( $mycustomposts as $mypost ) {
					echo $mypost->ID;
				// Delete's each post.
					wp_delete_post( $mypost->ID, true);
					/*wp_delete_attachment( $attachmentid, $force_delete )*/
				// Set to False if you want to send them to Trash.
				
			}
		}
		
		if (isset($_POST["removephotometadata"])) {  		
			
			
			
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-office-file'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-coagent-file'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-agent-file'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-agent'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-office'");
			

		}
		
		if (isset($_POST["removeagentphotometadata"])) 
		{  	
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-coagent-file'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-agent-file'");
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = 'sc-sync-picture-agent'");		
		}
		
		if (isset($_POST["clearsettings"])) {  	
			delete_option( 'sc-lastupdate' ); 
			update_option('sc-lastupdate','');
		}
			
		if (isset($_POST["syncdatesettings"])) {  

		echo 'syncdatesettings';
		
				$days = 15;
				$date = new DateTime();	
				$date->sub(new DateInterval('P' . $days . 'D'));	
				update_option( 'sc-lastupdate', $date);
			}
			
		if (isset($_POST["listings"])) 
		{  	
			echo 'listings';
			$posts_array = $wpdb->get_results("select ID,post_name,post_status,post_date from $wpdb->posts where post_type = 'sp_property'");
			var_dump($posts_array);
		}
		
		if (isset($_POST["index"])) 
		{  	
			echo 'index';
			global $wpdb;
			$posts_array   = $wpdb->query("ALTER TABLE `wp_postmeta` ADD INDEX  USING BTREE (meta_value(255))");
	  }
		
		if (isset($_POST["stats"])) 
		{  	
			echo 'stats';
			
			$posts_array   = $wpdb->get_results("SELECT ID,post_name 
			FROM $wpdb->posts p
			LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
				AND pm.meta_key = 'sc-sync-picture' 				
			WHERE post_type = 'sp_property' AND pm.post_id is null
			AND (post_status = 'publish' OR post_status = 'private') 		
			ORDER BY post_date DESC ");
						
			echo 'Picture Sync - null records' .count($posts_array);
			
			$posts_array   = $wpdb->get_results("SELECT ID,post_name 
			FROM $wpdb->posts p
			LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
				AND pm.meta_key = 'dfd_xml' 				
			WHERE post_type = 'sp_property' AND pm.post_id is null
			AND (post_status = 'publish' OR post_status = 'private') 		
			ORDER BY post_date DESC ");
			
			echo 'XML Sync Null Records' .count($posts_array);
		}
	?>
<?php } ?>