<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
  global $sp_property_xml;
  
 //Load General Section
 sp_get_general_section();	

 ?>									
<div class="well3">
	<table class="table">
		 <caption><?php _e('Description','soldpress'); ?></caption>
		 <tbody>
				<tr>
					<td>
						<p class="muted" <?php echo sp_microdata("description","","")?>>
							<?php echo get_post_meta($post->ID,'dfd_PublicRemarks',true); ?>
						</p>
						<br/>
						<?php 
							
							if(isset($sp_property_xml))
							{
								$video_link = sp_get_xml_single($sp_property_xml,"/PropertyDetails/AlternateURL/VideoLink"); 
								if($video_link != "")
								{	
									echo '<p>';			
									echo 'Please visit : <a href="'. $video_link .'">'. $video_link .'</a> for more photos and information' ;
									echo '</p>';								 
								}
							}
						?>
							
					</td>
				</tr>
			</tbody>
	</table>					
</div>									
<?php 			
	if(isset($sp_property_xml))
	{
		sp_get_bussines_section();				
	}
?>
							
<?php 

	if(isset($sp_property_xml))
	{
		sp_get_details_section_xml(); 
	}
	else
	{
		sp_get_details_section();				
	}

?> 					

<?php 

	if(isset($sp_property_xml))
	{
		sp_get_building_section_xml();
	}
	else
	{
		sp_get_building_section(); 					
	}				
?> 

<?php 			
	if(isset($sp_property_xml))
	{
		sp_get_land_section_xml(); 				
	}
?>

<?php 			
	if(isset($sp_property_xml))
	{
		sp_get_rooms_section_xml() ; 				
	}
	else
	{
		sp_get_rooms_section();
	}
?>
								
<?php sp_get_map_section(); ?>

<?php dynamic_sidebar('soldpress-main-after-listing'); ?>	