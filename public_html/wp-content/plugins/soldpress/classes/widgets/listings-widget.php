<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

//Multiple Listings
class SoldPressListingsWidget extends WP_Widget
{

	function SoldPressListingsWidget()
	 {
		$widget_ops = array('classname' => 'SoldPressListingsWidget', 'description' => 'SoldPress Listings Widget' );
		$this->WP_Widget('SoldPressListingsWidget', 'SoldPress - Listings Widget', $widget_ops);
	 }
		 
	function form($instance)
	{

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'active_tab' => 'gird', 'dfd_key' => '', 'dfd_value' => '','count' => ''  ) );
		$title= esc_attr($instance['title']);		
		$active_tab = isset($instance['active_tab']) ? $instance['active_tab'] : 'gird';
		$dfd_key = isset($instance['dfd_key']) ? $instance['dfd_key'] : '';
		$dfd_value = isset($instance['dfd_value']) ? $instance['dfd_value'] : '';
		$count =  isset($instance['count']) ? $instance['count'] : 6;				
?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'active_tab'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</label>
	</p>
	<!-- filter -->
	<p>
	<label for="<?php echo $this->get_field_id( 'active_tab' ); ?> "><?php _e('Type:', 'active_tab'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'active_tab' ); ?>" name="<?php echo $this->get_field_name( 'active_tab' ); ?>">
			 <option value="grid" <?php selected( $instance['active_tab'], 'grid' ); ?>>Grid</option>
			 <option value="list" <?php selected( $instance['active_tab'], 'list' ); ?>>List</option>
			 <option value="slide" <?php selected( $instance['active_tab'], 'slide' ); ?>>Slide</option>
			 <option value="map" <?php selected( $instance['active_tab'], 'map' ); ?>>Map</option>   
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of Properties', 'soldpress'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
	</p>
	<!-- value -->
	<p>		
		<label for="<?php echo $this->get_field_id('dfd_key'); ?>"><?php _e('Key:', 'soldpress') ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('dfd_key'); ?>" name="<?php echo $this->get_field_name('dfd_key'); ?>" class="btn-block">
					<option value="" <?php selected( '', $this->get_field_id('dfd_key') ); ?>>no filter</option>
					<?php                     
						global $wpdb;
							
						$query = "SELECT DISTINCT meta_key 
						FROM  $wpdb->postmeta pm WHERE pm.meta_key like 'dfd%'";
						
						$results = $wpdb->get_results($query);		
						
						//Can Catch The Results
						
						foreach ($results as $result)
							{
								if ($result->meta_key == '')
									continue;
								
								if ($result->meta_key == $dfd_key)
								{
									echo '<option selected="selected" value="'.htmlentities($result->meta_key).'">'.substr($result->meta_key, 4) .'</option>';
								}
								else
								{
									echo '<option value="'.htmlentities($result->meta_key).'">'.substr($result->meta_key, 4) .'</option> ';   
								}
							}			
					  ?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('dfd_value'); ?>">Value 
		<input class="widefat" id="<?php echo $this->get_field_id('dfd_value'); ?>" name="<?php echo $this->get_field_name('dfd_value'); ?>" type="text" value="<?php echo esc_attr($dfd_value); ?>" />
	</p>
	
<?php
	}
 
	  function update($new_instance, $old_instance)
	  {
	  
		$instance['title'] = $new_instance['title'];
		$instance['active_tab'] = $new_instance['active_tab'];
		$instance['dfd_key'] = $new_instance['dfd_key'];
		$instance['dfd_value'] = $new_instance['dfd_value'];
		$instance['count'] = $new_instance['count'];
		return $instance;
	  }
 
	  function widget($args, $instance)
	  {
		extract($args, EXTR_SKIP);
	 
		$active_tab = isset($instance['active_tab']) ? $instance['active_tab'] : 'grid';
		$dfd_key = isset($instance['dfd_key']) ? $instance['dfd_key'] : '';
		$dfd_value = isset($instance['dfd_value']) ? $instance['dfd_value'] : '';
		$count = isset($instance['count']) ? $instance['count'] : 6;
		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('soldpress_widget_title', $instance['title']);
	 
		if (!empty($title))
		  echo $before_title . $title . $after_title;;
	 
		//Begin
						
		include_once(SOLDPRESS_TEMPLATE_DIR.'/sp_property_section.php');

		
		global $wp_query;
		$shorcode = "sc";
		
		if(!empty($dfd_key))
		{
			if(!empty($dfd_value))
			{	
					$metaquery[] = array(
													'key' => $dfd_key,
													'value' => $dfd_value,
													'compare' => 'LIKE'
									);  
			}
		}	
		
		if(empty($metaquery))
		{
			$shorcode = "";
		}					
		$_GET[ 'showposts' ] = $count;
		
		include(SOLDPRESS_TEMPLATE_DIR . 'archive-filter.php');	
		if ( have_posts() ) 
		{			
			?>
			<div class="sp">
				<div class="properties">		
					<div class="featured-item-wrapper featured-item-list">
			<?php
			 if( $active_tab == 'grid' ) { 			
				soldpress_template_property_archive_grid();
			 }								 
			 if( $active_tab == 'list' ) { 
				soldpress_template_property_archive_list_loop();
			 }
			  if( $active_tab == 'map' ) { 	
				soldpress_template_property_archive_map();
			 }
			 if( $active_tab == 'slide' ) { 
				echo '<div class="row-fluid">';
				soldpress_template_property_archive_slide_loop();
				echo '</div>';
			 }
			?>
					</div>
				</div>
			</div>	
			<?php				 	
		}
		else
		{
			echo apply_filters( 'soldpress_no_listings', 'Sorry, no listings matched your criteria' ) ;
		}
				
		wp_reset_query();
		//End
		echo $after_widget;
	  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoldPressListingsWidget");') );


?>