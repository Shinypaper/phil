<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

	function setting_after_save_tab_layout () 
	{
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';  
		
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
		{
			if($active_tab == 'display_options')
			{	
				flush_rewrite_rules( false );
				//Test The Connection
			}
		}
	}
	
	
	function sp_layout_admin_page_callback() 
	{

		$title = "Layout Settings";
		
		if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
	
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';  	
?>
		<div class="wrap">
		
		<?php include_once(dirname(__FILE__).'/header.php'); ?>
		
		<h2 class="nav-tab-wrapper">  
			<a href="?page=soldpress-layout.php&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">General Display Options</a> 
			<a href="?page=soldpress-layout.php&tab=propertydetails_options" class="nav-tab <?php echo $active_tab == 'propertydetails_options' ? 'nav-tab-active' : ''; ?>">Property Details Options</a> 
			<a href="?page=soldpress-layout.php&tab=propertylistings_options" class="nav-tab <?php echo $active_tab == 'propertylistings_options' ? 'nav-tab-active' : ''; ?>">Property Listing Options</a>  
		</h2>  
	
		<?php if( $active_tab == 'display_options' ) {  ?>
		
			<form method="post" action="options.php">
					<?php settings_fields( 'sc-settings-layout' ); ?>
					<h3 class="title">General</h3>
					<table class="form-table">					
						<tr valign="top">
							<th scope="row">Slug</th>
							<td>
								<input type="text" class="regular-text" id ="sc-slug" name="sc-slug" value="<?php echo get_option('sc-slug','listing'); ?>" />
							</td>					
						</tr>
						<tr>
							<th scope="row">Category Slug</th>
							<td>
								<input type="text" class="regular-text" id ="sc-slug-category" name="sc-slug-category" value="<?php echo get_option('sc-slug-category','category'); ?>" />
							</td>					
						</tr>
						<tr>
						<th scope="row">Measurement</th>
							<td>
							<select name="sc-layout-metric" class="" id="sc-layout-metric">
							<option value="metres" <?php selected( 'metres', get_option( 'sc-layout-metric' ) ); ?>>Meters</option>
							<option value="imperial" <?php selected( 'imperial', get_option( 'sc-layout-metric' ) ); ?>>Imperial (Sq Feet)</option>
							</select>
							</td>
						</tr>
												
					</table>
					<h3 class="title">Display Settings</h3>
					<table class="form-table">	
						<tr>
						<th scope="row">Theme</th>
							<td>
							<select name="sc-layout-theme" id="sc-layout-theme">
								<option value="bootstrap " <?php selected( 'bootstrap', get_option( 'sc-layout-theme' ) ); ?>>BootStrap</option>
								<option value="spbootstrap" <?php selected( 'spbootstrap', get_option( 'sc-layout-theme' ) ); ?>> BootStrap (SoldPress)</option>
								<option value="custom" <?php selected( 'custom', get_option( 'sc-layout-theme' ) ); ?>>Custom</option>	
								<option value="none" <?php selected( 'none', get_option( 'sc-layout-theme' ) ); ?>>None</option>									
							</select>
							<?php if( get_option( 'sc-layout-theme' ) == 'custom' ) { ?>
								<p class="description">If this option is checked, you must include these files in your site directory.<br/>
									<?php			
										$filepath = SOLDPRESS_BASEUPLOAD_FILE . '/custom/boostrap.css';										
										if(file_exists($filepath))
										{
											echo SOLDPRESS_BASEUPLOAD_URL . '/custom/boostrap.css Found' .' <br />';
										}
										else
										{
											echo '<span style="color:red">Not Found: '.SOLDPRESS_BASEUPLOAD_URL . '/custom/boostrap.css</span>' .' <br />';
										}
										
										$filepath = SOLDPRESS_BASEUPLOAD_FILE . '/custom/bootstrap-responsive.css';
										if(file_exists($filepath))
										{
											echo SOLDPRESS_BASEUPLOAD_URL . '/custom/boostrap-responsive.css Found' .' <br />';
										}
										else
										{
											echo '<span style="color:red">Not Found: '.SOLDPRESS_BASEUPLOAD_URL . '/custom/boostrap-responsive.css </span>'.' <br />';
										}	
									?>
								</p>
							<?php } ?>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">Enable Responsive</th>
							<td>
								<input name="sc-layout-responsive" id ="sc-layout-responsive" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-responsive',1 ) ); ?>  />
								<p class="description">Disable responsive behaviour for themes.</p>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">Enable Fluid</th>
							<td>
								<input name="sc-layout-responsive-fluid" id ="sc-layout-responsive-fluid" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-responsive-fluid',1 ) ); ?>  />
								<p class="description">Disable fluid behaviour for themes.</p>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">Disable Header</th>
							<td>
								<input name="sc-layout-header" id ="sc-layout-header" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-header',0 ) ); ?>  />
								<p class="description">Disable header for themes.</p>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">Disable Footer</th>
							<td>
								<input name="sc-layout-footer" id ="sc-layout-footer" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-footer',0 ) ); ?>  />
								<p class="description">Disable footer for themes.</p>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">Default Image</th>
							<td>
							<input type="text" class="regular-text" id ="sc-default-no-image" name="sc-default-no-image" value="<?php echo get_option('sc-default-no-image',plugins_url( 'images/soldpress-nophoto.png' , SOLDPRESS_FILE )); ?>" />
							<p class="description">Enter a URL to an image you want to show for listings without images. <a href="<?php echo get_admin_url('','/media-new.php') ?>">media uploader</a>.</p>  
							</td>
						</tr>
					</table>
					<h3 class="title">JavaScript Libraries</h3>
					<table class="form-table">	
						<tr valign="top">
					<!--	<th scope="row">jquery.prettyPhoto</th>
							<td>
								<input name="sc-layout-jquery-prettyPhoto" id ="sc-layout-jquery-prettyPhoto" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-jquery-prettyPhoto',1 ) ); ?>  />
							</td>-->
						</tr>
						<tr valign="top">
						<th scope="row">jquery.cookie</th>
							<td>
								<input name="sc-layout-jquery-cookie" id ="sc-layout-jquery-cookie" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-jquery-cookie',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">google.maps</th>
							<td>
								<input name="sc-layout-google-maps" id ="sc-layout-google-maps" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-google-maps',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">gmap3</th>
							<td>
								<input name="sc-layout-gmap3" id ="sc-layout-gmap3" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-gmap3',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">flexslider</th>
							<td>
								<input name="sc-layout-flexslider" id ="sc-layout-flexslider" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-flexslider',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">swipebox</th>
							<td>
								<input name="sc-layout-swipebox" id ="sc-layout-swipebox" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-swipebox',1 ) ); ?>  />
							</td>
						</tr>
					
						<tr valign="top">
						<th scope="row">soldpress</th>
							<td>
								<input name="sc-layout-soldpress" id ="sc-layout-soldpress" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-soldpress',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">font.awesome</th>
							<td>
								<input name="sc-layout-font-awesome" id ="sc-layout-font-awesome" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-font-awesome',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">slidejs</th>
							<td>
								<input name="sc-layout-slidejs" id ="sc-layout-slidejs" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-slidejs',1 ) ); ?>  />
							</td>
						</tr>
						<tr valign="top">
						<th scope="row">bxslider</th>
							<td>
								<input name="sc-layout-bxslider" id ="sc-layout-bxslider" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-bxslider',1 ) ); ?>  />
							</td>
						</tr>
					</table>
					<h3 class="title">Social</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Open Graph Protocol</th>
							<td>
								<input name="sc-layout-facebook-og" id ="sc-layout-facebook-og" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-facebook-og',0) ); ?>  /> 
								<p class="description">The Open Graph protocol enables any web page to become a rich object in a social graph.</p>
							</td>
						</tr>
						<tr>
						<tr>
						<th scope="row">Schema.org</th>
							<td>
								<input name="sc-layout-scheme-org" id ="sc-layout-schema-org" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-scheme-org',0) ); ?>  /> 
								<p class="description">scheme.org is a common vocabulary for structured data markup on web pages.</p>
							</td>
						</tr>
						<tr>
					</table>
					<h3 class="title">Realtor(tm) Analytics</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Analytics</th>
							<td>
								<input name="sc-layout-analytics" id ="sc-layout-analytics" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-analytics',0) ); ?>  /> 
								<p class="description">Integration of these scripts is mandatory for all National Shared Pool and National Franchisor Pool clients.</p>
							</td>
						</tr>
						<tr>
					</table>
					<h3 class="title">Maps</h3>
					<table class="form-table">
					<tr>
							<th scope="row">Map Zoom Level</th>
								<td>
									<input type="text" class="regular-text" id ="sc-map-zoom" name="sc-map-zoom" value="<?php echo get_option('sc-map-zoom','3'); ?>" /></td>
								</td>
						</tr>
						<tr>
							<th scope="row">Map Latitude</th>
								<td>
									<input type="text" class="regular-text" id ="sc-map-latitude" name="sc-map-latitude" value="<?php echo get_option('sc-map-latitude','60.413852'); ?>" /></td>
								</td>
						</tr>
						<tr>
							<th scope="row">Map Longitude</th>
								<td>
									<input type="text" class="regular-text" id ="sc-map-longitude" name="sc-map-longitude" value="<?php echo get_option('sc-map-longitude','-111.824341'); ?>" /></td>
								</td>
						</tr>
					</table>
					<h3 class="title">Third Party Integration</h3>
					<table class="form-table">
						<tr>
							<th scope="row">Walk Score API Key</th>
								<td>
									<input type="text" class="regular-text" id ="sc-api-walkscore" name="sc-api-walkscore" value="<?php echo get_option('sc-api-walkscore',''); ?>" /></td>
								</td>
						</tr>
						<tr>
							<th scope="row">Bing Maps API Key</th>
								<td>
									<input type="text" class="regular-text" id ="sc-api-bing" name="sc-api-bing" value="<?php echo get_option('sc-api-bing',''); ?>" /></td>
								</td>
						</tr>
						<tr>
							<th scope="row">Google Maps API Key</th>
								<td>
									<input type="text" class="regular-text" id ="sc-google-api" name="sc-google-api" value="<?php echo get_option('sc-google-api',''); ?>" /></td>
								</td>
						</tr>					
					</table>
					<?php submit_button(); ?>  	
			</form>
		
		<?php } ?>
		
		<?php if( $active_tab == 'propertydetails_options' ) {  ?>
		
			<form method="post" action="options.php">
					<?php settings_fields( 'sc-settings-layout-propertydetails' ); ?>									
					<h3 class="title">Sidebar</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Layout</th>
							<td>							
								<div>
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input <?php checked( '1', get_option( 'sc-layout-propertydetails-grid','sidebar-left') == 'sidebar-right') ?> type="radio" name="sc-layout-propertydetails-grid" value="sidebar-right" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'cs.gif' ?>"" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">Right sidebar</span>
										</label>
									</div>	
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input <?php checked( '1', get_option( 'sc-layout-propertydetails-grid','sidebar-left') == 'full-width' ) ?>  type="radio" name="sc-layout-propertydetails-grid" value="full-width" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'c.gif' ?>"" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">No sidebar</span>
										</label>
									</div>	
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input  <?php checked( '1', get_option( 'sc-layout-propertydetails-grid','sidebar-left') == 'sidebar-left' )?> type="radio" name="sc-layout-propertydetails-grid" value="sidebar-left" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'sc.gif' ?>"" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">Left sidebar</span>
										</label>
									</div>
								</div>
							</td>
						</tr>
						<tr>
						<th scope="row">Display Listing Agent</th>
							<td>
								<input name="sc-layout-agentlisting" id ="sc-layout-agentlisting" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-agentlisting',1 ) ); ?>  />
							</td>
						</tr>
					</table>				
					<h3 class="title">Map</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Display Aerial Map</th>
							<td>
								<input name="sc-layout-ariealmap" id ="sc-layout-ariealmap" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-ariealmap',0 ) ); ?> />
							</td>
						</tr>
						<tr>
						<th scope="row">Display Google Map</th>
							<td>
								<input name="sc-layout-google-ariealmap" id ="sc-layout-google-ariealmap" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-google-ariealmap',0 ) ); ?> />
							</td>
						</tr>
						<tr>
						<th scope="row">Display StreetView Map</th>
							<td>
								<input name="sc-layout-streetviewmap" id ="sc-layout-streetviewmap" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-streetviewmap',0 ) ); ?> />
							</td>
						</tr>
						<tr>
						<th scope="row">Display Birds Eye Map</th>
							<td>
								<input name="sc-layout-birdseye" id ="sc-layout-birdseye" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-birdseye',0 ) ); ?> />
							</td>
						</tr>
						<tr>
						<th scope="row">Display WalkScore Map</th>
							<td>
								<input name="sc-layout-walkscore" id ="sc-layout-walkscore" value="1" type="checkbox" <?php checked( '1', get_option( 'sc-layout-walkscore',0 ) ); ?> />
							</td>
						</tr>
						
					</table>
				
					<?php submit_button(); ?>  	
			</form>
			
		<?php } ?>
	
		<?php if( $active_tab == 'propertylistings_options' ) {  ?>
		
			<form method="post" action="options.php">
					<?php settings_fields( 'sc-settings-layout-propertylisting' ); ?>
					<h3 class="title">Sidebar</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Layout</th>
							<td>							
								<div>
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input <?php checked( '1', get_option( 'sc-layout-propertylistings-grid','full-width') == 'sidebar-right') ?> type="radio" name="sc-layout-propertylistings-grid" value="sidebar-right" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'cs.gif' ?>" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">Right sidebar</span>
										</label>
									</div>	
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input <?php checked( '1', get_option( 'sc-layout-propertylistings-grid','full-width') == 'full-width' ) ?>  type="radio" name="sc-layout-propertylistings-grid" value="full-width" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'c.gif' ?>" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">No sidebar</span>
										</label>
									</div>	
									<div style="float: left; margin-right: 15px">
										<label style="float: left; clear: both;">
											<input  <?php echo checked( '1', get_option( 'sc-layout-propertylistings-grid','full-width') == 'sidebar-left' )?> type="radio" name="sc-layout-propertylistings-grid" value="sidebar-left" style="margin-bottom: 4px;" /><br />
											<img src="<?php echo SOLDPRESS_IMAGES_URL . 'sc.gif' ?>" class="layout-img" /><br />
											<span class="description" style="margin-top: 5px; float: left;">Left sidebar</span>
										</label>
									</div>
								</div>
							</td>
						</tr>
					</table>				
					<h3 class="title">Sort</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Field</th>
							<td>
							<select name="sc-layout-propertylistings-orderby" class="" id="sc-layout-propertylistings-orderby">
							<option value="date" <?php selected( 'date', get_option( 'sc-layout-propertylistings-orderby' ) ); ?>>Date</option>
							<option value="price" <?php selected( 'price', get_option( 'sc-layout-propertylistings-orderby' ) ); ?>>Price</option>
							</select>
							</td>
						</tr>
						<th scope="row">Direction</th>
							<td>
							<select name="sc-layout-propertylistings-orderby-direction" class="" id="sc-layout-propertylistings-orderby-direction">
							<option value="DESC" <?php selected( 'DESC', get_option( 'sc-layout-propertylistings-orderby-direction' ) ); ?>>Descending</option>
							<option value="ASC" <?php selected( 'ASC', get_option( 'sc-layout-propertylistings-orderby-direction' ) ); ?>>Ascending</option>
							</select>
							</td>
						</tr>
					</table>
					<h3 class="title">Columns</h3>
					<table class="form-table">
						<tr>
						<th scope="row">Columns</th>
							<td>
							<select name="sc-layout-propertylistings-cloumns" class="" id="sc-layout-propertylistings-cloumns">
							<option value="1" <?php selected( '1', get_option( 'sc-layout-propertylistings-cloumns','3' ) ); ?>>2</option>
							<option value="2" <?php selected( '2', get_option( 'sc-layout-propertylistings-cloumns','3' ) ); ?>>3</option>
							<option value="3" <?php selected( '3', get_option( 'sc-layout-propertylistings-cloumns','3' ) ); ?>>4</option>
							
							</select>
							</td>
						</tr>
					</table>
					<?php submit_button(); ?>  	
			</form>
		</div>	
		<?php } ?>
<?php } ?>