<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */


function sp_listing_custom_post_type() {

		$slug = get_option('sc-slug','listing');
		$slug_categories = get_option('sc-slug-category','category');
		
		global $wp_rewrite;
		add_rewrite_rule($slug.'/'.$slug_categories.'/([^/]*)/([^/]*)/?$','index.php?post_type=sp_property&sp=r&sp_dfd=$matches[1]&sp_cat=$matches[2]','top');
		
		add_rewrite_rule($slug.'/'.$slug_categories.'/([^/]*)/([^/]*)/page/?([0-9]{1,})/?$','index.php?post_type=sp_property&sp=r&sp_dfd=$matches[1]&sp_cat=$matches[2]&paged=$matches[3]','top');
		
		/*
		//Special City Slug
		add_rewrite_rule($slug.'/city/([^/]*)/?$','index.php?post_type=sp_property&sp=r&sp_dfd=city&sp_cat=$matches[1]','top');
		
		add_rewrite_rule($slug.'/city/([^/]*)/page/?([0-9]{1,})/?$','index.php?post_type=sp_property&sp=r&sp_dfd=city&sp_cat=$matches[1]&paged=$matches[2]','top');
		*/
		
		
		//Special City Slug
		add_rewrite_rule($slug.'/city/([^/]*)/?$','index.php?post_type=sp_property&sp=rn&sp_geo=locality&sp_cat=$matches[1]','top');
		
		add_rewrite_rule($slug.'/city/([^/]*)/page/?([0-9]{1,})/?$','index.php?post_type=sp_property&sp=rn&sp_geo=locality=city&sp_cat=$matches[1]&paged=$matches[2]','top');
			
		
		//Special Neighbourhood Slug
		add_rewrite_rule($slug.'/neighborhood/([^/]*)/?$','index.php?post_type=sp_property&sp=rn&sp_geo=neighborhood&sp_cat=$matches[1]','top');
		
		add_rewrite_rule($slug.'/neighborhood/([^/]*)/page/?([0-9]{1,})/?$','index.php?post_type=sp_property&sp=rn&sp_geo=neighborhood&sp_cat=$matches[1]&paged=$matches[2]','top');
			
		
		add_rewrite_tag('%sp%','([^&]+)');
		add_rewrite_tag('%sp_dfd%','([^&]+)');
		add_rewrite_tag('%sp_cat%','([^&]+)');
		add_rewrite_tag('%sp_geo%','([^&]+)');
		
		$labels = array(
			'name'                => _x( 'Listings', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Listing', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Listing', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Listing', 'text_domain' ),
			'all_items'           => __( 'All Listings', 'text_domain' ),
			'view_item'           => __( 'View Listing', 'text_domain' ),
			'add_new_item'        => __( 'Add New Listing', 'text_domain' ),
			'add_new'             => __( 'New Listing', 'text_domain' ),
			'edit_item'           => __( 'Edit Listing', 'text_domain' ),
			'update_item'         => __( 'Update Listing', 'text_domain' ),
			'search_items'        => __( 'Search listings', 'text_domain' ),
			'not_found'           => __( 'No listing found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No listing found in Trash', 'text_domain' ),
		);

		$rewrite = array(
			'slug'                => $slug,
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'sp_property', 'text_domain' ),
			'description'         => __( 'Property information pages', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor'/*, 'excerpt'*/, 'author', 'thumbnail', 'custom-fields', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon' 	      => plugins_url( '/images/soldpress-home-admin_red.png' , __FILE__ ), 
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,	
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		//	'taxonomies' => array('category', 'post_tag'),
		);

		register_post_type( 'sp_property', $args );
	//	flush_rewrite_rules( false );
	}
	
	/*add_action( 'init', 'create_city_tax' );

	function create_city_tax() {
		register_taxonomy(
			'city',
			'sp_property',
			array(
				'label' => __( 'City' ),
				'rewrite' => array( 'slug' => 'city' ),
				'hierarchical' => false,
			)
		);
	}
	*/


// Hook into the 'init' action
add_action('init', 'sp_listing_custom_post_type', 0 );
add_action("manage_posts_custom_column", "sp_custom_columns");
add_filter("manage_edit-sp_property_columns", "sp_property_columns");

function sp_property_columns($columns)
{
		$residential = get_option('sc-property-type','residential');
		if($residential == "residential"){
			$columns = array(
				"cb" => "<input type='checkbox' />",
				"title" => "Address",
				"dfd_BedroomsTotal" => "Bedrooms",
				"dfd_BathroomsTotal" => "Bathrooms",
				"dfd_ListPrice" => "Price",
				"dfd_City" => "City",
				"dfd_ListAgentFullName" => "List Agent"
				);			
		}
		else
		{
		
			$columns = array(
				"cb" => "<input type='checkbox' />",
				"title" => "Address",
				"dfd_ListPrice" => "Price",
				"dfd_City" => "City",
				"dfd_ListAgentFullName" => "List Agent"
				);
		}
	return $columns;
}

function sp_custom_columns($column)
{
	global $post;
	$residential = get_option('sc-property-type','residential');
	
	if($residential == "residential")
	{
	
		if ("ID" == $column) echo $post->ID;
		elseif ("title" == $column) echo $post->post_content;
		elseif ("dfd_BathroomsTotal" == $column) echo get_post_meta($post->ID,'dfd_BathroomsTotal',true);
		elseif ("dfd_BedroomsTotal" == $column) echo get_post_meta($post->ID,'dfd_BedroomsTotal',true);
		elseif ("dfd_ListPrice" == $column) echo get_post_meta($post->ID,'dfd_ListPrice',true);
		elseif ("dfd_City" == $column) echo get_post_meta($post->ID,'dfd_City',true);
		elseif ("dfd_ListAgentFullName" == $column) echo get_post_meta($post->ID,'dfd_ListAgentFullName',true);
		
	}
	else
	{
		
		if ("ID" == $column) echo $post->ID;
		elseif ("title" == $column) echo $post->post_content;
		elseif ("dfd_ListPrice" == $column) echo get_post_meta($post->ID,'dfd_ListPrice',true);
		elseif ("dfd_City" == $column) echo get_post_meta($post->ID,'dfd_City',true);
		elseif ("dfd_ListAgentFullName" == $column) echo get_post_meta($post->ID,'dfd_ListAgentFullName',true);	
	}
}

add_action("admin_init", "admin_init");
function admin_init()
{
	add_meta_box( 'listing_meta_key', __( 'Property Key', 'soldpress' ), 'sp_listing_key_meta_box', 'sp_property', 'normal', 'core' );
	
	add_meta_box('geo_listing_meta',  __( 'Geocoding', 'soldpress' ), 'sp_geo_listing_meta_box', 'sp_property', 'side', 'default');
	
	add_meta_box('sp_listing_pictures_metabox',  __( 'Images', 'soldpress' ), 'sp_picture_meta_box', 'sp_property', 'normal', 'default');
  
   //add_meta_box( 'listing_meta_boxes', 'Property Details', 'listing_meta_boxes', 'sp_property', 'normal', 'high' );
}

function sp_listing_key_meta_box() 
{
	global $post;		
	echo'<h2>'.$post->post_excerpt.'</h2>';	
	
	$value = get_post_meta( $post->ID, 'sc_private', true );
	wp_nonce_field( 'soldpress_inner_custom_box', 'soldpress_inner_custom_box_nonce' );
	 
	?>
	<label for="soldpress_private_field">
		<input type="checkbox" name="soldpress_private_field" id="soldpress_private_field" value="1" <?php if ( isset ( $value ) ) checked( $value, '1' ); ?> />
		<?php _e( 'Private Listing', 'soldpress' )?>
	</label>
    <?php
}

function sp_geo_listing_meta_box() 
{
		global $post;			
		$custom_field_keys = get_post_custom_keys();
		
		$lat = get_post_meta($post->ID,'geo_lat',true);
		$lon = get_post_meta($post->ID,'geo_lon',true);
		
		if(!empty($lat))
		{
			if(!empty($lon))
			{
				echo '<img border="0" width="100%" src="//maps.googleapis.com/maps/api/staticmap?center='.$lat.',' . $lon . '&amp;zoom=14&amp;size=300x300&amp;sensor=false&amp;markers=color:green%7Clabel:H%7C'.$lat.',' . $lon. '" alt="">';
			}
		}
		
		echo '<dl>';
		foreach ( $custom_field_keys as $key => $value ) {
			$valuet = trim($value);
			if ( '_' == $valuet{0} )
				continue;		
			if ($value == "sc-sync-geo")
			{
				continue;
			}			
			if (strpos( $value,'geo') !== false) {				
				$meta_box_value = get_post_meta($post->ID, $value, true);	
				if(!empty($meta_box_value))
				{
					echo'<dt>'.$value.'</dt>';
					echo'<dd>'.$meta_box_value.'</dd>';
				}				
			}		
		}
		echo '</dl>';		
}

function sp_picture_meta_box() 
{
		global $post;	
		
		$sp_slideshow = sp_get_property_images();
		
		foreach ($sp_slideshow as &$sp_slideshowimage) 
		{			
			echo '<div class="flexslider sp-no-print"><ul class="thumbnails"><li class="thumbnail"><a href="' . $sp_slideshowimage . '" class="swipebox"><img itemprop="image" class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li></ul></div>';	
			
		} 		
}

function listing_meta_boxes() {
	global $post;			
	$custom_field_keys = get_post_custom_keys();
	foreach ( $custom_field_keys as $key => $value ) 
	{
		$valuet = trim($value);
		if ( '_' == $valuet{0} )
			continue;	

		if ( '_' == $valuet{0} )
			continue;
			
		$meta_box_value = get_post_meta($post->ID, $value, true);	
		if($meta_box_value != '')
		{
			echo'<h2>'.$value.'</h2>';
			echo'<input readonly type="text" name="'.$value.'_value" value="'.$meta_box_value.'" size="55" /><br />';
		}				
	}		
}

// Tax
/*
add_action( 'init', 'sp_taxonomy_categories_register' );

function sp_taxonomy_categories_register() {

	$categories_name	 = apply_filters( 'sp_taxonomy_categories_name', __( 'Categories', 'soldpress' ) );
	$categories_singular = apply_filters( 'sp_taxonomy_categories_singular', __( 'Category', 'soldpress' ) );	
	
	$categories_labels = array(
		'name' 			=> $categories_name,
		'singular_name' => $categories_singular
	);
	
	$categories_args = array(
		'labels' 	   => $categories_labels,
		'hierarchical' => true,
		'rewrite' 	   => array( 
			'slug' 		   => apply_filters( 'sp_rewrite_categories_slug', 'listing-category' ), 
			'with_front'   => false,
			'hierarchical' => true
		)
	);
	
	$categories_args = apply_filters( 'sp_taxonomy_categories_args', $categories_args );
	
	// Register taxonomy
	
	register_taxonomy( 'listing-category', array( 'sp_property' ), $categories_args );

}
*/

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function sp_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['soldpress_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['soldpress_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'soldpress_inner_custom_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['soldpress_private_field'] );

  if($mydata == 1)
  {
	//Remove The Key
	remove_action( 'save_post', 'sp_save_postdata' );
	wp_update_post( array('ID'=>$post_id, 'post_excerpt'=>'') );
	add_action( 'save_post', 'sp_save_postdata');
  }
  else
  {
    //Mark For Deletion ReSync
	remove_action( 'save_post', 'sp_save_postdata');
	$ListingKey = get_post_meta($post_id, 'dfd_ListingKey');
	
	if(empty($ListingKey))
	{
		wp_update_post( array('ID'=>$post_id, 'post_excerpt'=>'no_key') );
	}
	else
	{
		wp_update_post( array('ID'=>$post_id, 'post_excerpt'=>$ListingKey) );
	}	
	
	add_action( 'save_post', 'sp_save_postdata');
  }
  
	//Check If The Base Keys Are There If Not Add
  	sp_add_private_meta( $post_id, 'dfd_ListPrice');
	sp_add_private_meta( $post_id, 'dfd_BathroomsTotal');
	sp_add_private_meta( $post_id, 'dfd_BedroomsTotal');
	sp_add_private_meta( $post_id, 'dfd_BuildingAreaTotal');
	sp_add_private_meta( $post_id, 'dfd_BuildingAreaUnits');
	sp_add_private_meta( $post_id, 'dfd_City');
	sp_add_private_meta( $post_id, 'dfd_UnparsedAddress');
	sp_add_private_meta( $post_id, 'dfd_StateOrProvince');
			
	// Update the meta field in the database.
	update_post_meta( $post_id, 'sc_private', $mydata );
}
add_action( 'save_post', 'sp_save_postdata');

function sp_add_private_meta( $post_id, $field) 
{
	$meta = get_post_meta($post_id, $field);
	
	if(empty($meta))
	{
	 update_post_meta( $post_id, $field, '' );
	}
	
}
?>