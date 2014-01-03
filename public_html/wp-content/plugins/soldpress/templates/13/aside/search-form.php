<?php 

	global 	$show_propertytype;
	global 	$show_city;
	global 	$show_price;
	global 	$show_bedrooms ;
	global 	$show_bathroom;
	global 	$show_address;
	global 	$show_mls;
	global 	$show_waterfront;
	global 	$show_province;	
	global 	$show_transaction;	
?>

 <div class="sp">
		 <form role="search" method="get" id="sp_search_w" action = "<?php echo get_post_type_archive_link('sp_property'); ?>" >
			<input type="hidden" name="sp" value="s"/>
			<?php if($show_transaction) { ?>
				<label for="transaction"><?php _e('Status', 'soldpress'); ?></label>
				<select name="transaction" id="transaction" class="input-small btn-block">
				<option value=""><?php _e('Any','soldpress') ?></option> 
				<option value="1"><?php _e('For Sale', 'soldpress');?></option>
				<option value="0"><?php _e('For Rent', 'soldpress');?></option>
				</select>
			<?php } ?>
			<?php if($show_waterfront) { ?>
			<label for="waterfront"><?php _e('Waterfront Property','soldpress') ?></label>
			<select name="waterfront" id="waterfront" class="btn-block">
				<option selected value="True"><?php _e('Yes','soldpress') ?></option>
				<option value="False"><?php _e('No','soldpress') ?></option>
			</select>
			<?php } ?>
			<?php if($show_mls) { ?>
			<label for="mls"><?php _e('MLS®','soldpress') ?></label>
			<input name="mls"  id="mls" class="btn-block" />
			<?php } ?>
			<?php if($show_address) { ?>
			<label for="address"><?php _e('Address','soldpress') ?></label>
			<input name="address"  id="address" class="btn-block" />
			<?php } ?>	
			<?php if($show_propertytype == true) { ?>
			<label for="propertytype"><?php _e('Property Type','soldpress')?></label>
			<select name="propertytype" class="btn-block">
				<option value=""><?php _e('All','soldpress') ?></option> 
				<?php                     
					global $wpdb;
						
					$query = "SELECT DISTINCT meta_value 
					FROM  $wpdb->postmeta pm 
					INNER JOIN  $wpdb->posts p ON p.ID = pm.post_id 
					WHERE pm.meta_key = 'dfd_PropertyType' AND p.post_status = 'publish'";
					
					$results = $wpdb->get_results($query);													
					foreach ($results as $result)
						{
							if ($result->meta_value == '')
								continue;																
							echo '<option value="'.htmlentities($result->meta_value).'">'.$result->meta_value.'</option> ';   
						}			
				  ?>
			</select>
			<?php } ?>
			<?php if($show_city) { ?>
			<label for="city"><?php _e('City','soldpress') ?></label>
			<input name="city" class="btn-block" />
			<?php } ?>
			<?php if($show_province) { ?>
			<label for="province"><?php _e('Province','soldpress') ?></label>
			<select name="province" class="btn-block">
				<option value=""><?php _e('All','soldpress') ?></option> 
				<?php                     
					global $wpdb;
						
					$query = "SELECT DISTINCT meta_value 
					FROM  $wpdb->postmeta pm 
					INNER JOIN  $wpdb->posts p ON p.ID = pm.post_id 
					WHERE pm.meta_key = 'dfd_StateOrProvince' AND p.post_status = 'publish'";
					
					$results = $wpdb->get_results($query);													
					foreach ($results as $result)
						{
							if ($result->meta_value == '')
								continue;																
							echo '<option value="'.htmlentities($result->meta_value).'">'.$result->meta_value.'</option> ';   
						}			
				  ?>
			</select>
			<?php } ?>
			<?php if($show_price) { ?>
		   <label for="minprice"><?php _e('Min. Price','soldpress') ?></label>
			<select name="minprice" class="btn-block">
				<option selected value="0"><?php _e('No Min','soldpress') ?></option>
				<option value="25000">25,000</option>
				<option value="50000">50,000</option>
				<option value="75000">75,000</option>
				<option value="100000">100,000</option>
				<option value="125000">125,000</option>
				<option value="150000">150,000</option>
				<option value="175000">175,000</option>
				<option value="200000">200,000</option>
				<option value="225000">225,000</option>
				<option value="250000">250,000</option>
				<option value="275000">275,000</option>
				<option value="300000">300,000</option>
				<option value="325000">325,000</option>
				<option value="350000">350,000</option>
				<option value="375000">375,000</option>
				<option value="400000">400,000</option>
				<option value="425000">425,000</option>
				<option value="450000">450,000</option>
				<option value="475000">475,000</option>
				<option value="500000">500,000</option>
				<option value="550000">550,000</option>
				<option value="600000">600,000</option>
				<option value="650000">650,000</option>
				<option value="700000">700,000</option>
				<option value="750000">750,000</option>
				<option value="800000">800,000</option>
				<option value="850000">850,000</option>
				<option value="900000">900,000</option>
				<option value="950000">950,000</option>
				<option value="1000000">1,000,000</option>
				<option value="1500000">1,500,000</option>
				<option value="2000000">2,000,000</option>
				<option value="2500000">2,500,000</option>
				<option value="3000000">3,000,000</option>
				<option value="4000000">4,000,000</option>
				<option value="5000000">5,000,000</option>
				<option value="7500000">7,500,000</option>
				<option value="10000000">10,000,000</option>
			</select>
			<label for="maxprice"><?php _e('Max. Price','soldpress') ?></label>
			<select  name="maxprice" id="maxprice" class="btn-block">
				<option selected value="10000000"><?php _e('No Max','soldpress') ?></option>
				<option value="25000">25,000</option>
				<option value="50000">50,000</option>
				<option value="75000">75,000</option>
				<option value="100000">100,000</option>
				<option value="125000">125,000</option>
				<option value="150000">150,000</option>
				<option value="175000">175,000</option>
				<option value="200000">200,000</option>
				<option value="225000">225,000</option>
				<option value="250000">250,000</option>
				<option value="275000">275,000</option>
				<option value="300000">300,000</option>
				<option value="325000">325,000</option>
				<option value="350000">350,000</option>
				<option value="375000">375,000</option>
				<option value="400000">400,000</option>
				<option value="425000">425,000</option>
				<option value="450000">450,000</option>
				<option value="475000">475,000</option>
				<option value="500000">500,000</option>
				<option value="550000">550,000</option>
				<option value="600000">600,000</option>
				<option value="650000">650,000</option>
				<option value="700000">700,000</option>
				<option value="750000">750,000</option>
				<option value="800000">800,000</option>
				<option value="850000">850,000</option>
				<option value="900000">900,000</option>
				<option value="950000">950,000</option>
				<option value="1000000">1,000,000</option>
				<option value="1500000">1,500,000</option>
				<option value="2000000">2,000,000</option>
				<option value="2500000">2,500,000</option>
				<option value="3000000">3,000,000</option>
				<option value="4000000">4,000,000</option>
				<option value="5000000">5,000,000</option>
				<option value="7500000">7,500,000</option>
				<option value="10000000">10,000,000</option>

			</select>
			<?php } ?>
				<?php if($show_bedrooms) { ?>
			<label for="bedrooms"><?php _e('Bedrooms','soldpress') ?></label>
			<select name="bedrooms" id="bedrooms" class="input-small btn-block">
				<option value=""><?php _e('Any','soldpress') ?></option> 
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4+</option>
			</select>
			<?php } ?>
			<?php if($show_bathroom) { ?>
			<label for="bathrooms"><?php _e('Bathroom','soldpress') ?></label>
			<select name="bathrooms" id="bathrooms" class="input-small btn-block">
				<option value=""><?php _e('Any','soldpress') ?></option> 
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4+</option>
			</select>
			<?php } ?>
			<div class="controls">
				<input type="submit" class="btn" value="Search">
			</div>							
			</form>
		</div>