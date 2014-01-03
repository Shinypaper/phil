<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
			
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
		
		if($v == 'True'){
			$v =  'Yes'; 
		}
		
		if($v == 'False'){
			$v =  'No'; 
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
			if(!empty($v)){
				
				//
				//Data Formatting Rules : //TODO: Make This Into Word press Hook
				//
				
				$mesurment = get_option("sc-layout-metric");
				
				if($i == 'dfd_LotSizeArea'){
					if($mesurment == 'imperial')
					{
						$v =  sp_squaremeter_to_squarefeet($v) . ' Square Feet' ;
					}
					else
					{
						$v =  $v . ' ' .get_post_meta($post->ID,'dfd_LotSizeUnits',true); 
					}
				}
					
				if($i == 'dfd_BuildingAreaTotal'){
				
					if($mesurment == 'imperial')
					{
						$v =  sp_squaremeter_to_squarefeet($v) . ' Square Feet' ;
					}
					else
					{
						$v =  $v . ' ' .get_post_meta($post->ID,'dfd_BuildingAreaUnits',true); 
					}	
				}
			
				
				if($v == 'True'){
					$v =  'Yes'; 
				}
				
				if($v == 'False'){
					$v =  'No'; 
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

function sp_list_generator($caption,$rooms){
	//Work in Progress
	if($rooms)
	{
		$list_start = '<ul>';
		echo apply_filters('soldpress_list_template_start', $list_start, $caption)	;

		foreach($rooms  as &$room)
		{			
			$name = _($room['Name']);	
			$value =  $room['Value'];
			$li = '<li><span class="sp_key">' .$name.'</span><span>' .$value .'</span></li>'. PHP_EOL;
			echo apply_filters('soldpress_list_template_li',$li,$name,$value,$caption);				
		}			
		
		$list_end = '</ul>';	
		echo apply_filters('soldpress_list_template_end', $list_end)	;
	}	
}


function sp_table_generator($caption,$rooms){

	$max_per_row = 2;
	$item_count = 0;
	if($rooms)
	{
		$table_start = '<div class="well3"><table class="table sp_listingdetails"><caption>' .$caption .'</caption><tbody>';
		echo apply_filters('soldpress_table_template_start', $table_start, $caption)	;

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
			echo '<td><span class="sp_key">' .$name.'</span><span>' .$room['Value'] .'</span></td>'. PHP_EOL;					
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
		
		$table_end = '</tbody></table></div>';
		echo apply_filters('soldpress_table_template_end', $table_end)	;
	}	
}
	
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_general_section.php');
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_land_section.php');		
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_business_section.php');
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_details_section.php');
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_building_section.php');
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_rooms_section.php');
include_once(SOLDPRESS_TEMPLATE_DIR .'section/sp_property_map_section.php');
?>