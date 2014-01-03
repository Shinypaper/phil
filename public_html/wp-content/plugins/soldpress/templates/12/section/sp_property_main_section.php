<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
 
 sp_get_general_section($sp_general_section_meta_reso);	?>									
<div class="well3">
	<table class="table">
		 <caption>Description</caption>
		 <tbody>
				<tr>
					<td>
						<p class="muted">
							<?php echo get_post_meta($post->ID,'dfd_PublicRemarks',true); ?>
						</p>							
					</td>
				</tr>
			</tbody>
	</table>					
</div>									
<?php 			
	if(isset($xml))
	{
		sp_get_bussines_section($xml,$sp_business_section_meta_xml);				
	}
?>
							
<?php 

	if(isset($xml))
	{
		sp_get_details_section_xml($xml,$sp_details_section_meta_xml); 
	}
	else
	{
		sp_get_details_section($sp_details_section_meta_reso);				
	}

?> 					

<?php 

	if(isset($xml))
	{
		sp_get_building_section_xml($xml,$sp_building_section_meta_xml);
	}
	else
	{
		sp_get_building_section($sp_building_section_meta_reso); 					
	}				
?> 

<?php 			
	if(isset($xml))
	{
		sp_get_land_section_xml($xml,$sp_land_section_meta_xml); 				
	}
?>

<?php 			
	if(isset($xml))
	{
		sp_get_rooms_section_xml($xml) ; 				
	}
	else
	{
		sp_get_rooms_section();
	}
?>
								
<?php sp_get_map_section(); ?>	