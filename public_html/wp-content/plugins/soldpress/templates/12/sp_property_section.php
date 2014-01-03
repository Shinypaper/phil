<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
			
function sp_get_xml_single($xml,$experssion)
{
	$result = $xml->xpath($experssion);	
	foreach ((array)$result as $title) { 
		return	$title;				
	}
}

function sp_get_xml_data($xml,$sp_business_meta){

	$rooms = array();										
	foreach ($sp_business_meta as $i => $value) {		
		$v = sp_get_xml_single($xml,$i);
		
		if(get_option('sc-layout-false',false)){ 
			if($v == "False"){
				continue;
			}
			
			if($v == "false"){
				continue;
			}
		}	
		
		//Franshise True Return Data - Franchise appears in all property types
		if($i = "/PropertyDetails/Business/Franchise"){
			if($v == "False"){
				continue;
			}
			
			if($v == "false"){
				continue;
			}
		}
		
		if($v != ''){
			$room = array(
				'Value' =>  $v,
				'Name' => $value);
				$rooms[] = $room;
		}
	}
	return 	$rooms;
}

function sp_get_reso_data($sp_business_meta){
	global $post;
	$rooms = array();										
	foreach ($sp_business_meta as $i => $value) {		
		$v = get_post_meta($post->ID,$i,true);
		$v = trim($v,",");
		
		if(get_option('sc-layout-false',false)){ 
			if($v == "False"){
				continue;
			}
		}	
		
		if($v!= "0"){							
			if($v != ''){
				
				//
				//Data Formating Rules : //TODO: Make This Into Wordpress Hook
				//
				
				if($i == 'dfd_LotSizeArea'){
					$v =  $v . ' ' .get_post_meta($post->ID,'dfd_LotSizeUnits',true); 
				}
					
				if($i == 'dfd_BuildingAreaTotal'){
					$v =  $v . ' ' .get_post_meta($post->ID,'dfd_BuildingAreaUnits',true); 
				}
				
				
				$room = array(
					'Value' =>  $v,
					'Name' => $value);
					$rooms[] = $room;
			}
		}
	}
	
	return 	$rooms;
}


function sp_table_generator($caption,$rooms){

	$max_per_row = 2;
	$item_count = 0;
	if($rooms)
	{
		echo '<div class="well3"><table class="table sp_listingdetails"><caption>' .$caption .'</caption><tbody>';						
		foreach($rooms  as &$room){	
			if ($item_count == 0)
			{
				//Start New Row
				echo '<tr>'. PHP_EOL;	;
			}
			if ($item_count == $max_per_row)
			{
				echo '<tr>'. PHP_EOL;	;
				$item_count = 0;
			}
			$name = _($room['Name']);
			echo '<td><span class="sp_key">' .$name.'</span><span>' .$room['Value'] .'</span></td>'. PHP_EOL;	;					
			$item_count++;	
			if ($item_count == $max_per_row)
			{
				echo '</tr>'. PHP_EOL;	;					
			}
		}	
		//Fix Bottom TD
		if ($item_count != $max_per_row )
			{
				if ($item_count != 0)
				{	
					echo '<td></td>'. PHP_EOL;	;
				}
		}
		
		echo '</tbody></table></div>';	
	}	
}
	
include_once(dirname(__FILE__).'/section/sp_property_general_section.php');
include_once(dirname(__FILE__).'/section/sp_property_land_section.php');		
include_once(dirname(__FILE__).'/section/sp_property_business_section.php');
include_once(dirname(__FILE__).'/section/sp_property_details_section.php');
include_once(dirname(__FILE__).'/section/sp_property_building_section.php');
include_once(dirname(__FILE__).'/section/sp_property_rooms_section.php');
include_once(dirname(__FILE__).'/section/sp_property_map_section.php');
?>