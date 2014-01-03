<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
$sp_business_section_meta_xml = array(
				"/PropertyDetails/Business/FakeBusinessType" => "BusinessType",
				"/PropertyDetails/Business/BusinessType" => "Business Type",
				"/PropertyDetails/Business/BusinessSubType" => "Business Type",
				"/PropertyDetails/Business/EstablishedDate" => "Established Date",
				"/PropertyDetails/Business/Franchise" => "Franchise",
				"/PropertyDetails/Business/OperatingSince" => "Operating Since"
				);
							

function sp_get_bussines_section(){

	global $sp_property_xml;
	global $sp_business_section_meta_xml;
	
	$data = sp_get_xml_data($sp_property_xml,$sp_business_section_meta_xml);
	
	//Apply Filter
	
	sp_table_generator("Business",$data);
}


?>