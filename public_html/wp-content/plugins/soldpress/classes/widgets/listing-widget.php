<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

//Single Listings
class SoldPressListingWidget extends WP_Widget
{

	function SoldPressListingWidget()
	 {
		$widget_ops = array('classname' => 'SoldPressListingWidget', 'description' => 'Displays Random,Recent or Specific Featured Listing' );
		$this->WP_Widget('SoldPressListingWidget', 'SoldPress - Listing Widget', $widget_ops);
	 }
		 
	function form($instance)
	{

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'listingtype' => 'gird', 'listingkey' => '','sort_by' =>'random') );
		$title = $instance['title'];		
		$listingtype = isset($instance['listingtype']) ? $instance['listingtype'] : 'gird';
		$listingkey = isset($instance['listingkey']) ? $instance['listingkey'] : '';
		$sort_by = isset($instance['sort_by']) ? $instance['sort_by'] : 'random';		
?>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'soldpress'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	
	<label for="<?php echo $this->get_field_id( 'listingtype' ); ?> "><?php _e('Layout:', 'soldpress'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'listingtype' ); ?>" name="<?php echo $this->get_field_name( 'listingtype' ); ?>">
			 <!--<option value="full" <?php selected( $instance['listingtype'], 'full' ); ?>>Full</option>-->
			  <option value="profile" <?php selected( $instance['listingtype'], 'profile' ); ?>><?php _e('Featured', 'soldpress') ?></option>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort By:', 'soldpress') ?></label>
		<select name="<?php echo $this->get_field_name('sort_by'); ?>" id="<?php echo $this->get_field_id('sort_by'); ?>" class="widefat">
				<option value="key"<?php selected( $sort_by, 'key' ); ?>><?php _e('Listing Key', 'soldpress'); ?></option>
				<option value="recent"<?php selected( $sort_by, 'recent' ); ?>><?php _e('Most Recent', 'soldpress'); ?></option>
				<option value="random"<?php selected( $sort_by, 'random' ); ?>><?php _e('Random', 'soldpress'); ?></option>
				
		</select>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id('listingkey'); ?>"><?php _e('Listing Key:', 'soldpress') ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('listingkey'); ?>" name="<?php echo $this->get_field_name('listingkey'); ?>" type="text" value="<?php echo esc_attr($listingkey); ?>" /></p>
	
<?php
	}
 
	  function update($new_instance, $old_instance)
	  {
		$instance['title'] = $new_instance['title'];
		$instance['listingtype'] = $new_instance['listingtype'];
		$instance['listingkey'] = $new_instance['listingkey'];
		$instance['sort_by'] =  $new_instance['sort_by'];	
		return $instance;
	  }
 
	  function widget($args, $instance)
	  {
		global $wp_query;
		global $wpdb;
	    global $id;
		
		extract($args, EXTR_SKIP);
	 //Using only listing key
		$listingtype = isset($instance['listingtype']) ? $instance['listingtype'] : 'full';
		$listingkey = isset($instance['listingkey']) ? $instance['listingkey'] : '';
		$sort_by = isset($instance['sort_by']) ? $instance['sort_by'] : 'random';	
			
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('soldpress_widget_title', $instance['title']);
	 
		if (!empty($title))
		  echo $before_title . $title . $after_title;;
		
		$_id = "";
		
		//Begin
		if($sort_by == "key")
		{
			if($listingkey != '')
			{
				
				$selectQuery = $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value like %s", 'dfd_ListingKey', $listingkey);
				$p = $wpdb->get_row($selectQuery);
				if($p){
					$_id = $p->post_id;
				}
			}
		}
		else
		{
			if(empty($_id))
			{		
					if($sort_by == "recent"):
						$selectQuery = $wpdb->prepare("SELECT ID,post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='sp_property' ORDER BY post_date LIMIT %d", 1);			
					else: //Random						
						$selectQuery = $wpdb->prepare("SELECT ID,post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='sp_property' ORDER BY RAND() LIMIT %d", 1);
					endif;	
		
				$p = $wpdb->get_row($selectQuery); //Get First
				if($p){
					$_id = $p->ID;
				}	
			}					 
		}
				
		if ( isset( $_id ) ) 
		{
			if($_id  != '')
			{
				$post = get_post($id);	
				
				if($post)
				{		
					if($listingtype == 'full')
					{	
						echo 'Full Not Stupported';
						//sp_load_xml();
						//include_once(SOLDPRESS_TEMPLATE_DIR . 'sp_property_section.php');							
						//soldpress_template_property_single_content_main_shortcode();	
					}
					else
					{		
						echo '<!-- '. $_id . '-->';
						$id = $_id;
						soldpress_template_feature_property_shortcode();					
					}			
					
				}
				else
				{
					echo apply_filters( 'soldpress_no_listings', 'Sorry, no listings matched your criteria' ) ;
				}
					
				wp_reset_query();
			}			
		}
		//End
		echo $after_widget;
	  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoldPressListingWidget");') );

?>