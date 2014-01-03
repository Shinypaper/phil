<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

class SoldPressSearchWidget extends WP_Widget
{

	function SoldPressSearchWidget()
	 {
		$widget_ops = array('classname' => 'SoldPressSearchWidget', 'description' => 'This widget displays advance search form.' );
		$this->WP_Widget('SoldPressSearchWidget', 'SoldPress - Search Widget', $widget_ops);
	 }
		 
	function form($instance)
	{

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'propertytype' => true, 'city' => true, 'price' => true, 'bedrooms' => true, 'bathroom' => true,'mls' => true,'address' => true, 'waterfront' => true, 'province' => true, 'transaction' => true  ) );
		$title = $instance['title'];		
		$show_propertytype = isset($instance['propertytype']) ? $instance['propertytype'] : true;
		$show_city = isset($instance['city']) ? $instance['city'] : true;
		$show_price = isset($instance['price']) ? $instance['price'] : true;
		$show_bedrooms = isset($instance['bedrooms']) ? $instance['bedrooms'] : true;
		$show_bathroom = isset($instance['bathroom']) ? $instance['bathroom'] : true;
		$show_mls = isset($instance['mls']) ? $instance['mls'] : true;
		$show_address = isset($instance['address']) ? $instance['address'] : true;
		$show_waterfront = isset($instance['waterfront']) ? $instance['waterfront'] : true;
		$show_province = isset($instance['province']) ? $instance['province'] : true;
		$show_transaction = isset($instance['transaction']) ? $instance['transaction'] : true;
				
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
		<label for="<?php echo $this->get_field_id('bathroom'); ?>"><?php _e('Show Bathroom'); ?></label><br />	
		<input class="checkbox" type="checkbox" <?php checked($instance['waterfront'], true) ?> id="<?php echo $this->get_field_id('waterfront'); ?>" name="<?php echo $this->get_field_name('waterfront'); ?>" />
		<label for="<?php echo $this->get_field_id('waterfront'); ?>"><?php _e('Show Waterfront'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['province'], true) ?> id="<?php echo $this->get_field_id('province'); ?>" name="<?php echo $this->get_field_name('province'); ?>" />
		<label for="<?php echo $this->get_field_id('province'); ?>"><?php _e('Show Province'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['transaction'], true) ?> id="<?php echo $this->get_field_id('transaction'); ?>" name="<?php echo $this->get_field_name('transaction'); ?>" />
			<label for="<?php echo $this->get_field_id('transaction'); ?>"><?php _e('Show Status'); ?></label><br />
		</p>
<?php
	}
 
	  function update($new_instance, $old_instance)
	  {
	  
		$new_instance = (array) $new_instance;
		$instance = array( 'propertytype' => 0, 'city' => 0, 'price' => 0, 'bedrooms' => 0, 'bathroom' => 0,'mls' => 0,'address' => 0, 'waterfront' => 0, 'province' => 0 , 'transaction' => 0);
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
		
		global $show_propertytype;
		global $show_city;
		global $show_price;
		global $show_bedrooms;
		global $show_bathroom;
		global $show_price;
		global $show_address;
		global $show_mls;
		global $show_waterfront;
		global $show_province;
		global $show_transaction;
			
		$show_propertytype = isset($instance['propertytype']) ? $instance['propertytype'] : true;
		$show_city = isset($instance['city']) ? $instance['city'] : true;
		$show_price = isset($instance['price']) ? $instance['price'] : true;
		$show_bedrooms = isset($instance['bedrooms']) ? $instance['bedrooms'] : true;
		$show_bathroom = isset($instance['bathroom']) ? $instance['bathroom'] : true;
		$show_address = isset($instance['address']) ? $instance['address'] : true;
		$show_mls = isset($instance['mls']) ? $instance['mls'] : true;
		$show_waterfront = isset($instance['waterfront']) ? $instance['waterfront'] : true;
		$show_province = isset($instance['province']) ? $instance['province'] : true;
		$show_transaction = isset($instance['transaction']) ? $instance['transaction'] : true;
		
		echo apply_filters('soldpress_search_before_widget', $before_widget) ;
		
		$title = empty($instance['title']) ? ' ' : apply_filters('soldpress_widget_title', $instance['title']);
	 
		if (!empty($title))
		{
		  $before_title = apply_filters('soldpress_search_before_title', $before_title);
		  $after_title = apply_filters('soldpress_search_after_title', $after_title);
		 
		  echo $before_title . $title . $after_title;	  
		}
		  
		//Begin
		soldpress_template_search_widget();	
	 	//End
		
		echo apply_filters('soldpress_search_after_widget', $after_widget) ;
	  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoldPressSearchWidget");') );

include(SOLDPRESS_TEMPLATE_DIR.'/sp_property_scripts_sp.php');	


?>