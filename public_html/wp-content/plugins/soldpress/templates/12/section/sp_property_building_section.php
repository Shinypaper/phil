<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
$sp_building_section_meta_xml = array(
			//	"/PropertyDetails/Building/BathroomTotal" => "BathroomTotal",
			//	"/PropertyDetails/Building/BedroomsTotal" => "BedroomsTotal",
				"/PropertyDetails/Building/BedroomsAboveGround" => "Bedrooms Above Ground",
				"/PropertyDetails/Building/BedroomsBelowGround" => "Bedrooms Below Ground",
				"/PropertyDetails/Building/Amenities" => "Amenities",
				"/PropertyDetails/Building/Amperage" => "Amperage",
				"/PropertyDetails/Building/Anchor" => "Anchor",
				"/PropertyDetails/Building/Appliances" => "Appliances",
				"/PropertyDetails/Building/ArchitecturalStyle" => "Architectural Style",
				"/PropertyDetails/Building/BasementDevelopment" => "Basement Development",
				"/PropertyDetails/Building/BasementFeatures" => "Basement Features",
				"/PropertyDetails/Building/BasementType" => "Basement",
				"/PropertyDetails/Building/BomaRating" => "Boma Rating",
				"/PropertyDetails/Building/CeilingHeight" => "Ceiling Height",
				"/PropertyDetails/Building/CeilingType" => "Ceiling",
				"/PropertyDetails/Building/ClearCeilingHeight" => "Clear Ceiling Height",
				"/PropertyDetails/Building/ConstructedDate" => "Constructed Date",
				"/PropertyDetails/Building/ConstructionMaterial" => "Construction Material",
				"/PropertyDetails/Building/ConstructionStatus" => "Construction Status",
				"/PropertyDetails/Building/ConstructionStyleAttachment" => "Construction Style Attachment",
				"/PropertyDetails/Building/ConstructionStyleOther" => "Construction Style Other",
				"/PropertyDetails/Building/ConstructionStyleSplitLevel" => "Construction Style Split Level",
				"/PropertyDetails/Building/CoolingType" => "Cooling",
			//	"/PropertyDetails/Building/DisplayAsYears" => "DisplayAsYears",
				"/PropertyDetails/Building/EnerguideRating" => "Energuide Rating",
				"/PropertyDetails/Building/ExteriorFinish" => "Exterior Finish",
				"/PropertyDetails/Building/FireplaceFuel" => "Fireplace Fuel",
				"/PropertyDetails/Building/FireplacePresent" => "Fireplace Present",
				"/PropertyDetails/Building/FireplaceTotal" => "Fireplace Total",
				"/PropertyDetails/Building/FireplaceType" => "Fireplace Type",
				"/PropertyDetails/Building/FireProtection" => "Fire Protection",
				"/PropertyDetails/Building/Fixture" => "Fixture",
				"/PropertyDetails/Building/FlooringType" => "Flooring",
				"/PropertyDetails/Building/FoundationType" => "Foundation",
				"/PropertyDetails/Building/HalfBathTotal" => "HalfBath",
				"/PropertyDetails/Building/HeatingFuel" => "Heating Fuel",
				"/PropertyDetails/Building/HeatingType" => "Heating",
				"/PropertyDetails/Building/LeedsCategory" => "Leeds Category",
				"/PropertyDetails/Building/LeedsRating" => "Leeds Rating",
				"/PropertyDetails/Building/RoofMaterial" => "Roof Material",
				"/PropertyDetails/Building/RoofStyle" => "Roof",
				"/PropertyDetails/Building/SizeExterior" => "Size Exterior",
				"/PropertyDetails/Building/SizeInterior" => "Size Interior",
				"/PropertyDetails/Building/StoreFront" => "Store Front",
				"/PropertyDetails/Building/StoriesTotal" => "Stories Total",
				"/PropertyDetails/Building/TotalFinishedArea" => "Total Finished Area",
				"/PropertyDetails/Building/Type" => "Type",
				"/PropertyDetails/Building/Uffi" => "Uffi",
				"/PropertyDetails/Building/UtilityPower" => "Utility Power",
				"/PropertyDetails/Building/UtilityWater" => "Utility Water",
				"/PropertyDetails/Building/VacancyRate" => "Vacancy Rate"
				
				);
							
$sp_building_section_meta_reso = array("dfd_BathroomsHalf" => "Bathrooms(Half)",
					"dfd_Flooring" => "Flooring",
					"dfd_Cooling" => "Cooling",
					"dfd_CoolingYN" => "CoolingYN",
					"dfd_Heating" => "Heating",
					"dfd_HeatingFuel" => "Heating Fuel", 
					"dfd_FireplaceFuel" => "Fireplace Fuel",
					"dfd_FireplacesTotal" => "Fireplaces",
					"dfd_Levels" => "Levels",
					"dfd_NumberOfUnitsTotal" => "Number Of Units Total",
					"dfd_PoolYN" => "Pool",					
					"dfd_PoolFeatures" => "Pool Features",
					"dfd_Sewer" => "Sewer",	
					"dfd_Stories" => "Stories");
							
							
function sp_get_building_section($sp_business_section_meta){
	$data = sp_get_reso_data($sp_business_section_meta);
	sp_table_generator('Building',$data);
	
}

function sp_get_building_section_xml($xml,$sp_business_section_meta){
	$data = sp_get_xml_data($xml,$sp_business_section_meta);
	sp_table_generator('Building',$data);
	
}


?>