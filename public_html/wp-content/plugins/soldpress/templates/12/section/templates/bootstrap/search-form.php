 <div class="sp">
		 <form method="get" id="sp_search_w" action = "<?php echo get_post_type_archive_link('sp_property'); ?>" >
			<input type="hidden" name="sp" value="s" />
						<?php if($show_mls) { ?>
			<label for="mls">MLS®</label>
			<input name="mls"  id="mls" class="btn-block" />
			<?php } ?>
			<?php if($show_address) { ?>
			<label for="address">Address</label>
			<input name="address"  id="address" class="btn-block" />
			<?php } ?>	
			<?php if($show_propertytype == true) { ?>
			<label for="propertytype">Property Type</label>
			<select name="propertytype" class="btn-block">
				<option value="">All</option> 
				<?php                     
					global $wpdb;
					$query = "SELECT DISTINCT meta_value FROM wp_postmeta INNER JOIN  wp_posts ON wp_posts.ID = wp_postmeta.post_id WHERE meta_key = 'dfd_PropertyType' AND post_status = 'publish'";
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
			<label for="city">City</label>
			<input name="city" class="btn-block" />
			<?php } ?>
			<?php if($show_price) { ?>
		   <label for="minprice">Min. Price</label>
			<select name="minprice" class="btn-block">
				<option selected value="0">No Min</option>
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
			<label for="maxprice">Max. Price</label>
			<select  name="maxprice" id="maxprice" class="btn-block">
				<option selected value="10000000">No Max</option>
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
			<label for="bedrooms">Bedrooms</label>
			<select name="bedrooms" id="bedrooms" class="input-small btn-block">
				<option value="">Any</option> 
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4+</option>
			</select>
			<?php } ?>
			<?php if($show_bathroom) { ?>
			<label for="bathrooms">Bathroom</label>
			<select name="bathrooms" id="bathrooms" class="input-small btn-block">
				<option value="">Any</option> 
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