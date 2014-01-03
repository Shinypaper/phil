<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
 
$sp_business_section_meta_xml = array(
				"/PropertyDetails/Business/FakeBusinessType" => "BusinessType",
				"/PropertyDetails/Business/BusinessType" => "Business Type",
				"/PropertyDetails/Business/BusinessSubType" => "Business Type",
				"/PropertyDetails/Business/EstablishedDate" => "Established Date",
				"/PropertyDetails/Business/Franchise" => "Franchise",
				"/PropertyDetails/Business/OperatingSince" => "Operating Since"
				);
							

function sp_get_bussines_section($xml,$sp_business_section_meta){
	$data = sp_get_xml_data($xml,$sp_business_section_meta);
	sp_table_generator("Business",$data);
}


?>