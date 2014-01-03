<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
?>
<div class="well2">
	<?php dynamic_sidebar('soldpress-sidebar'); ?>
	<?php if(get_option('sc-layout-agentlisting',true)){ ?> 
	<h3>Agent Details</h3>
	<aside id="sp_listingagent">
		<div class="sp well3" <?php echo sp_microdata("","","http://schema.org/RealEstateAgent")?> >
			<?php if(get_post_meta($post->ID,'sc-sync-picture-agent',true) != ''){
				if(get_post_meta($post->ID,'sc-sync-picture-agent-file',true) != ''){ ?> 
				<img src="<?php $wp_upload_dir = wp_upload_dir();  echo $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-agent-file',true); ?>">
			<?php }}?>
			<strong <?php echo sp_microdata("name","","")?>><?php echo get_post_meta($post->ID,'dfd_ListAgentFullName',true); ?></strong><br />
			<address <?php echo sp_microdata("","","http://schema.org/contactpoint")?>>			  
			<?php echo get_post_meta($post->ID,'dfd_ListAgentDesignation',true); ?><br />
			<?php if(get_post_meta($post->ID,'dfd_ListAgentOfficePhone',true) != ''){ ?>  	
				<abbr  title="Phone">O:</abbr><span <?php echo sp_microdata("telephone","","")?> > <?php echo get_post_meta($post->ID,'dfd_ListAgentOfficePhone',true); ?></span><br />
			<?php }?> 
			<?php if(get_post_meta($post->ID,'dfd_ListAgentPager',true) != ''){ ?> 
			  <abbr title="Pager">P:</abbr> <?php echo get_post_meta($post->ID,'dfd_ListAgentPager',true); ?><br />
			<?php }?> 
			<?php if(get_post_meta($post->ID,'dfd_ListAgentFax',true) != ''){ ?>   
			  <abbr title="Fax">F:</abbr> <?php echo get_post_meta($post->ID,'dfd_ListAgentFax',true); ?><br />
			<?php }?>
			<?php if(get_post_meta($post->ID,'dfd_ListAgentCellPhone',true) != ''){ ?>   
			  <abbr title="Cell">C:</abbr> <?php echo get_post_meta($post->ID,'dfd_ListAgentCellPhone',true); ?><br />
			<?php }?> 						
			<?php if(get_post_meta($post->ID,'dfd_ListAgentURL',true) != ''){ ?>  
			  <br /><a href="<?php echo get_post_meta($post->ID,'dfd_ListAgentURL',true); ?>">REALTOR® Website</a>
			<?php }?> 					
			</address>
			<?php if(get_post_meta($post->ID,'sc-sync-picture-office',true) != ''){
				if(get_post_meta($post->ID,'sc-sync-picture-office-file',true) != ''){ ?> 	
				<img src="<?php $wp_upload_dir = wp_upload_dir();  echo $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-office-file',true); ?>">
			<?php }}?>
			<address>
			<small><?php echo get_post_meta($post->ID,'dfd_ListOfficeName',true); ?></small><br />
			<?php echo get_post_meta($post->ID,'dfd_ListOfficePhone',true); ?><br />
			<?php echo get_post_meta($post->ID,'dfd_ListOfficeFax',true); ?><br />
			<?php echo get_post_meta($post->ID,'dfd_ListOfficeURL',true); ?><br />
			</address>
		</div>
	</aside>
	<?php if(get_post_meta($post->ID,'dfd_CoListAgentFullName',true) != ''){ ?>  
	<aside id="sp_listingcoagent">			
		<div class="sp well3">	
			<?php if(get_post_meta($post->ID,'sc-sync-picture-agent',true) != ''){
					if(get_post_meta($post->ID,'sc-sync-picture-coagent-file',true) != ''){
				?> 
				<img alt="" src="<?php $wp_upload_dir = wp_upload_dir();  echo $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-coagent-file',true); ?>">
			<?php }}?>
			<address>
				<strong><?php echo get_post_meta($post->ID,'dfd_CoListAgentFullName',true); ?></strong><br />
				<?php echo get_post_meta($post->ID,'dfd_CoListAgentDesignation',true); ?><br />
				<?php if(get_post_meta($post->ID,'dfd_CoListAgentOfficePhone',true) != ''){ ?>  	
					<abbr title="Phone">O:</abbr> <?php echo get_post_meta($post->ID,'dfd_CoListAgentOfficePhone',true); ?><br />
				<?php }?> 
				<?php if(get_post_meta($post->ID,'dfd_CoListAgentPager',true) != ''){ ?> 							
					<abbr title="Pager">P:</abbr> <?php echo get_post_meta($post->ID,'dfd_CoListAgentPager',true); ?><br />
				<?php }?> 
				<?php if(get_post_meta($post->ID,'dfd_CoListAgentFax',true) != ''){ ?> 							
					<abbr title="Fax">F:</abbr> <?php echo get_post_meta($post->ID,'dfd_CoListAgentFax',true); ?><br />
				<?php }?> 
				<?php if(get_post_meta($post->ID,'dfd_CoListAgentCellPhone',true) != ''){ ?> 				
					<abbr title="Cell">C:</abbr> <?php echo get_post_meta($post->ID,'dfd_CoListAgentCellPhone',true); ?><br />
				<?php }?> 
				<?php if(get_post_meta($post->ID,'dfd_CoListAgentURL',true) != ''){ ?> 		
					<br /><a href="<?php echo get_post_meta($post->ID,'dfd_CoListAgentURL',true); ?>">REALTOR® Website</a>
				<?php }?> 													
			</address>
			<address>
			<small><?php echo get_post_meta($post->ID,'dfd_CoListOfficeName',true); ?></small><br />
			<?php echo get_post_meta($post->ID,'dfd_CoListOfficePhone',true); ?><br />
			<?php echo get_post_meta($post->ID,'dfd_CoListOfficeURL',true); ?><br />
			</address>
		</div>				
	</aside>
	<?php }?> 
<?php }?>	
<?php
/*
 if(get_option( 'sc-layout-walkscore',false)){				
		 function getWalkScore($address) {					 
			  //Call Google To Get Lat and Long
			  $address=urlencode($address);
			  $googleapiurl = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
			  $geo = @file_get_contents($googleapiurl);								  
			  $result = json_decode($geo, true);
			  if($result['status'] == 'OK'){							   
				  $location = $result['results'][0]['geometry']['location'];
				  $lat = $location['lat'];
				  $lon = $location['lng'];							 
				  $url = "http://api.walkscore.com/score?format=json&address=$address";
				  $url .= '&lat=' . $lat . '&lon=' . $lon . '&wsapikey='. get_option('sc-layout-walkscore',true);
				  $str = @file_get_contents($url); 
				  return $str; 				  
			  }
			  //We Need To Store Lat Long
		 } 
		
		 $address = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
		 $json = getWalkScore($address);						
		 $result = json_decode($json, true);
		 if($result["status"] == '1')
		 {
			$walkscore = '<div id="walkscore-div" class="pull-right"><p><a target="_blank" href="'. $result["ws_link"].'"><img src="'. $result["logo_url"].'"><span class="walkscore-scoretext">'. $result["walkscore"].'</span></a><span id="ws_info"><a href=". $result["more_info_link"]." target="_blank"><img src="'. $result["more_info_icon"].'" width="13" height="13" "=""></a></span></p></div>';
			echo $walkscore;
	 
		}
	}*/
?>	
<?php dynamic_sidebar('soldpress-sidebar-after'); ?>
</div>