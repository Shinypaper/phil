<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */ 
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
		global $title;
		global $showposts;
		
		$debug_action = get_option("sc-debug-action",0);
 
		if(isset($shorcode))
		{
			if(!empty($shorcode))
			{
				$action = $shorcode;
			}
		}
		
		
		if(empty($action))
		{
			global $wp_query;
			
			if(empty($wp_query->query_vars['sp']))
			{
				$action = isset( $_GET[ 'sp' ] ) ? $_GET[ 'sp' ] : '';
			}
			else
			{
				$action = $wp_query->query_vars['sp'];
				
			}
					
			$title = "";
			$metaquery;
		}
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
		
		if(empty($showposts))
		{
			$showposts = isset( $_GET[ 'showposts' ] ) ? $_GET[ 'showposts' ] : '12';
		}
						
		if($debug_action == 1)
		{
			echo '<!-- Action' .$action .'-->';
		}
		
			
		if(isset($_GET['sort']) && !empty($_GET['sort'])) 
		{		
			if($_GET['sort'] == 'price-high') 
			{ 
				$orderby = 'meta_value_num';
				$order_metakey = 'dfd_ListPrice';
				$orderbydirection = 'DESC';
			} 							
			if($_GET['sort'] == 'price-low') 
			{
				$orderby = 'meta_value_num';
				$order_metakey = 'dfd_ListPrice';
				$orderbydirection = 'ASC';
			}
			if($_GET['sort'] == 'date-new') 
			{ 
				$order_metakey = 'date';
				$orderbydirection = 'DESC'; 
			}
			
			if($_GET['sort'] == 'date-old') 
			{
				$order_metakey = 'date';
				$orderbydirection = 'ASC'; 
			}
		}
		else
		{
			$orderby = get_option('sc-layout-propertylistings-orderby','date');	
			
			if($orderby == "price")
			{	
				$orderby = 'meta_value_num';
				$order_metakey = 'dfd_ListPrice';
			}
			
			$orderbydirection = get_option('sc-layout-propertylistings-orderby-direction','desc');				
		}
		
		if($action == "s")
		{
				$title = "Search";
				$MLS = isset( $_GET[ 'mls' ] ) ? $_GET[ 'mls' ] : '';
				$Address = isset( $_GET[ 'address' ] ) ? $_GET[ 'address' ] : '';
				$PropertyType = isset( $_GET[ 'propertytype' ] ) ? $_GET[ 'propertytype' ] : '';
				$MaxPrice = isset( $_GET[ 'maxprice' ] ) ? $_GET[ 'maxprice' ] : '';
				$MinPrice = isset( $_GET[ 'minprice' ] ) ? $_GET[ 'minprice' ] : '';
				$Bedrooms = isset( $_GET[ 'bedrooms' ] ) ? $_GET[ 'bedrooms' ] : '';
				$Bathrooms = isset( $_GET[ 'bathrooms' ] ) ? $_GET[ 'bathrooms' ] : '';
				$City = isset( $_GET[ 'city' ] ) ? $_GET[ 'city' ] : '';
			    $Waterfront = isset( $_GET[ 'waterfront' ] ) ? $_GET[ 'waterfront' ] : '';
			    $Province = isset( $_GET[ 'province' ] ) ? $_GET[ 'province' ] : '';
				$Transaction = isset( $_GET[ 'transaction' ] ) ? $_GET[ 'transaction' ] : '';
				$Private = isset( $_GET[ 'sp_private' ] ) ? $_GET[ 'sp_private' ] : '';
				$Office = isset( $_GET[ 'office' ] ) ? $_GET[ 'office' ] : '';
				
				if($Transaction != ''){
					//For Rent or For Sale
					if($Transaction == 0)
					{
						$metaquery[] = array(
							'key' => 'dfd_ListPrice',
							'value' => 0,
							'type' => 'NUMERIC',
							'compare' => '='
						);
						
						$title = $title . ' (For Rent)';
					}
					else
					{
						$metaquery[] = array(
							'key' => 'dfd_ListPrice',
							'value' => 0,
							'type' => 'NUMERIC',
							'compare' => '>'
						);
						
						$title = $title . ' (For Sale)';
					}											
					                                    
				}
				
				if($MLS != ''){
					$metaquery[] = array(
						'key' => 'dfd_ListingId',
						'value' => $MLS,
						'compare' => 'LIKE'
					);                            
					$title = $title . ' (MLS® : ' . $MLS .')';                                    
				}
				
				if($Office != ''){
					$metaquery[] = array(
						'key' => 'dfd_ListOfficeKey',
						'value' => $Office,
						'compare' => '='
					);                            
					//Lookup Office 
					//$title = $title . ' (Offile : ' . $Office .')';                                    
				}
				
				//Only Reterive CREA Listing by default
				/*if($Private != ''){						
					if($Private != 1){
						$metaquery[] = array(
							'key' => 'sc_private',
							'compare' => 'NOT EXISTS'
						);	
					}	
					
					$title = $title . ' (Private : ' . $Private .')';  					
				}
				else
				{
					$metaquery[] = array(
						'key' => 'sc_private',
						'compare' => 'NOT EXISTS'
					);	
				}*/
				
				
				if($Address != ''){
					$metaquery[] = array(
						'key' => 'dfd_UnparsedAddress',
						'value' => $PropertyType,
						'compare' => '='
					);                            
					$title = $title . ' (Address : ' . $Address .')';                                    
				}
			   
				if($PropertyType != ''){
					$metaquery[] = array(
						'key' => 'dfd_PropertyType',
						'value' => $PropertyType,
						'compare' => '='
					);                            
					$title = $title . ' (Property Type : ' . $PropertyType .')';                                    
				}
			   			   
				if($MaxPrice != ''){
					if($MinPrice != ''){
						$metaquery[] = array(
							'key' => 'dfd_ListPrice',
							'value' => array( $MinPrice, $MaxPrice),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
						$title = $title . ' (Price : $' . number_format($MinPrice) .' - $'. number_format($MaxPrice) .')';              
					}							  							   
				}

				if($Bedrooms != ''){							   
					if($Bedrooms >= 4){
						$metaquery[] = array(
								'key' => 'dfd_BedroomsTotal',
								'value' => $Bedrooms ,
								'compare' => '>=',
								'type' => 'NUMERIC'
						);            
												   
						$title = $title . ' (Bedrooms : ' . $Bedrooms .')';                   
					}
					else{
						$metaquery[] = array(
								'key' => 'dfd_BedroomsTotal',
								'value' => $Bedrooms ,
								'compare' => '=',
								'type' => 'NUMERIC'
						);
						$title = $title . ' (Bedrooms : 4+)';							   
					}
				}

				if($Bathrooms  != ''){
					if($Bathrooms >= 4){
				   
						$metaquery[] = array(
							'key' => 'dfd_BathroomsTotal',
							'value' => $Bathrooms ,
							'compare' => '>=',
							'type' => 'NUMERIC'
						);
												   
						$title = $title . ' (Bathrooms : ' . $Bathrooms .')'; 
					}
					else{

						$metaquery[] = array(
							'key' => 'dfd_BathroomsTotal',
							'value' => $Bathrooms,
							'compare' => '=',
							'type' => 'NUMERIC'
						);
					   
						$title = $title . ' (Bathrooms : 4+)';
					}
				}
			   
				if($City != ''){
					$metaquery[] = array(
								'key' => 'dfd_City',
								'value' => $City,
								'compare' => 'LIKE'
					);
								   
					$title = $title . ' (City : ' . $City .')';              
				}
				
				if($Waterfront != ''){
					$metaquery[] = array(
						'key' => 'dfd_WaterfrontYN',
						'value' => $Waterfront,
						'compare' => '='
					);
								   
					$subtitle = "No";
					if($Waterfront == 'True')
					{
						$subtitle = "Yes";
					}	
					
					$title = $title . ' (Waterfront : ' . $subtitle .')'; 
								
				}
				
				if($Province != ''){
					$metaquery[] = array(
						'key' => 'dfd_StateOrProvince',
						'value' => $Province,
						'compare' => '='
					);                            
					$title = $title . ' (Province : ' . $Province .')';                                    
				}
				
					   
			$args = array('meta_query' => $metaquery);
						
		}
		else if($action == "f" || $action == "fo")
		{
			//Create Dynamic Filter
			$title = isset( $_GET[ 'title' ] ) ? $_GET[ 'title' ] : 'Listings';
			if($action == "fo"){
				$metaquery = array('relation' => 'OR');
			}
			 foreach ($_GET as $key => $value) {      
				if($key == "sp"){
					continue;
				}
				if($key == "title"){
					continue;
				}
				
				if($key == "type"){
					continue;
				}
										
				$cats = explode(",", $value);
				foreach($cats as $cat) {
					$metaquery[] = array(
									'key' => 'dfd_' . $key,
									'value' => $cat,
									'compare' => 'LIKE'
					);            
				}   
			}	   
		             
		
			$args = array( 'meta_query' => $metaquery);            
		}
		else if($action == "r")
		{
			$key = $wp_query->query_vars['sp_dfd'];
			$cat = $wp_query->query_vars['sp_cat'];
			
			$metaquery[] = array(
				'key' => 'dfd_' . $key,
				'value' => urldecode($cat),
				'compare' => '='
			);   
			
			if($key == "ListAgentKey")
			{
				$title = "Agent";
			}
			else if($key == "ListOfficeKey")
			{
				$title = "Office";
			}
			else if($key == "CoListAgentKey")
			{
				$title = "Agent";
			}
			else
			{
				$title = urldecode($cat);			
			}
			
			$args = array('meta_query' => $metaquery); 
		}
		else if($action == "rn")
		{
			$key = $wp_query->query_vars['sp_geo'];
			$cat = $wp_query->query_vars['sp_cat'];
			
			$metaquery[] = array(
				'key' => 'geo_' . $key,
				'value' => urldecode($cat),
				'compare' => '='
			);   
			$title = urldecode($cat);
			
			$args = array('meta_query' => $metaquery); 
		}
		else if($action == "sc")
		{
			$args = array('meta_query' => $metaquery); 
		}
		else
		{
			$title = "All Properties";
			$args = array();
		}

	//Add Base Info
	$args["order"] = $orderbydirection;	
	$args["orderby"] = $orderby;	
	if($orderby != 'date')
	{
		$args["meta_key"] = $order_metakey;
	}
	$args["post_type"] = 'sp_property';
	$args["paged"] = $paged;
	$args["showposts"] = $showposts;
	
	apply_filters( 'soldpress_archive_query', $args );
	
	
		if($debug_action == 1)
		{
			 var_dump($args);
		}
		
	//@date('[d/M/Y:H:i:s]');
	// var_dump($args);
	  query_posts($args);
	 //@date('[d/M/Y:H:i:s]');
	//echo $GLOBALS['wp_query']->request; 
?>