<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

//Single Listings
class SoldPressGeoWidget extends WP_Widget
{

	function SoldPressGeoWidget()
	 {
		$widget_ops = array('classname' => 'SoldPressGeoWidget', 'description' => 'SoldPress Geo Type Widget' );
		$this->WP_Widget('SoldPressGeoWidget', 'SoldPress Geo Type Widget', $widget_ops);
	 }
		 
	function form($instance)
	{

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'listingkey' => 'city') );
		$title = $instance['title'];		
		$listingkey = isset($instance['listingkey']) ? $instance['listingkey'] : 'city';				
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	
	<p><label for="<?php echo $this->get_field_id('listingkey'); ?>">Key: <input class="widefat" id="<?php echo $this->get_field_id('listingkey'); ?>" name="<?php echo $this->get_field_name('listingkey'); ?>" type="text" value="<?php echo esc_attr($listingkey); ?>" /></label></p>
	
<?php
	}
 
	  function update($new_instance, $old_instance)
	  {
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['listingkey'] = strip_tags($new_instance['listingkey']);
		
		return $instance;
	  }
	  
	  function widget($args, $instance)
	  {
		extract($args, EXTR_SKIP);
		$listingkey = isset($instance['listingkey']) ? $instance['listingkey'] : 'city';

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('soldpress_widget_title', $instance['title']);
	 
		if (!empty($title))
		  echo $before_title . $title . $after_title;;
	 
		//Begin
	 
		
		?>
        <ul id="sp_geo">
            <?php
			global $wpdb;
			$widget_query = "SELECT DISTINCT meta_value FROM $wpdb->postmeta INNER JOIN  $wpdb->posts ON wp_posts.ID = wp_postmeta.post_id WHERE meta_key = 'geo_".$listingkey."' AND post_status = 'publish'";
					$widget_query_results = $wpdb->get_results($widget_query);													
					foreach ($widget_query_results as $result)
						{
							if ($result->meta_value == '')
								continue;																
							echo '<li><a href="'.get_post_type_archive_link('sp_property').'/'. urlencode($listingkey) .'/'. urlencode($result->meta_value). '">' . $result->meta_value . '</a></li>';		
						}			
            ?>
        </ul>
        <?php
		
		//End
		echo $after_widget;
	  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoldPressGeoWidget");') );

?>