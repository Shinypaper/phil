<?php 
add_action('add_meta_boxes', 'az_metabox_posts');
function az_metabox_posts(){
    
/*-----------------------------------------------------------------------------------*/
/*	Post Header Setting
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
		'id' => 'az-metabox-post-header',
		'title' => __('Post Header Settings', AZ_THEME_NAME),
		'description' => __('Here you can configure how your post header will appear.', AZ_THEME_NAME),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Post Header Settings', AZ_THEME_NAME),
					'desc' => __('Enable or Disable the Header Post Settings.', AZ_THEME_NAME),
					'id' => '_az_header_settings',
					'type' => 'select',
					'std' => 'enabled',
					'options' => array(
						"enabled" => "Enabled",
						"disabled" => "Disabled"
					)
				),
			array( 
					'name' => __('Post Header Image', AZ_THEME_NAME),
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
					'name' => __('Post Header Image Background Attachment', AZ_THEME_NAME),
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
					'name' => __('Post Title', AZ_THEME_NAME),
					'desc' => __('You can insert a custom page title instead of default post title.', AZ_THEME_NAME),
					'id' => '_az_page_title',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Post Caption', AZ_THEME_NAME),
					'desc' => __('You can insert a custom text caption.', AZ_THEME_NAME),
					'id' => '_az_page_caption',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Post Title and Caption Align', AZ_THEME_NAME),
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
	$callback = create_function( '$post,$meta_box', 'az_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
    
	
/*-----------------------------------------------------------------------------------*/
/*	Gallery Setting
/*-----------------------------------------------------------------------------------*/

    $meta_box = array(
		'id' => 'az-metabox-post-gallery',
		'title' =>  __('Gallery Settings', AZ_THEME_NAME),
		'description' => '',
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
				'name' => __('Revolution Slider Alias', AZ_THEME_NAME),
				'desc' => __('Select your Revolution Slider Alias for the slider that you want to show.', AZ_THEME_NAME),
				'id' => '_az_gallery',
				'type' => 'select_slider',
				'options' => $revsliders,
				'std' => ''
			)
		)
	);
    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
/*-----------------------------------------------------------------------------------*/
/*	Quote Setting
/*-----------------------------------------------------------------------------------*/

    $meta_box = array(
		'id' => 'az-metabox-post-quote',
		'title' =>  __('Quote Settings', AZ_THEME_NAME),
		'description' => '',
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('Quote Content', AZ_THEME_NAME),
					'desc' => __('Please type the text for your quote here.', AZ_THEME_NAME),
					'id' => '_az_quote',
					'type' => 'textarea',
                    'std' => ''
				)
		)
	);
    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
/*-----------------------------------------------------------------------------------*/
/*	Link Setting
/*-----------------------------------------------------------------------------------*/

	$meta_box = array(
		'id' => 'az-metabox-post-link',
		'title' =>  __('Link Settings', AZ_THEME_NAME),
		'description' => '',
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('Link URL', AZ_THEME_NAME),
					'desc' => __('Please input the URL for your link.', AZ_THEME_NAME),
					'id' => '_az_link',
					'type' => 'text',
					'std' => ''
				)
		)
	);
    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
    
/*-----------------------------------------------------------------------------------*/
/*	Video Setting
/*-----------------------------------------------------------------------------------*/

    $meta_box = array(
		'id' => 'az-metabox-post-video',
		'title' => __('Video Settings', AZ_THEME_NAME),
		'description' => '',
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('OGV File URL', AZ_THEME_NAME),
					'desc' => __('Please enter in the URL to your .ogv video file', AZ_THEME_NAME),
					'id' => '_az_video_ogv',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => __('M4V File URL', AZ_THEME_NAME),
					'desc' => __('Please enter in the URL to your .m4v video file', AZ_THEME_NAME),
					'id' => '_az_video_m4v',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => __('Preview Image', AZ_THEME_NAME),
					'desc' => __('This will be the image displayed when the video has not been played yet.', AZ_THEME_NAME),
					'id' => '_az_video_poster_url',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' => __('Embedded Code', AZ_THEME_NAME),
					'desc' => __('If the video is an embed rather than self hosted, enter in a Youtube or Vimeo embed code here.', AZ_THEME_NAME),
					'id' => '_az_video_embed',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
/*-----------------------------------------------------------------------------------*/
/*	Audio Setting
/*-----------------------------------------------------------------------------------*/

	$meta_box = array(
		'id' => 'az-metabox-post-audio',
		'title' =>  __('Audio Settings', AZ_THEME_NAME),
		'description' => '',
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
				'name' => __('MP3 File URL', AZ_THEME_NAME),
				'desc' => __('Please enter in the URL to the .mp3 file', AZ_THEME_NAME),
				'id' => '_az_audio_mp3',
				'type' => 'file',
				'std' => ''
			)
		)
	);
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

?>