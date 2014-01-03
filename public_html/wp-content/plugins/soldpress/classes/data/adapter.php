<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

	include(SOLDPRESS_PLUGIN_DIR .'/logger.php');
	require_once SOLDPRESS_PLUGIN_DIR . '/classes/data/sp_phrets.php';
	class soldpress_adapter
	{
		private $loginURL; //'http://sample.data.crea.ca/Login.svc/Login';
		private $userId; //'CXLHfDVrziCfvwgCuL8nUahC';
		private $pass; //'mFqMsCSPdnb5WO1gpEEtDCHH';
		private $templateLocation = "wp-content/plugins/soldpress/template/";
		private $service;
		private $log;
		private $verbose;
		private $culture;
		private $trace;
		private $cache;
		
		public function soldpress_adapter()
		{
			$this->log     = new Logging();
			$wp_upload_dir = wp_upload_dir();
			
			$target = $wp_upload_dir['basedir']. '/soldpress/';
			wp_mkdir_p( $target );
		
			$target = $wp_upload_dir['basedir']. '/soldpress/logs';
			wp_mkdir_p( $target );
		
			//Default Path [Obsolete]
			$this->log->lfile($wp_upload_dir['basedir'] . '/soldpress/soldpress-log.txt');
			
			$this->verbose = true;
			$this->trace = false;
			$this->cache = false;
			
			$this->service = new sp_phRETS();
			$this->service->SetParam('catch_last_response', true);
			$this->service->SetParam('compression_enabled', true);
			$this->service->SetParam('disable_follow_location', true);
			$this->service->SetParam('offset_support', true);
			$cookie_file = 'soldpress';
			@touch('cookie_file');
			if (is_writable('cookie_file')) {
				$this->service->SetParam('cookie_file', 'soldpress');
			}
			$this->service->AddHeader('RETS-Version', 'RETS/1.7.2');
			$this->service->AddHeader('Accept', '/');
			$this->loginURL         = get_option("sc-url");
			$this->userId           = get_option("sc-username");
			$this->pass             = get_option("sc-password");
			$this->templateLocation = get_option("sc-template", "wp-content/plugins/soldpress/template/");
			
			$this->culture = get_option("sc-language", "en-CA");	
		}
		
		
		public function SetParam($name, $value) {
		switch ($name) {
			case "trace":
				$this->trace = $value;
				break;
			case "verbose":
				$this->verbose = $value;
				break;
			case "cache":
				$this->cache = $value;
				break;
			/*case "debug_mode":
				$this->debug_mode = $value;
				break;*/
			default:
				return false;
		}

		return true;
	}
	
		public function connect()
		{
			$connect = $this->service->Connect($this->loginURL, $this->userId, $this->pass);
			if ($connect === true) {
				$this->displaytrace('Connection Successful');
			} else {
				$this->displayLog('Connection FAILED');
				if ($error = $this->service->Error()) {
					$this->displayLog('ERROR type [' . $error['type'] . '] code [' . $error['code'] . '] text [' . $error['text'] . ']');
				}
				return false;
			}
			return true;
		}
		public function disconnect()
		{
			$this->service->Disconnect();
		}
		public function logserverinfo()
		{
			$this->DisplayHeader('Server Info');
			echo "<br>";
			$this->displaylog('Login: ' . $this->loginURL);
			echo "<br>";
			$this->displaylog('UserId: ' . $this->userId);
			echo "<br>";
			$this->displaylog('Server Details: ' . implode($this->service->GetServerInformation()));
			echo "<br>";
			$this->displaylog('RETS version: ' . $this->service->GetServerVersion());
			echo "<br>";
			$this->displaylog('Firewall: ' . $this->firewalltest());
			echo "<br>";
			$master_properties = $this->service->Search("Property", "Property", '(ID=*)', array(
				"Limit" => '100'
			));
			$total             = count($master_properties);
			$this->displaylog('Total Records: ' . $total);
			$oldPost = "";
			$newPost = "";
			foreach ($master_properties as &$master) {
				$masterpostdate = DateTime::createFromFormat("d/m/Y H:i:s A", $master['ModificationTimestamp']);
				if ($oldPost == "") {
					$oldPost = $masterpostdate;
				}
				if ($newPost == "") {
					$newPost = $masterpostdate;
				}
				if ($oldPost > $masterpostdate) {
					$oldPost = $masterpostdate;
				}
				if ($newPost < $masterpostdate) {
					$newPost = $masterpostdate;
				}
			}
			if ($oldPost != "") {
				$this->displaylog('Oldest Record: ' . $oldPost->format('c'));
			}
			if ($newPost != "") {
				$this->displaylog('Newest Record: ' . $newPost->format('c'));
			}
			
			$properties_lookups = $this->service->GetAllLookupValues("Property");
			
			$wp_upload_dir = wp_upload_dir();
			$filePath = $wp_upload_dir['basedir'] . '/soldpress/lookupValues.json';
			file_put_contents($filePath,json_encode($properties_lookups));
				
		}
		public function logtypeinfo()
		{
			$this->displaylog(var_export($this->service->GetMetadataTypes(), true));
			$this->displaylog(var_export($this->service->GetMetadataResources(), true));
			$this->displaylog(var_dump($this->service->GetMetadataClasses("Property")));
			$this->displaylog(var_dump($this->service->GetMetadataClasses("Office")));
			$this->displaylog(var_dump($this->service->GetMetadataClasses("Agent")));
			$this->displaylog(var_dump($this->service->GetMetadataTable("Property", "Property")));
			$this->displaylog(var_dump($this->service->GetMetadataTable("Office", "Office")));
			$this->displaylog(var_dump($this->service->GetMetadataTable("Agent", "Agent")));
			$this->displaylog(var_dump($this->service->GetAllLookupValues("Property")));
			$this->displaylog(var_dump($this->service->GetAllLookupValues("Office")));
			$this->displaylog(var_dump($this->service->GetAllLookupValues("Agent")));
			$this->displaylog(var_dump($this->service->GetMetadataObjects("Property")));
			$this->displaylog(var_dump($this->service->GetMetadataObjects("Office")));
			$this->displaylog(var_dump($this->service->GetMetadataObjects("Agent")));
		}

		public function crunch($properties, $total)
		{
			global $wpdb;
			//Get Disconnect Array of Current Posts
			$posts_array = $wpdb->get_results("select ID,post_name,post_excerpt,post_status,post_date from $wpdb->posts where post_type = 'sp_property'");
			//Reset Data
			$count       = 0;
			$user_id     = get_current_user_id();
			//Loop Data
			foreach ($properties as &$rets) 
			{
				$count      = $count + 1;
				$ListingKey = $rets['ListingKey'];
				$this->WriteLog('$ListingKey' . $ListingKey);
				$post = ''; //Want To Mat use unset
				foreach ($posts_array as $struct) 
				{
					if ($ListingKey == $struct->post_excerpt) 
					{
						$post = $struct;
						break;
					}					
				}
				$postdate = DateTime::createFromFormat("d/m/Y H:i:s A", $rets['ModificationTimestamp']);			
				$title    = $rets['UnparsedAddress'] . ' (' . $rets['ListingId'] . ')';
				$name 	=  $rets['UnparsedAddress'] . ' ' . $rets['City'] . ' ' . $rets['StateOrProvince'] . ' ' . $rets['ListingId'];
				
				$content  = "";
				if ($post != '') {
					//Check The Master List TO See If Post Exits If No Marke Delete
					$post->post_title   = apply_filters( 'soldpress_sync_post_title', $title, $post );
					$post->post_name    = apply_filters( 'soldpress_sync_post_name', $name, $post );
					$post->post_date    = $postdate->format('Y-m-d H:i:s');
					$post->post_status = 'publish';
					$post->post_excerpt = $ListingKey;
					$post->post_content = $rets['PublicRemarks'];
					//$post->tags_input = $rets['City'] .','. $rets['PropertyType'];
					$post->comment_status = 'closed';
					$post->ping_status = 'closed';
					//$post->import_id = $ListingKey;
					do_action( 'soldpress_before_listing_update', $post);
					wp_update_post($post);
					do_action( 'soldpress_after_listing_update', $post);
					
					
					
					$post_id = $post->ID;
					$this->WriteLog('Update Post ListingKey:' . $ListingKey . 'PostDate' . $post->post_date . '-' . $post_id . ' Record -' . $count . ' of ' . $total);
					
					//Cat
					//wp_set_object_terms($post_id,$rets['dfd_City'],'city');
					
					//Delete All Meta-data
					$deleteQuery = $wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE post_id = %d AND meta_key like %s", $post_id, 'dfd_%'); 
					$wpdb->query($deleteQuery);				
					$meta_values = array();
					foreach ($rets as $key => &$value) 
					{
						$meta_values[] = $wpdb->prepare('(%s, %s, %s)', $post_id, 'dfd_' . $key, $value);
					}
					$values = implode(', ', $meta_values);
					do_action( 'soldpress_before_listing_postmeta_insert',$post_id, $post,$rets );
					$wpdb->query("INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) VALUES $values");
					do_action( 'soldpress_after_listing_postmeta_insert',$post_id,  $post,$rets  );
					
					update_post_meta($post_id, 'sc-update_time', time());
				} 
				else 
				{
				
					//post mode publish or draft		
					$post    = array(
						'post_title' => apply_filters( 'soldpress_sync_post_title', $title, $post ),
						'post_status' => 'publish',
						'post_author' => $user_id,
						'post_type' => 'sp_property',
						'post_name' => apply_filters( 'soldpress_sync_post_name', $name, $post ),
						'post_date' => $postdate->format('Y-m-d H:i:s'),
						'post_excerpt' => $ListingKey,
						'post_content' => $rets['PublicRemarks'],
					//	'tags_input' => $rets['City'] .','. $rets['PropertyType'],
						'comment_status' => 'closed',
						'ping_status' => 'closed',
					//	'import_id' => $ListingKey
					);
					
					do_action( 'soldpress_before_listing_insert', $post);
					$post_id = wp_insert_post($post, true);
					do_action( 'soldpress_after_listing_insert', $post);
					
								
					if (is_wp_error($post_id)) 
					{
						$this->WriteLog(' Insert Post - Error' . $ListingKey . '-' . $post_id . ' Record -' . $count . ' of ' . 'User:' . $user_id);
						$errors = $post_id->get_error_messages();
						foreach ($errors as $error) 
						{
							$this->WriteLog(var_dump($error));
						}
					} 
					else 
					{
					//	wp_set_object_terms($post_id,$rets['dfd_City'],'city');
					
						$this->WriteLog('Insert Post' . $ListingKey . '-' . $post_id . ' Record -' . $count . ' of ' . $total);
						$meta_values = array();
						foreach ($rets as $key => &$value) 
						{
							$meta_values[] = $wpdb->prepare('(%s, %s, %s)', $post_id, 'dfd_' . $key, $value);
						}
						$values = implode(', ', $meta_values);
						do_action( 'soldpress_before_listing_postmeta_insert',$post_id, $post,$rets );
						$wpdb->query("INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) VALUES $values");
						do_action( 'soldpress_after_listing_postmeta_insert',$post_id,  $post,$rets );
					}					
					update_post_meta($post_id, 'sc-insert_time', time());
				}				
				update_post_meta($post_id, 'sc-sync-meta-end', time());
			}
		}
		
		public function munch($master_properties)
		{
			global $wpdb;
			//Need To Get An Update List Of Post Information
			$posts_array = $wpdb->get_results("select ID,post_name,post_excerpt,post_status,post_date from $wpdb->posts where post_type = 'sp_property'");
			foreach ($posts_array as $post) {
				if ($post->post_status != "trash") 
				{					
					$isDelete   = true;
					$ListingKey = $post->post_excerpt;
					
					if(empty($ListingKey))
					{
						//Private Listing
						$isDelete = false;
						$this->WriteVerboseLog('Private Listing'); 
						continue;
					}
					
					foreach ($master_properties as &$master) 
					{
						if ($ListingKey == $master['ListingKey']) 
						{
							$isDelete       = false; //Found Mark the flag false;
							//If the Property exists but the lastupdated is different call Search Property By ID
							$masterpostdate = DateTime::createFromFormat("d/m/Y H:i:s A", $master['ModificationTimestamp']);
							if ($post->post_date != $masterpostdate->format('Y-m-d H:i:s')) 
							{
								$this->WriteVerboseLog('Property Needs To Be Update Mod Date Is Different: ListingKey:' . $ListingKey . ' : ' . $post->post_date . ' : ' . $masterpostdate->format('Y-m-d H:i:s') . ' : OrginalModStamp' . $master['ModificationTimestamp']);
								$keys[] = $ListingKey;
							}

							break;
						}
					}
					
					if ($isDelete) {
						//Verbose
						$this->WriteVerboseLog('Not Found Post in Master List:Deleting Post:' . $ListingKey);
						$post->post_status = "trash";
						wp_update_post($post);
					} else {
						//Verbose
						$this->WriteVerboseLog('Found Post in Master List: Keeping Post' . $ListingKey);
					}
				}
			}
			
			//Updating Any Properties That Have Different Mod Dates
			if (isset($keys)) {
				$chunck = array_chunk($keys, 75);
				foreach ($chunck as $event) {
					$update_keys = implode(",", $event);
					$this->WriteLog("Run Update (Step4) Process(Bunch)");
				/*	$this->WriteLog("WorkAround To Crea:");
					$fake = $this->service->Search("Property", "Property", '(ID="1")', array(
						"Limit" => '1',
						"Culture" => $this->culture
					));
					$this->WriteLog("Update:" . '(ID=' . $update_keys . ')');*/
					$update_properties = $this->service->Search("Property", "Property", '(ID=' . $update_keys . ')', array(
						"Limit" => '100',
						"Culture" => $this->culture
					));
					$total = count($update_properties);
					$this->WriteLog("Retrieved Update (Bunch) List Results Total:" . $total);
					$this->crunch($update_properties, $total);
				}
			}
		}
		public function punch($master_properties)
		{
			//
			//Audit Check
			//If The Sync Has Missed Some Properties We can go get them and update
			//
			global $wpdb;
			//Need To Get An Update List Of Post Information
			$posts_array = $wpdb->get_results("select ID,post_name,post_excerpt,post_status,post_date from $wpdb->posts where post_type = 'sp_property'");
			
			foreach ($master_properties as &$master) {
				$isFound = false;
				foreach ($posts_array as $post) {
					if ($post->post_excerpt == $master['ListingKey']) {
						if($post->post_status == 'publish') //VNEW
						{
							$isFound = true;
						}
					}
				}
				if (!$isFound) {
					//Verbose
					$this->WriteLog("Property Not Found:" . $master['ListingKey'] . $master['ModificationTimestamp']);
					$keys[] = $master['ListingKey'];
				}
			}
		
			if (isset($keys)) {
				$chunck = array_chunk($keys, 75);
				foreach ($chunck as $event) {
					$update_keys = implode(",", $event); //$event is the name we got from copy and paste			
					$this->WriteLog("Runing Update (Step4a) Process(Punch)");
					//WorkAround To Crea Issue	//Bug With Crea	
				/*	$this->WriteLog("WorkAround To Crea:");
					$fake = $this->service->Search("Property", "Property", '(ID="13255288")', array(
						"Limit" => '1',
						"Culture" => $this->culture
					));
					$this->WriteLog("Update:" . '(ID=' . $update_keys . ')');*/
					$update_properties = $this->service->Search("Property", "Property", '(ID=' . $update_keys . ')', array(
						"Limit" => '100',
						"Culture" => $this->culture
					));
					$total             = count($update_properties);
					$this->WriteLog("Retrieved Update (Punch) List Results Total:" . $total);
					$this->crunch($update_properties, $total);
				}
			}
		}
		
		function clear_cache() {
			if ( function_exists( 'w3tc_pgcache_flush' ) ) {
				w3tc_pgcache_flush();
			} else if ( function_exists( 'wp_cache_clear_cache' ) ) {
				wp_cache_clear_cache();
			}
		}
		
		public function begin_log($id,$cat)
		{
		
			$log = new Logging();
			$wp_upload_dir = wp_upload_dir();
			$log->lfile($wp_upload_dir['basedir'] . '/soldpress/soldpress-log-id.txt');		
			$log->lwrite($id .'-'.$cat);
			$log->lclose();
			
			//Create Transaction Log Based On UniqId
			$wp_upload_dir = wp_upload_dir();
			$this->log->lfile($wp_upload_dir['basedir'] . '/soldpress/logs/soldpress-log-'.$id .'-'.$cat.'.txt');	

			$this->WriteLog('///// Begin Sync ' . $id);
		}
		
		public function end_log($id)
		{
			$this->WriteLog('///// End Sync' . $id);
			$this->log->lclose();
		}
		
		public function sync_listings()
		{
			$id = uniqid('sp_');			
			$this->begin_log($id,'listing');
						
			do_action( 'presstrends_event', 'sync_start_listing');	
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_listings:Sync Disabled');
				$this->end_log($id);
				return;
			}
			
			$this->WriteLog('///// Start Listings Sync ' . $id);
			
			date_default_timezone_set('UTC');
			
			//$this->cache_delete_master_properties();
			//$this->cache_delete_lastupdate_properties();
			
			$this->WriteLog('(Step 1) $this->connect()');
			if ($this->connect()) {
				
				$lastupdate = get_option('sc-lastupdate');
				
				update_option('sc-status', true);
				update_option('sc-soldpress_listing_sync-start', time());
				update_option('sc-soldpress_listing_sync-end', '');
				
				if (!$lastupdate) {
				
					$this->WriteLog('(Step 2) First Time Sync');
					$master_properties =  $this->cache_get_master_properties();
					
					$total  = count($master_properties);
					$this->WriteLog('Last Update Not Found Syncing All Data. Total Records: ' . $total);
					
					$this->punch($master_properties, $this->culture);
				
					update_option('sc-lastupdate', new DateTime());
					
					$this->cache_delete_master_properties();														
				} 
				else {								
					$loginURL = get_option("sc-url", "http://sample.data.crea.ca/Login.svc/Login");
					if ($loginURL == "http://sample.data.crea.ca/Login.svc/Login") {
						$this->sync_properties("LastUpdated=2011-05-08T22:00:17Z");
					} else {
						$this->sync_properties("LastUpdated=" . $lastupdate->format('c'));
					}
					
					update_option('sc-lastupdate', new DateTime());		
					
					$this->cache_delete_master_properties();
				//	$this->cache_delete_lastupdate_properties();
				}
							
				update_option('sc-soldpress_listing_sync-end', time());
				update_option('sc-status', false);	
				
				$this->WriteLog('(Step 5) $this->disconnect()');
				$this->disconnect();
				
				$this->WriteLog('Clear Cache');				
				$this->clear_cache();
							
				$this->end_log($id);
				do_action( 'presstrends_event', 'sync_end_listing');	
	
			}
			
			return $id;
		}
		
		public function sync_listings_update()
		{
			$id = uniqid('sp_');			
			$this->begin_log($id,'listings_update');
						
			do_action( 'presstrends_event', 'sync_start_listing');	
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_listings_update:Sync Disabled');
				$this->end_log($id);
				return;
			}
			
			$this->WriteLog('///// Start Listings Sync ' . $id);
			
			date_default_timezone_set('UTC');
			
			$this->WriteLog('(Step 1) $this->connect()');
			if ($this->connect()) {
				
				$lastupdate = get_option('sc-lastupdate');
				
			//	update_option('sc-status', true);
			//	update_option('sc-soldpress_listing_sync-start', time());
			//	update_option('sc-soldpress_listing_sync-end', '');
				
				if ($lastupdate) 
				{
					$properties = $this->cache_get_lastupdate_properties($crit);		
					$total = count($properties);
					$this->WriteLog("Retrieved Update List Results Total:" . $total);
					//Save To Database
					$this->crunch($properties, $total);
				}
				
			//	update_option('sc-lastupdate', new DateTime());					
			//	update_option('sc-soldpress_listing_sync-end', time());
			//	update_option('sc-status', false);	
				
				$this->WriteLog('(Step 5) $this->disconnect()');
				$this->disconnect();
				
				$this->WriteLog('Clear Cache');				
				$this->clear_cache();
							
				$this->end_log($id);
				do_action( 'presstrends_event', 'sync_end_listing');	
	
			}
			
			return $id;
		}
		
		public function sync_pictures()
		{
			$id = uniqid('sp_');
			$this->begin_log($id,'pictures');
			do_action( 'presstrends_event', 'sync_start_picture');	
			
			update_option('sc-soldpress_picture_sync-start', time());
			update_option('sc-soldpress_picture_sync-end', '');
				
				
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_pictures:Sync Disabled');
				$this->end_log($id);
				return;
			}
			
			$this->WriteLog('///// Start Picture Sync ' . $id);
			
			if ($this->connect()) {
				$this->sync_all_pictures();
			}
			$this->disconnect();
			
			$this->end_log($id);
			
			update_option('sc-soldpress_picture_sync-end', time());
			do_action( 'presstrends_event', 'sync_end_picture');
		
			return $id;
		}
		
		public function sync_xml()
		{
			$id = uniqid('sp_');		
			$this->begin_log($id,'xml');
			do_action( 'presstrends_event', 'sync_start_xml');	
			
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_xml:Sync Disabled');
				$this->end_log($id);
				return;
			}
			
			$this->WriteLog('///// Start Xml Sync ' . $id);
			
			if ($this->connect()) {
				$this->sync_all_xml();
			}
			$this->disconnect();
			
			$this->end_log($id);
			
			do_action( 'presstrends_event', 'sync_end_xml');
		
			return $id;
		}
		
		public function sync_geo()
		{
			$id = uniqid('sp_');		
			$this->begin_log($id,'geo');
			do_action( 'presstrends_event', 'sync_start_geo');	
			
			update_option('sc-soldpress_geo_sync-start', time());
			update_option('sc-soldpress_geo_sync-end', '');
			
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_geo:Sync Disabled');
				$this->end_log($id);
				return;
			}		
			$this->WriteLog('///// Start Geo Sync ' . $id);
			$this->sync_all_geo();			
			$this->end_log($id);
			
			do_action( 'presstrends_event', 'sync_end_geo');
		
			update_option('sc-soldpress_geo_sync-end', time());
			
			return $id;
		}
		
		public function sync_cleanup()
		{
			$id = uniqid('sp_');		
			$this->begin_log($id,'cleanup');
			
			do_action( 'presstrends_event', 'sync_start_cleanup');	
			update_option('sc-soldpress_cleanup_sync-start', time());
			update_option('sc-soldpress_cleanup_sync-end', '');
			
			$syncenabled = get_option("sc-sync-enabled", false);
			if ($syncenabled != true) {
				$this->WriteLog('sync_geo:Sync Disabled');
				$this->end_log($id);
				return;
			}		
			$this->WriteLog('///// Start Cleanup Sync ' . $id);
			
			
			global $wpdb;
			$posts_array = $wpdb->get_results("select ID,post_name,post_excerpt,post_status,post_date 
			from $wpdb->posts 
			where post_type = 'sp_property'");
			
			$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
			
			foreach ($posts_array as $post) {
				if ($post->post_status == "trash") 
				{
					
					$this->WriteVerboseLog('Post Found In Trash ' . $ListingKey);						
					$ListingKey = $post->post_excerpt;
					if(empty($ListingKey)) //Pre Version 1.3 postname was listing key
					{
						$ListingKey = $post->post_name;
					}
					$post_id = $post->ID;
					
					$photosCount = get_post_meta($post_id,'dfd_PhotosCount',true) ;										
					$wp_upload_dir = wp_upload_dir(); 
					$this->WriteVerboseLog('Post Found In Trash ' . $ListingKey . 'PhotoCount' . $photosCoun);
					$photoindex = $photosCount - 1;
					for ($i=0; $i<=$photoindex; $i++)
					{
						$filename      = $ListingKey . '-' . $type . '-' . $i . '.jpg';		
						$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;
						
						$this->WriteVerboseLog('Check File' . $filepath);
						if(file_exists ($filepath))
						{						
							//Delete File
							$this->WriteVerboseLog('Delete Image ' . $filepath );	
							unlink($filepath);		
						}
						else
						{
							$this->WriteVerboseLog('No Image ' . $filepath );	
						}						
					}
					
					if($addmedialib == 1){
						$this->WriteVerboseLog('Delete From Media Lib' . $filepath );
						$args        = array(
							'post_type' => 'attachment',
							'numberposts' => -1,
							'post_status' => null,
							'post_parent' => $post_id
						);
						$attachments = get_posts($args);
						if ($attachments) {
							foreach ($attachments as $attachment) {
								wp_delete_attachment($attachment->ID, true);
							}
						}				
					}
				
				}
			}

			$this->WriteVerboseLog('Delete Logs ');		
			 $files = glob($wp_upload_dir['basedir'] . '/soldpress/logs/'."*");
				foreach($files as $file) {
					if(is_file($file)
					&& time() - filemtime($file) >= 5*24*60*60) { // 28 days
						$this->WriteVerboseLog('Delete Log ' . $file );	
						unlink($file);
					}
				}

			
			$this->end_log($id);
			
			do_action( 'presstrends_event', 'sync_end_cleanup');
			update_option('sc-soldpress_cleanup_sync-end', time());
			return $id;
		}
		
		private function cache_get_master_properties()
		{
			$cache_disable = $this->cache;
			$wp_upload_dir = wp_upload_dir();
			$filePath = $wp_upload_dir['basedir'] . '/soldpress/master.json';
			
			$this->WriteLog("cache_get_master_properties : Cache Mode = " . $cache_disable);			
				
			//Does File Exist		
			if(file_exists ($filePath))
			{
				$this->WriteLog("cache_get_master_properties : Retrieved Master List Load From Cache");
				$master_properties = json_decode(file_get_contents($filePath), true);
			}
			else{				
				$this->WriteLog("cache_get_master_properties : Retrieved Master List Load From service->Search (ID=*)");
				$master_properties = $this->service->Search("Property", "Property", '(ID=*)', array(
					"Limit" => '100',
					"Culture" => $this->culture
				));
				
				if($cache_disable)
				{
					$this->WriteLog("cache_get_master_properties : Save File" . $filePath);			
					file_put_contents($filePath,json_encode($master_properties));
				}
			}
			
			$total = count($master_properties);
			$this->WriteLog("Retrieved Master List Results Total:" . $total);
			return $master_properties;			
		}
		
		private function cache_delete_master_properties()
		{
			$this->WriteLog("cache_delete_master_properties");
			
			$wp_upload_dir = wp_upload_dir();
			$filePath = $wp_upload_dir['basedir'] . '/soldpress/master.json';
			
			if(file_exists ($filePath)){
				$this->WriteLog("cache_delete_master_properties: cache delete");
				unlink($filePath);
			}
		}
		
		private function cache_get_lastupdate_properties($crit)
		{
			$cache_disable = false;
			$wp_upload_dir = wp_upload_dir();
			$filePath = $wp_upload_dir['basedir'] . '/soldpress/properties.json';
			
			if(file_exists ($filePath))
			{			
				$this->WriteLog("Retrieved Property List Load From Cache" . filePath);
				$filePath = $wp_upload_dir['basedir'] . '/soldpress/properties.json';
				$properties = json_decode(file_get_contents($filePath), true);		
			}
			else
			{			
				$this->WriteLog("WorkAround To Crea:");
				$fake = $this->service->Search("Property", "Property", '(ID="13255288")', array(
					"Limit" => '1',
					"Culture" => $this->culture
				));
			//	$this->service->FreeResult($fake);
				
				$this->WriteLog('Retrieved Master List Load From service->' . $crit);
				$properties = $this->service->Search("Property", "Property", $crit, array(
					"Limit" => '100',
					"Culture" => $this->culture
				));
				
				//Save Property File To File For Loading	
				if($cache_disable)
				{					
					$filePath = $wp_upload_dir['basedir'] . '/soldpress/properties.json';
					file_put_contents($filePath,json_encode($properties));	
				}
			}
			
			return $properties;
		}
		
		private function cache_delete_lastupdate_properties()
		{
			$wp_upload_dir = wp_upload_dir();
			$filePath = $wp_upload_dir['basedir'] . '/soldpress/properties.json';
			if(file_exists ($filePath)){
				unlink($filePath);
			}
		}
				
		private function sync_properties($crit)
		{					
			$this->WriteLog('Sync Start');
			global $wpdb;
			$wpdb->query("set wait_timeout = 1200"); 
			
			//
			// STEP 1 : Get Last Synced Data
			//
			
			//if Cache is enabled do not get last update
			//We Get Only Master List
			
			if($this->cache != true)
			{
				$properties = $this->cache_get_lastupdate_properties($crit);		
				$total = count($properties);
				$this->WriteLog("Retrieved Update List Results Total:" . $total);
				//Save To Database
				$this->crunch($properties, $total);
			}
			
			//	$this->service->FreeResult($properties);
			//
			// STEP 2 : Go Through Master List - DELETE
			//
			
			//
			// STEP 3 : Go Through Master List - UPDATE MOD CHANGES
			//
			
			$master_properties =  $this->cache_get_master_properties();				
			$total = count($master_properties);
			if($total == 0)
			{
				$this->WriteLog("Zero Master Properties Returned Ending Operation");
				return;
			}
			$this->WriteLog("(Step3) Run Deletion and Mod Process(Munch)");
			$this->munch($master_properties, $this->culture);
			
			//
			// STEP 4 : Audit Check
			// If the sync has missed some properties we can go get them and update
			//
			$this->WriteLog("(Step5) Process(Punch)");
			$this->punch($master_properties, $this->culture); 
			
			//$this->service->FreeResult($master_properties);
			
			return true;
		}
		
		
	
		private function sync_all_pictures()
		{
			$this->WriteLog('Begin Picture Sync');
			
			update_option('sc-soldpress_photo_sync-start-status', true);
			update_option('sc-soldpress_photo_sync-start', time());
			update_option('sc-soldpress_photo_sync-end', '');
			
			global $wpdb;
			$wpdb->query("set wait_timeout = 1200");
			
			$posts_array   = $wpdb->get_results("SELECT ID,post_name,post_excerpt 
			FROM $wpdb->posts p
			LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
				AND pm.meta_key = 'sc-sync-picture' 			
			WHERE post_type = 'sp_property' AND pm.post_id is null
			AND (post_status = 'publish' OR post_status = 'private') 		
			ORDER BY post_date DESC ");
								
			
			$photo_quality = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
			$total  = count($posts_array);
			$this->WriteLog('Total Photo Records: ' . $total);
			$count = 0;
			$addmedialib = get_option("sc-sync-medialib",1);
			$sync_agent_large = get_option('sc-sync-picture-agent-large',0);
			
			foreach ($posts_array as $listing) {
				$count      = $count + 1;
				$post_id    = $listing->ID;
				//Check and see if there if property data needs to be synced
				$meta  = get_post_meta($post_id, 'sc-sync-picture');
				$listingKey = $listing->post_excerpt;
				if ($listingKey) { //If Someone manually adds a listing the key is wrong
					if ($meta) {
						//Verbose Log
						$this->WriteVerboseLog('Photo Record is Synced - PostId:' . $post_id . ' - listingkey:' . $listingKey .'Record'. $count);
					} else {
						$this->WriteVerboseLog('Begin Listings Picture Sync - PostId:' . $post_id . ' - $listingkey:' . $listingKey .'Record'. $count);	
						$saved = $this->sync_propertyobject($listingKey, $photo_quality, $post_id,$addmedialib);
						if($saved)//Todo :// Do we want to remove
						{
							update_post_meta($post_id, 'sc-sync-picture', true);
						}
					}
				}
				
				$metaagent = get_post_meta($post_id, 'sc-sync-picture-agent', true);
				if (!$metaagent) {
					//List Agent
					$agentKey = get_post_meta($post_id, 'dfd_ListAgentKey', true);
					$this->WriteVerboseLog('Begin Agent Picture Sync - PostId:' . $post_id . ' AgentKey:' . $agentKey);
					if($sync_agent_large == 1)
					{		
						$this->sync_agentobject($agentKey, 'LargePhoto', $post_id, 'agent');
					}
					
					$this->sync_agentobject($agentKey, 'ThumbnailPhoto', $post_id, 'agent');				
					//Co Agent
					$coagentKey = get_post_meta($post_id, 'dfd_CoListAgentKey', true);
					if ($coagentKey != "") {
						$this->WriteVerboseLog('Begin CoAgent Picture Sync - PostId:' . $post_id . ' CoAgentKey:' . $coagentKey);
						if($sync_agent_large == 1)
						{		
							$this->sync_agentobject($agentKey, 'LargePhoto', $post_id, 'agent');
						}
						
						$this->sync_agentobject($coagentKey, 'ThumbnailPhoto', $post_id, 'coagent');						
					}
					//We Have Complete The Agent and CoAgent Sunc Process
					update_post_meta($post_id, 'sc-sync-picture-agent', true);
				}
				
				$metaoffice = get_post_meta($post_id, 'sc-sync-picture-office', true);
				if (!$metaoffice) {
					//List Agent
					$officeKey = get_post_meta($post_id, 'dfd_ListOfficeKey', true);
					$this->WriteVerboseLog('Begin Office Picture Sync' . $post_id . 'AgentKey' . $officeKey);
					$this->sync_officeobject($officeKey, 'ThumbnailPhoto', $post_id);
					//We Have Complete The Listing Process
					update_post_meta($post_id, 'sc-sync-picture-office', true);
				}
				
				
			}
			update_option('sc-soldpress_photo_sync-end', time());
			update_option('sc-soldpress_photo_sync-start-status', false);
			
			$this->WriteLog('End Picture Sync');	
			
			$this->sync_all_xml();			
		}
			
		public function sync_all_geo()
		{
			$this->WriteLog('Begin GEO Sync');
		
			global $wpdb;
			$wpdb->query("set wait_timeout = 1200");
			$geo_enabled = get_option('sc-geo-sync-enabled', false);
			if($geo_enabled){
			
				$posts_array   = $wpdb->get_results("SELECT ID,post_name,post_excerpt 
				FROM $wpdb->posts p
				LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
					AND pm.meta_key = 'sc-sync-geo' 			
				WHERE post_type = 'sp_property' AND pm.post_id is null
				AND (post_status = 'publish' OR post_status = 'private') 		
				ORDER BY post_date DESC ");
				
				$total  = count($posts_array);
				$this->WriteLog('Total Geo Records: ' . $total);
			
			
				foreach ($posts_array as $listing) {
					//Get geo Data
					$post_id    = $listing->ID;
					
					$geosync = get_post_meta($post_id, 'sc-sync-geo', true);
					
					if (empty($geosync)) 
					{		
						//need to be optimized so multi calls not happending.
						
						$address = "";
		
						if(get_post_meta($post_id,'dfd_UnparsedAddress',true)!= "")
						{
							$address = $address . get_post_meta($post_id,'dfd_UnparsedAddress',true) . ', ';		
						}
						if(get_post_meta($post_id,'dfd_City',true)!= "")
						{
							$address = $address . get_post_meta($post_id, 'dfd_City', true ) . ', ';
						}
						if(get_post_meta($post_id,'dfd_StateOrProvince',true)!= "")
						{
						$address = $address . get_post_meta( $post_id, 'dfd_StateOrProvince', true ) . ', ';	
						}
						if(get_post_meta($post_id,'dfd_PostalCode',true)!= "")
						{
						$address = $address . get_post_meta( $post_id, 'dfd_PostalCode', true ) . ', ';	
						}
		
						//$address = stripslashes($address);
						
						if(!empty($address))
						{
							$address=urlencode($address);
							
							$googleapiurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false&components=country:CA";
							
							$this->WriteVerboseLog('Begin Geo Sync' . $post_id . ' Url: ' . $googleapiurl);
							
							$geo = @file_get_contents($googleapiurl);
							
							if(!empty($geo))
							{
								try
								{
									$result = json_decode($geo, true);
									if($result['status'] == 'OK')
									{							   
									  $location = $result['results'][0]['geometry']['location'];
									  $lat = $location['lat'];
									  $lon = $location['lng'];		

									  update_post_meta($post_id, 'geo_lat', $lat); 		
									  update_post_meta($post_id, 'geo_lon', $lon); 	
									  
									  $address_componet = $result['results'][0]['address_components'];
													   
									   foreach($address_componet as $item) 
									   {								   
											if (in_array("country", $item["types"])) 
											{
												if('US' == $item["short_name"])
												{
													return;
												}	
											}
											
											if (in_array("neighborhood", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_neighborhood', $longnamevalue);
											}
											
											if (in_array("sublocality ", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_sublocality', $longnamevalue);
											}
											
											if (in_array("subpremise", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_subpremise', $longnamevalue);
											}
											
											if (in_array("premise", $item["types"])) 
											{
												$longnamevalue = $item["premise"]; 
												update_post_meta($post_id, 'geo_premise', $longnamevalue);
											}
											
											
											if (in_array("street_address", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_street_address', $longnamevalue);
											}
											
											
											if (in_array("locality", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_locality', $longnamevalue);
											}
											
											if (in_array("route", $item["types"])) 
											{
												$longnamevalue = $item["long_name"]; 
												update_post_meta($post_id, 'geo_route', $longnamevalue);
											}
											
											$location_type = $result['results'][0]['geometry']['location_type'];
											$formatted_address = $result['results'][0][$formatted_address];
									       	update_post_meta($post_id, 'geo_location_type', $location_type); 	
											update_post_meta($post_id, 'geo_formatted_address', $formatted_address);
											
											update_post_meta($post_id, 'sc-sync-geo', true);
										}
																								  
									}	
								}
								catch(Exception $e)
								{
									update_post_meta($post_id, 'geo_error', $e->getMessage());
								}
							}
							else
							{
								$this->WriteVerboseLog('Geo Record Empty Sync' . $post_id . 'data' . $geo );
							}
						}
						else
						{
							$this->WriteVerboseLog('Geo Record Address Empty Sync ' . $post_id . ' data' . $address );
						}
					}
					else
					{
						$this->WriteVerboseLog('Geo Record Sync' . $post_id );
					}
				}				
			}
			
			$this->WriteLog('End GEO Sync');
		
		}
		
		public function sync_all_xml()
		{
			global $wpdb;
			$wpdb->query("set wait_timeout = 1200");
													
			$this->WriteLog('Begin Xml Sync');
			$xml_enabled = get_option('sc-xml-sync-enabled', false);
			if($xml_enabled){
								
				$posts_array   = $wpdb->get_results("SELECT ID,post_name,post_excerpt 
				FROM $wpdb->posts p
				LEFT JOIN $wpdb->postmeta pm on pm.post_id = p.ID 
					AND pm.meta_key = 'dfd_xml' 				
				WHERE post_type = 'sp_property' AND pm.post_id is null
				AND (post_status = 'publish' OR post_status = 'private') 				
				ORDER BY post_date DESC ");
				
				$total  = count($posts_array);
				$this->WriteLog('Total XML Records: ' . $total);
			
				foreach ($posts_array as $listing) {
					//Get Xml Data
					$post_id    = $listing->ID;
					
					$xmlsync = get_post_meta($post_id, 'dfd_xml', true);
					if (!$xmlsync) 
					{				
						$listingKey = $listing->post_excerpt;
						
						$this->WriteVerboseLog('XmlSync - PostId:' . $post_id . ' - listingkey:' . $listingKey);
						
						$xmlProperty = $this->service->Search("Property", "Property", '(ID=' . $listingKey .')', array(
							"Limit" => '1',
							"Culture" => $this->culture,
							"Format" => 'STANDARD-XML',
						));
						
						$response_xml  = $this->service->GetLastBodyResponse();					
						$xml = simplexml_load_string($response_xml,"SimpleXMLElement", LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOWARNING); 				
				
						$node = "RETS-RESPONSE";
						$propertydetails = $xml->{$node}->PropertyDetails; 
						$xml = $propertydetails->asXML();
						
						if(isset($xml)){
							if($xml != ''){
								update_post_meta($post_id, 'dfd_xml', $xml);
							}
						}
						
						$this->service->FreeResult($xmlProperty);
						
					}
				}				
			}
			$this->WriteLog('End Xml Sync');
			
		}
		
		
		
		public function sync_propertyobject($id, $type, $post_id,$addmedialib)
		{		
			if($addmedialib == 1){
				$args        = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => $post_id
				);
				$attachments = get_posts($args);
				if ($attachments) {
					foreach ($attachments as $attachment) {
						wp_delete_attachment($attachment->ID, true);
					}
				}	
				
				$isAttached = false;				
			}
									
			$record = $this->service->GetObject("Property", $type, $id);				
			$image_count = 0;				
			$saved  = false;
			
			//Get Picture Count		
			foreach ($record as &$image) {
				if ($image["Success"]) {
				
					$fileType = $image["Content-Type"];
					
					$fileExtention = "";					
					if($fileType == "image/jpeg"){
						$fileExtention = ".jpg";
					}
				/*	else if($fileType == "image/png"){
						$fileExtention =  image_type_to_extension(IMAGETYPE_PNG);
					}*/ //Not Supported
				
					
					if($fileExtention != "")
					{
						$filename      = $image["Content-ID"] . '-' . $type . '-' . $image["Object-ID"] . $fileExtention;
						$filePath      = SOLDPRESS_BASEUPLOAD_FILE  .'/' . $filename;
						$this->WriteVerboseLog($filePath);
						if ($image["Data"] != "") {
							$image_count = $image_count +1;
							file_put_contents($filePath, $image["Data"]); 
							$saved = true;
						}
						
						//User may want to sync to media lib
						if($addmedialib == 1){
							$wp_filetype   = wp_check_filetype(basename($filename), null);
							$attachment    = array(
								'guid' => SOLDPRESS_BASEUPLOAD_FILE .'/'. basename($filename),
								'post_mime_type' => $wp_filetype['type'],
								'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
								'post_content' => '',
								'post_status' => 'inherit'
							);
							$attach_id     = wp_insert_attachment($attachment, '/soldpress/' . $filename, $post_id);
							require_once(ABSPATH . 'wp-admin/includes/image.php');
							//Attach The First Object	
							if (!$isAttached) {
								$isAttached  = true;
								$attach_data = wp_generate_attachment_metadata($attach_id, '/soldpress/' . $filename);
								wp_update_attachment_metadata($attach_id, $attach_data);
								
							}
						}
					}
				}
			}
			
			if($image_count == 0)
			{
				$this->WriteVerboseLog('Zero Picture Issue Detected' . $id );
				//Zero Picture Detected Use 
				$record  = $this->service->GetObject("Property", $type, $id , 0 );
				
				foreach ($record as &$image) {
				
					$fileType = $image["Content-Type"];						
					$fileExtention = "";					
					if($fileType == "image/jpeg"){
							$fileExtention = ".jpg";
					}
					/*else if($fileType == "image/png"){
						$fileExtention =  image_type_to_extension(IMAGETYPE_PNG);
					}*/ //Not Supported
					
					if($fileExtention != "") // If we have an image extension
					{
						
							if ($image["Success"]) {
								$filename      = $id . '-' . $type . '-0.jpg';
								$wp_upload_dir = wp_upload_dir();
								$filePath      = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;
								if ($image["Data"] != "") {
									file_put_contents($filePath, $image["Data"]); //We Change This In Settings		
									$saved =true;
								}
							}
						
					}				
				}
			}
			
			return $saved;
		}
		
		public function sync_agentobject($id, $type, $post_id, $metatype)
		{
			if (empty($id)) {
				$this->WriteVerboseLog('sync_agentobject' . $id .' ' . $type .' ' . $post_id .' ' . $metatype);
				return;
			}
						
			$record = $this->service->GetObject("Agent", $type, $id, "");
			foreach ($record as &$image) {
				if ($image["Success"]) {
					$filename      = $id . '-agent-' . $type . '.jpg';
					$wp_upload_dir = wp_upload_dir();
					$filePath      = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;
					if ($image["Data"] != "") {
						file_put_contents($filePath, $image["Data"]);
						update_post_meta($post_id, 'sc-sync-picture-' . $metatype . '-file', $filename);
						update_post_meta($post_id, 'sc-sync-picture-' . $metatype . '-file-'.$type, $filename);
					} else {
						update_post_meta($post_id, 'sc-sync-picture-' . $metatype . '-file', '');
					}
				} else {
					update_post_meta($post_id, 'sc-sync-picture-' . $metatype . '-file', '');
				}
			}
		}
		public function sync_officeobject($id, $type, $post_id)
		{
			if (empty($id)) {
				return;
			}
			
			$record = $this->service->GetObject("Office", $type, $id, "");
			foreach ($record as &$image) {
				if ($image["Success"]) {
					$filename      = $id . '-listing-' . $type . '.jpg';
					$wp_upload_dir = wp_upload_dir();
					$filePath      = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;
					if ($image["Data"] != "") {
						file_put_contents($filePath, $image["Data"]);
						update_post_meta($post_id, 'sc-sync-picture-office-file', $filename);
					} else {
						update_post_meta($post_id, 'sc-sync-picture-office-file', '');
					}
				} else {
					update_post_meta($post_id, 'sc-sync-picture-office-file', '');
				}
			}
		}
		//Obsolete - Search In Lite Version Remove From Here
		public function searchresidentialproperty($crit, $template, $culture)
		{
			$render = 'Listing not found.';
			if ($culture == '') {
				$culture = "en-CA";
			}
			$results = $this->service->SearchQuery("Property", "Property", $crit, array(
				"Limit" => 1,
				"Culture" => $culture
			));
			while ($rets = $this->service->FetchRow($results)) {
				if ($template == '') {
					foreach ($rets as $key => &$val) {
						if ($val != NULL) {
							$render .= $key . ":" . $val . "<br>";
						}
					}
				} else {
					$render = file_get_contents($this->templateLocation . $template);
					eval("\$render = \"$render\";");
				}
			}
			$this->service->FreeResult($results);
			return $render;
		}
		public function getpropertyobject($id, $type)
		{
			$record = $this->service->GetObject("Property", $type, $id);
			//var_dump($record);
			//We won't log this due to data size potential (could be a large image)
			//$this->DisplayLog(var_dump($record));		
			//$this->debug(false);
		}
		public function debug($logResponse = true)
		{
			if ($last_request = $this->service->LastRequest()) {
				$this->displaylog('Reply Code ' . $last_request['ReplyCode'] . ' [' . $last_request['ReplyText'] . ']');
			}
			$this->displaylog('LastRequestURL: ' . $this->service->LastRequestURL() . PHP_EOL);
			if ($logResponse) {
				$this->displaylog($this->service->GetLastServerResponse());
			}
		}
		private function WriteLog($text)
		{
			$this->log->lwrite($text . PHP_EOL);				
			$this->displaytrace($text);
		}
		
		private function WriteVerboseLog($text)
		{
			if($this->verbose){
				$this->log->lwrite($text . PHP_EOL);
			}
		}
		
		private function displaylog($text)
		{
			echo $text . "<br>";
		}
		
		private function displaytrace($text)
		{
			if($this->trace == true)
			{
				echo "<!--";
				echo $text . "--->";		
			}
		}
		function displayheader($text)
		{
			echo "<div><h1>";
			echo $text . "</h1>";
		}
		function displayfooter()
		{
			//echo "<br><p><a href='http://sanskript.com'>Powered by Sanskript SoldCity Wordpress Plugin<a></p></div>";
		}
		private function firewalltestconn($hostname, $port = 443)
		{
			$fp = @fsockopen($hostname, $port, $errno, $errstr, 5);
			if (!$fp) {
				echo "Firewall Test: {$hostname}:{$port} FAILED<br>\n";
				return false;
			} else {
				@fclose($fp);
				echo "Firewall Test: {$hostname}:{$port} GOOD<br>\n";
				return true;
			}
		}
		function firewalltest()
		{
			//We are testing against crea and maintaing the integretiy of the phrets file.
			//This function is copied from phrest
			$google    = $this->firewalltestconn("google.com", 80);
			$crt80     = $this->firewalltestconn("data.crea.ca", 80);
			$flexmls80 = $this->firewalltestconn("sample.data.crea.ca", 80);
			if (!$google && !$crt80 && !$flexmls80) {
				echo "Firewall Result: All tests failed.  Possible causes:";
				echo "<ol>";
				echo "<li>Firewall is blocking your outbound connections</li>";
				echo "<li>You aren't connected to the internet</li>";
				echo "</ol>";
				return false;
			}
			if ($google && $crt80 && $flexmls80) {
				echo "Firewall Result: All tests passed.";
				return true;
			}
			if (!$google || !$crt80 || !$flexmls80) {
				echo "Firewall Result: At least one port 80 test failed.  ";
				echo "Likely cause: One of the test servers might be down.";
				return true;
			}
			echo "Firewall Results: Unable to guess the issue.  See individual test results above.";
			return false;
		}
	}
?>