<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

register_sidebar(array(
  'name' => __( 'SoldPress Before Listing' ),
  'id' => 'soldpress-sidebar',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Site' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => __( 'SoldPress After Listing' ),
  'id' => 'soldpress-sidebar-after',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Details' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

register_sidebar(array(
  'name' => __( 'SoldPress Heading' ),
  'id' => 'soldpress-sidebar-heading',
  'description' => __( 'Widgets in this area will be shown on the SoldPress Listing Details' ),
  'before_widget' => "<div class='widget well3'>",
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));


class SoldPressSearchWidget extends WP_Widget
{

	function SoldPressSearchWidget()
	 {
		$widget_ops = array('classname' => 'SoldPressSearchWidget', 'description' => 'SoldPress Listings Search' );
		$this->WP_Widget('SoldPressSearchWidget', 'SoldPress Listings Search', $widget_ops);
	 }
		 
	function form($instance)
	{

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'propertytype' => true, 'city' => true, 'price' => true, 'bedrooms' => true, 'bathroom' => true,'mls' => '','address' => ''  ) );
		$title = $instance['title'];		
		$show_propertytype = isset($instance['propertytype']) ? $instance['propertytype'] : true;
		$show_city = isset($instance['city']) ? $instance['city'] : true;
		$show_price = isset($instance['price']) ? $instance['price'] : true;
		$show_bedrooms = isset($instance['bedrooms']) ? $instance['bedrooms'] : true;
		$show_bathroom = isset($instance['bathroom']) ? $instance['bathroom'] : true;
		$show_mls = isset($instance['show_mls']) ? $instance['show_mls'] : true;
		$show_address = isset($instance['address']) ? $instance['address'] : true;
				
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['mls'], true) ?> id="<?php echo $this->get_field_id('bathroom'); ?>" name="<?php echo $this->get_field_name('mls'); ?>" />
		<label for="<?php echo $this->get_field_id('mls'); ?>"><?php _e('Show MLS'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['address'], true) ?> id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" />
		<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Show Address'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['propertytype'], true) ?> id="<?php echo $this->get_field_id('propertytype'); ?>" name="<?php echo $this->get_field_name('propertytype'); ?>" />
		<label for="<?php echo $this->get_field_id('propertytype'); ?>"><?php _e('Show Property Type'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['city'], true) ?> id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" />
		<label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('Show City'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['price'], true) ?> id="<?php echo $this->get_field_id('price'); ?>" name="<?php echo $this->get_field_name('price'); ?>" />
		<label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('Show Price'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['bedrooms'], true) ?> id="<?php echo $this->get_field_id('bedrooms'); ?>" name="<?php echo $this->get_field_name('bedrooms'); ?>" />
		<label for="<?php echo $this->get_field_id('bedrooms'); ?>"><?php _e('Show Bedrooms'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['bathroom'], true) ?> id="<?php echo $this->get_field_id('bathroom'); ?>" name="<?php echo $this->get_field_name('bathroom'); ?>" />
		<label for="<?php echo $this->get_field_id('bathroom'); ?>"><?php _e('Show Bathroom'); ?></label>	
	</p>
<?php
	}
 
	  function update($new_instance, $old_instance)
	  {
	  
		$new_instance = (array) $new_instance;
		$instance = array( 'propertytype' => 0, 'city' => 0, 'price' => 0, 'bedrooms' => 0, 'bathroom' => 0,'mls' => '','address' => '' );
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = true;
		}
	
		$instance['title'] = $new_instance['title'];
		
		return $instance;
	  }
 
	  function widget($args, $instance)
	  {
		extract($args, EXTR_SKIP);
	 
		$show_propertytype = isset($instance['propertytype']) ? $instance['propertytype'] : false;
		$show_city = isset($instance['city']) ? $instance['city'] : false;
		$show_price = isset($instance['price']) ? $instance['price'] : false;
		$show_bedrooms = isset($instance['bedrooms']) ? $instance['bedrooms'] : false;
		$show_bathroom = isset($instance['bathroom']) ? $instance['bathroom'] : false;
		$show_address = isset($instance['address']) ? $instance['address'] : false;
		$show_mls = isset($instance['mls']) ? $instance['mls'] : false;
		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	 
		if (!empty($title))
		  echo $before_title . $title . $after_title;;
	 
	 ?>
	 <div class="sp">
		 <form  role="search"  method="get" id="sp_search_w" action = "<?php echo get_post_type_archive_link('sp_property'); ?>" >
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
			<select name="propertytype"  id="propertytype" class="btn-block">
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
			<input name="city"  id="city" class="btn-block" />
			<?php } ?>
			<?php if($show_price) { ?>
		   <label for="minprice">Min. Price</label>
			<select name="minprice" id="minprice" class="btn-block">
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
	 <?php
	 
		echo $after_widget;
	  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoldPressSearchWidget");') );

?>