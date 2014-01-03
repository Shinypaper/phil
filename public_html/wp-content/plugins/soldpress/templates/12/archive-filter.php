<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.0.0
 */ 
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$Action = isset( $_GET[ 'sp' ] ) ? $_GET[ 'sp' ] : '';
		$showposts = isset( $_GET[ 'showposts' ] ) ? $_GET[ 'showposts' ] : '12';
	   
		$metaquery;
		$title = "";
		if($Action == "s"){
				$title = "Search";
				$MLS = isset( $_GET[ 'mls' ] ) ? $_GET[ 'mls' ] : '';
				$Address = isset( $_GET[ 'address' ] ) ? $_GET[ 'address' ] : '';
				$PropertyType = isset( $_GET[ 'propertytype' ] ) ? $_GET[ 'propertytype' ] : '';
				$MaxPrice = isset( $_GET[ 'maxprice' ] ) ? $_GET[ 'maxprice' ] : '';
				$MinPrice = isset( $_GET[ 'minprice' ] ) ? $_GET[ 'minprice' ] : '';
				$Bedrooms = isset( $_GET[ 'bedrooms' ] ) ? $_GET[ 'bedrooms' ] : '';
				$Bathrooms = isset( $_GET[ 'bathrooms' ] ) ? $_GET[ 'bathrooms' ] : '';
				$City = isset( $_GET[ 'city' ] ) ? $_GET[ 'city' ] : '';
			   
			   
				if($MLS != ''){
								$metaquery[] = array(
																'key' => 'dfd_ListingId',
																'value' => $MLS,
																'compare' => 'LIKE'
												);                            
								$title = $title . ' (MLS® : ' . $MLS .')';                                    
				}
				
				if($Address != ''){
								$metaquery[] = array(
																'key' => 'dfd_UnparsedAddress',
																'value' => $PropertyType,
																'compare' => 'LIKE'
												);                            
								$title = $title . ' (Address : ' . $Address .')';                                    
				}
			   
				if($PropertyType != ''){
								$metaquery[] = array(
																'key' => 'dfd_PropertyType',
																'value' => $PropertyType,
																'compare' => 'LIKE'
												);                            
								$title = $title . ' (Property Type : ' . $PropertyType .')';                                    
				}
			   
			   
				if($MaxPrice != ''){
								if($MinPrice != ''){
												$metaquery[] = array(
																'key' => 'dfd_ListPrice',
																'value' => array( $MinPrice, $MaxPrice),
																'type' => 'numeric',
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
																				'compare' => '>='
																);            
															   
																$title = $title . ' (Bedrooms : ' . $Bedrooms .')';                   
								}
								else{
												$metaquery[] = array(
																				'key' => 'dfd_BedroomsTotal',
																				'value' => $Bedrooms ,
																				'compare' => 'LIKE'
																);
												$title = $title . ' (Bedrooms : 4+)';
															   
								}
				}

				if($Bathrooms  != ''){

								if($Bathrooms >= 4){
							   
												$metaquery[] = array(
																				'key' => 'dfd_BathroomsTotal',
																				'value' => $Bathrooms ,
																				'compare' => '>='
																);
															   
												$title = $title . ' (Bathrooms : ' . $Bathrooms .')'; 
								}else{

												$metaquery[] = array(
																'key' => 'dfd_BathroomsTotal',
																'value' => $Bathrooms,
																'compare' => 'LIKE'
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
					   
						$args = array(
		   'post_type' => 'sp_property',
		   'orderby' => 'date',
		   'order' => 'desc',
		   'paged'=>$paged,
		   'showposts' => $showposts,
		   'meta_query' => $metaquery
						);
		}
		else if($Action == "f" || $Action == "fo")
		{
			//Create Dynamic Filter
			$title = isset( $_GET[ 'title' ] ) ? $_GET[ 'title' ] : 'Listings';
			if($Action == "fo"){
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
		             
		
			$args = array(
			   'post_type' => 'sp_property',
			   'orderby' => 'date',
			   'order' => 'desc',
			   'paged'=>$paged,
			   'showposts' => $showposts,
			   'meta_query' => $metaquery
							);            
	}
	else
	{
		$title = "All Properties";
		$args = array(
		   'post_type' => 'sp_property',
		   'orderby' => 'date',
		   'order' => 'desc',
		   'paged'=>$paged,
		   'showposts' => $showposts,
						);
	}

	//@date('[d/M/Y:H:i:s]');
	 // var_dump($args);
	  query_posts($args);
	 //@date('[d/M/Y:H:i:s]');
	//echo $GLOBALS['wp_query']->request; 
?>