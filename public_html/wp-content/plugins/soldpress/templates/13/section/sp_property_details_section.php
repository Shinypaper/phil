<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
$sp_details_section_meta_xml = array(
				"/PropertyDetails/AmmenitiesNearBy" => "Ammenities Near By",
				"/PropertyDetails/CommunicationType" => "Communication",
				"/PropertyDetails/CommunityFeatures" => "Community Features",
				"/PropertyDetails/Crop" => "Crop",
				"/PropertyDetails/DocumentType" => "Document",
				"/PropertyDetails/Easement" => "Easement",
				"/PropertyDetails/EquipmentType" => "Equipment",
				"/PropertyDetails/Features" => "Features",
				"/PropertyDetails/FarmType" => "FarmType",
				"/PropertyDetails/IrrigationType" => "Irrigation",
				"/PropertyDetails/Lease" => "Lease",
				"/PropertyDetails/LeasePerTime" => "Lease Per Time",
				"/PropertyDetails/LeasePerUnit" => "Lease Per Unit",
				"/PropertyDetails/LeaseTermRemainingFreq" => "Lease Term Remaining",
				"/PropertyDetails/LeaseTermRemaining" => "Lease Term Remaining",
				"/PropertyDetails/LeaseType" => "Lease",
				"/PropertyDetails/LiveStockType" => "Live Stock ",
				"/PropertyDetails/LoadingType" => "Loading",
				"/PropertyDetails/Machinery" => "Machinery",
				"/PropertyDetails/MaintenanceFee" => "Maintenance Fee",
				"/PropertyDetails/MaintenanceFeePaymentUnit" => "Maintenance Fee Payment Unit",
				"/PropertyDetails/MaintenanceFeeType" => "Maintenance Fee Type",
				"/PropertyDetails/ManagementCompany" => "Management Company",
		//		"/PropertyDetails/MunicipalId" => "MunicipalId",
				"/PropertyDetails/OwnershipType" => "Ownership",
				"/PropertyDetails/ParkingSpaceTotal" => "Parking Spaces",
				"/PropertyDetails/Plan" => "Plan",
				"/PropertyDetails/PoolFeatures" => "Pool Features",
				"/PropertyDetails/PoolType" => "Pool",
		//		"/PropertyDetails/Price" => "Price",
		//		"/PropertyDetails/PricePerUnit" => "PricePerUnit",
		//		"/PropertyDetails/PropertyType" => "PropertyType",
				"/PropertyDetails/RentalEquipmentType" => "Rental Equipment",
				"/PropertyDetails/RightType" => "Right",
				"/PropertyDetails/RoadType" => "Road",
				"/PropertyDetails/SignType" => "Sign",
				"/PropertyDetails/StorageType" => "Storage",
				"/PropertyDetails/Structure" => "Structure",
				"/PropertyDetails/TransactionType" => "Transaction",
				"/PropertyDetails/TotalBuildings" => "Total Buildings",
				"/PropertyDetails/ViewType" => "View",
				"/PropertyDetails/WaterFrontType" => "WaterFront",
				"/PropertyDetails/WaterFrontName" => "Water Body Name",
				"/PropertyDetails/ZoningDescription" => "Zoning Description",
				"/PropertyDetails/ZoningType" => "Zoning"
				);
							
$sp_details_section_meta_reso = array(
					"dfd_GarageYN" => "Garage", 
					"dfd_CarportYN" => "Carport",
					"dfd_CarportSpaces" => "Carport Spaces",
					"dfd_CoveredSpaces" => "Coverd Spaces",
					"dfd_AttachedGarageYN" => "Attached Garage",
					"dfd_OpenParkingYN" => "Open Parking",
					"dfd_OpenParkingSpaces" => "Open Parking Spaces",
					"dfd_ParkingTotal" => "Parking Total",
					"dfd_GarageYN" => "Garage",
					"dfd_LotFeatures" => "Features",
					"dfd_WaterfrontYN" => "Waterfront",				
					"dfd_ArchitecturalStyle" => "Architectural Style",
					"dfd_CommunityFeatures" => "Community Features",
					"dfd_ConstructionMaterials" => "Construction Materials",
					"dfd_Fencing" => "Fencing",
					"dfd_FrontageLength" => "Frontage Length",
					"dfd_FrontageType" => "Frontage Type",
					"dfd_GreenBuildingCertification" => "Green Building Certification",
					"dfd_GreenCertificationRating" => "Green Certification Rating",
					"dfd_Roof" => "Roof",
					"dfd_View" => "View",
					"dfd_ViewYN" => "View",
					"dfd_WaterBodyName" => "Water Body Name",
					"dfd_WaterfrontYN" => "Waterfront",
					"dfd_Zoning" => "Zoning");
							
							
function sp_get_details_section(){

	global $sp_details_section_meta_reso;
	$data = sp_get_reso_data($sp_details_section_meta_reso);
	sp_table_generator('Details',$data);
	
}

function sp_get_details_section_list(){

	global $sp_details_section_meta_reso;
	$data = sp_get_reso_data($sp_details_section_meta_reso);
	sp_list_generator('Details',$data);
	
}

function sp_get_details_section_xml(){
	global $sp_property_xml;
	global $sp_details_section_meta_xml;
	
	$data = sp_get_xml_data($sp_property_xml,$sp_details_section_meta_xml);
	sp_table_generator('Details',$data);
}

function sp_get_details_section_list_xml(){
	global $sp_property_xml;
	global $sp_details_section_meta_xml;
	
	$data = sp_get_xml_data($sp_property_xml,$sp_details_section_meta_xml);
	sp_list_generator('Details',$data);
}

function sp_get_details_list()
{
	global $sp_property_xml;

	if(isset($sp_property_xml))
	{
		sp_get_details_section_list_xml(); 
	}
	else
	{
		sp_get_details_section_list();				
	}
}

function sp_get_details()
{
	global $sp_property_xml;

	if(isset($sp_property_xml))
	{
		sp_get_details_section_xml(); 
	}
	else
	{
		sp_get_details_section();				
	}
}

?>