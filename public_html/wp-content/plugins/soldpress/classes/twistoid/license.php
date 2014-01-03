<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
	
	function sp_add_key($query){
		$license = get_option('sc-license-type');
		$query['license'] = $license;
		$domain = sp_get_host();
		$query['domain'] = $domain;
		return $query;
	}
	
	$SoldPressUpdateChecker->addQueryArgFilter('sp_add_key');
 
	function sp_get_host() {
	
			if (!$host = $_SERVER['HTTP_HOST'])
			{
				if (!$host = $_SERVER['SERVER_NAME'])
				{
					$host = !empty($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
				}
			}
			
		// Remove port number from host
		$host = preg_replace('/:\d+$/', '', $host);

		return trim($host);
	}
	
	function sp_register() 
	{
		$domain = sp_get_host();		
		$licensekey = get_option('sc-license');
		$prod_id = SOLDPRESS_PRODUCT_ID;
		if (substr($domain, 0, 4) == "www.") { 
			$domain = substr($domain, 4);
		}
		$userip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
		$validdir = dirname(__FILE__);
		$validdomain = $domain;

		$key_info['key'] = $licensekey;
		$key_info['domain'] = $validdomain;
		$key_info['validip'] = $userip;
		$key_info['validdir'] = $validdir;
		$key_info['product'] = $prod_id;

		$content = json_encode($key_info);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,SOLDPRESS_API);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result, true);
		
		if($json['Valid']){
			update_option('sc-license-type',$json['Status']);
			update_option('sc-license-valid',true);
		} else 
		{
			update_option('sc-license-type','');
			update_option('sc-license-valid',false);			
		}
	}
	
	
	function sp_presstrends_plugin() {
    // PressTrends Account API Key
    $api_key = 'j068vkws7karox7bl4ayeisdqlub0wmdfv8d';
    $auth    = '6frezh01zpco9eg518h4e2mdwfkkz8w6r';
    // Start of Metrics
    global $wpdb;
    $data = get_transient( 'presstrends_cache_data' );
    if ( !$data || $data == '' ) {
        $api_base = 'http://api.presstrends.io/index.php/api/pluginsites/update?auth=';
        $url      = $api_base . $auth . '&api=' . $api_key . '';
        $count_posts    = wp_count_posts();
        $count_pages    = wp_count_posts( 'page' );
        $comments_count = wp_count_comments();
        if ( function_exists( 'wp_get_theme' ) ) {
            $theme_data = wp_get_theme();
            $theme_name = urlencode( $theme_data->Name );
        } else {
            $theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
            $theme_name = $theme_data['Name'];
        }
        $plugin_name = '&';
        foreach ( get_plugins() as $plugin_info ) {
            $plugin_name .= $plugin_info['Name'] . '&';
        }
        // CHANGE __FILE__ PATH IF LOCATED OUTSIDE MAIN PLUGIN FILE
         $plugin_data         = get_plugin_data( SOLDPRESS_FILE );
        $posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
        $data                = array(
            'url'             => base64_encode(site_url()),
            'posts'           => $count_posts->publish,
            'pages'           => $count_pages->publish,
            'comments'        => $comments_count->total_comments,
            'approved'        => $comments_count->approved,
            'spam'            => $comments_count->spam,
            'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
            'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
            'theme_version'   => $plugin_data['Version'],
            'theme_name'      => $theme_name,
            'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
            'plugins'         => count( get_option( 'active_plugins' ) ),
            'plugin'          => urlencode( $plugin_name ),
            'wpversion'       => get_bloginfo( 'version' ),
        );
        foreach ( $data as $k => $v ) {
            $url .= '&' . $k . '=' . $v . '';
        }
        wp_remote_get( $url );
        set_transient( 'presstrends_cache_data', $data, 60 * 60 * 24 );
        }
    }
	
	// PressTrends WordPress Action
	add_action('admin_init', 'sp_presstrends_plugin');

		// Setup Events
	function sp_presstrends_track_event($event_name) {
		// PressTrends Account API Key & Theme/Plugin Unique Auth Code
		$api_key		= 'j068vkws7karox7bl4ayeisdqlub0wmdfv8d';
		$auth		= '6frezh01zpco9eg518h4e2mdwfkkz8w6r';
		$api_base		= 'http://api.presstrends.io/index.php/api/events/track/auth/';
		$api_string		= $api_base . $auth . '/api/' . $api_key . '/';
		$site_url 		= base64_encode(site_url());
		$event_string	= $api_string . 'name/' . urlencode($event_name) . '/url/' . $site_url . '/';
		wp_remote_get( $event_string );
	}
	add_action( 'presstrends_event', 'sp_presstrends_track_event', 1, 1 );
 ?>