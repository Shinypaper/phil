<?php

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Meta
/*-----------------------------------------------------------------------------------*/


add_action('add_meta_boxes', 'az_metabox_portfolio');
function az_metabox_portfolio(){
    
	
/*-----------------------------------------------------------------------------------*/
/*	Thumbnails Setting
/*-----------------------------------------------------------------------------------*/

	$meta_box = array(
		'id' => 'az-metabox-portfolio-settings',
		'title' =>  __('Portfolio Thumbnails Settings', AZ_THEME_NAME),
		'description' => __('You can choose if you want use a fancybox gallery or insert a pop-up video.', AZ_THEME_NAME),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array( 
				'name' => __('FancyBox Gallery', AZ_THEME_NAME),
				'desc' => __('Please enter gallery name.', AZ_THEME_NAME),
				'id' => '_az_fancy_gallery',
				'type' => 'text',
				'std' => ''
			),
			array( 
				'name' => __('FancyBox Video', AZ_THEME_NAME),
				'desc' => __('Please enter Video URL.', AZ_THEME_NAME),
				'id' => '_az_fancy_video',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	
	$callback = create_function( '$post,$meta_box', 'az_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	

/*-----------------------------------------------------------------------------------*/
/*	Page Portfolio Header Setting Meta
/*-----------------------------------------------------------------------------------*/

global $wpdb;
  $rs = $wpdb->get_results( 
  	"
  	SELECT id, title, alias
  	FROM ".$wpdb->prefix."revslider_sliders
  	ORDER BY id ASC LIMIT 100
  	"
  );
  $revsliders = array();
  if ($rs) {
    foreach ( $rs as $slider ) {
      $revsliders[$slider->alias] = $slider->alias;
    }
  } else {
    $revsliders["No sliders found"] = 0;
  }

    $meta_box = array(
		'id' => 'az-metabox-page-header',
		'title' => __('Portfolio Page Header Settings', AZ_THEME_NAME),
		'description' => __('Here you can configure how your page header will appear.', AZ_THEME_NAME),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Portfolio Page Header Settings', AZ_THEME_NAME),
					'desc' => __('Enable or Disable the Header Page Settings.', AZ_THEME_NAME),
					'id' => '_az_header_settings',
					'type' => 'select',
					'std' => 'enabled',
					'options' => array(
						"enabled" => "Enabled",
						"disabled" => "Disabled"
					)
				),
			array( 
					'name' => __('Portfolio Page Header Image', AZ_THEME_NAME),
					'desc' => __('Upload your image should be between 1600px x 800px (or more) for best results.', AZ_THEME_NAME),
					'id' => '_az_header_bg',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => __('Page Header Image Overlay', AZ_THEME_NAME),
					'desc' => __('Enable or Disable Overlay Background.', AZ_THEME_NAME),
					'id' => '_az_header_overlay',
					'type' => 'checkbox',
					'std' => 1
				),
			array( 
					'name' => __('Portfolio Page Header Image Background Attachment', AZ_THEME_NAME),
					'desc' => __('Background Image Attachment.', AZ_THEME_NAME),
					'id' => '_az_header_bg_attachment',
					'type' => 'select',
					'std' => 'fixed',
					'options' => array(
						"scroll" => "Scroll",
						"fixed" => "Fixed"
					)
				),
			array( 
					'name' => __('Revolution Slider Alias', AZ_THEME_NAME),
					'desc' => __('Select your Revolution Slider Alias for the slider that you want to show.', AZ_THEME_NAME),
					'id' => '_az_intro_slider_header',
					'type' => 'select_slider',
					'options' => $revsliders,
					'std' => ''
				),
			array( 
					'name' => __('Portfolio Page Title', AZ_THEME_NAME),
					'desc' => __('You can insert a custom page title instead of default page title.', AZ_THEME_NAME),
					'id' => '_az_page_title',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Portfolio Page Caption', AZ_THEME_NAME),
					'desc' => __('You can insert a custom text caption instead of project attributes.', AZ_THEME_NAME),
					'id' => '_az_page_caption',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Portfolio Page Title and Caption Align', AZ_THEME_NAME),
					'desc' => __('You can align the text in three different ways.', AZ_THEME_NAME),
					'id' => '_az_page_text_align',
					'type' => 'select',
					'std' => 'textalignleft',
					'options' => array(
						"textalignleft" => "Left Align",
						"textaligncenter" => "Center Align",
						"textalignright" => "Right Align"
					)
				)
		)
	);

	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
}