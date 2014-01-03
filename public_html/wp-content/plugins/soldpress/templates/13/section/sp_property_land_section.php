<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $sp_land_section_meta_xml;

$sp_land_section_meta_xml = array(
				"/PropertyDetails/Land/SizeTotal" => "Size Total",
				"/PropertyDetails/Land/SizeFrontage" => "Size Frontage",
				"/PropertyDetails/Land/AccessType" => "Access Type",
				"/PropertyDetails/Land/Acreage" => "Acreage",
				"/PropertyDetails/Land/Amenities" => "Amenities",
				"/PropertyDetails/Land/ClearedTotal" => "Cleared Total",
				"/PropertyDetails/Land/CurrentUse" => "Current Use",
				"/PropertyDetails/Land/Divisible" => "Divisible",
				"/PropertyDetails/Land/FenceTotal" => "Fence Total",
				"/PropertyDetails/Land/FenceType" => "Fence",
				"/PropertyDetails/Land/FrontsOn" => "FrontsOn",
				"/PropertyDetails/Land/LandDisposition" => "Land Disposition",
				"/PropertyDetails/Land/LandscapeFeatures" => "Landscape Features",
				"/PropertyDetails/Land/PastureTotal" => "Pasture Total",
				"/PropertyDetails/Land/Sewer" => "Sewer",
				"/PropertyDetails/Land/SizeDepth" => "Size Depth",
				"/PropertyDetails/Land/SoilEvaluation" => "Soil Evaluation",
				"/PropertyDetails/Land/SoilType" => "Soil",
				"/PropertyDetails/Land/SurfaceWater" => "SurfaceWater",
				"/PropertyDetails/Land/TiledTotal" => "TiledTotal"
				);
													
function sp_get_land_section_xml(){

	global $sp_property_xml;
	global $sp_land_section_meta_xml;
	
	$data = sp_get_xml_data($sp_property_xml,$sp_land_section_meta_xml);
	sp_table_generator('Land',$data);
	
}

function sp_get_land(){
	global $sp_property_xml;
	if(isset($sp_property_xml))
	{
		sp_get_land_section_xml(); 				
	}
	
}

?>