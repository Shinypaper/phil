<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
 
$sp_general_section_meta_xml = array(
				"/PropertyDetails/Building/BathroomTotal" => "BathroomTotal",
				"/PropertyDetails/Building/BedroomsTotal" => "BedroomsTotal",
				"/PropertyDetails/PropertyType" => "PropertyType",
				"/PropertyDetails/Building/DisplayAsYears" => "Years",	
				"/PropertyDetails/Building/ConstructedDate" => "Constructed Date",
				"/PropertyDetails/Building/TotalFinishedArea" => "Total Finished Area",
				);
							
$sp_general_section_meta_reso = array("dfd_BathroomsTotal" => "Bathrooms",
				"dfd_BedroomsTotal" => "Bedrooms",
				"dfd_PropertyType" => "Property Type",
				"dfd_YearBuilt" => "Built in",
				"dfd_LotSizeArea" => "LotSize",
				"dfd_BuildingAreaTotal" => "Building Area"
				);
													
function sp_get_general_section($sp_business_section_meta){

	$data = sp_get_reso_data($sp_business_section_meta);
	
	global $post;
	
	$caption = get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true);
	
	sp_table_generator($caption,$data);
}


?>