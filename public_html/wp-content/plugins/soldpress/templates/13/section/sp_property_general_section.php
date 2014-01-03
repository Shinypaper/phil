<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
global $sp_general_section_meta_xml;
global $sp_general_section_meta_reso;

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
													
function sp_get_general_section(){

	global $sp_general_section_meta_reso;	
	$data = sp_get_reso_data($sp_general_section_meta_reso);
	
	global $post;
	
	$schemaorg_enabled = get_option( 'sc-layout-scheme-org',0);
	
	if($schemaorg_enabled == 1)
	{
		
		echo '<div itemprop="offers" itemscope itemtype="http://schema.org/offer"">';
		echo '<meta itemprop="price" content="'.sp_get_property_price().'"></meta>';
		echo '<meta itemprop="priceCurrency" content="CAD" />';
			echo '<div itemprop="itemOffered" itemscope itemtype="http://schema.org/Residence"">';
			echo '<meta itemprop="productID" content="'.get_post_meta($post->ID,'dfd_ListingId',true).'"></meta>';
				echo '<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">';
				echo '<meta itemprop="streetAddress" content="'.get_post_meta($post->ID,'dfd_UnparsedAddress',true).'"></meta>';
				echo '<meta itemprop="addressLocality" content="'.get_post_meta($post->ID,'dfd_City',true).'"></meta>';
				echo '<meta itemprop="addressRegion" content="'.get_post_meta($post->ID,'dfd_StateOrProvince',true).'"></meta>';
				echo '<meta itemprop="postalCode" content="'.get_post_meta($post->ID,'dfd_PostalCode',true).'"></meta>';

				echo '</div>';
			echo '</div>';
		echo '</div>';
	
	}
	
	$caption = get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true);
		
		
	sp_table_generator($caption,$data);	
}
?>