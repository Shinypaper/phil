<?php

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
//define('Redux_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('Redux_Options')){
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', AZ_THEME_NAME),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', AZ_THEME_NAME),
		'icon' => 'paper-clip',
		'icon_class' => 'icon-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options(){
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    $args['intro_text'] = '';

    // Add content after the form.
    $args['footer_text'] = '';

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/bluxart',
        'title' => 'Follow me on Twitter', 
        'img' => 'font-icon-social-twitter'
    );
    $args['share_icons']['dribbble'] = array(
        'link' => 'http://dribbble.com/Bluxart',
        'title' => 'Find me on Dribbble', 
        'img' => 'font-icon-social-dribbble'
    );
	$args['share_icons']['forrst'] = array(
        'link' => 'http://forrst.com/people/Bluxart',
        'title' => 'Find me on Forrst', 
        'img' => 'font-icon-social-forrst'
    );
	$args['share_icons']['behance'] = array(
        'link' => 'http://www.behance.net/alessioatzeni',
        'title' => 'Find me on Behance', 
        'img' => 'font-icon-social-behance'
    );
	$args['share_icons']['facebook'] = array(
        'link' => 'https://www.facebook.com/Bluxart',
        'title' => 'Find me on Facebook', 
        'img' => 'font-icon-social-facebook'
    );
	$args['share_icons']['google_plus'] = array(
        'link' => 'https://plus.google.com/105500420878314068694/posts',
        'title' => 'Find me on Google Plus', 
        'img' => 'font-icon-social-google-plus'
    );
	$args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/in/alessioatzeni',
        'title' => 'Find me on LinkedIn', 
        'img' => 'font-icon-social-linkedin'
    );
	$args['share_icons']['envato'] = array(
        'link' => 'http://themeforest.net/user/Bluxart',
        'title' => 'Find me on Themeforest', 
        'img' => 'font-icon-social-envato'
    );

    // Enable the import/export feature.
    // Default: true
    $args['show_import_export'] = true;

	// Set the icon for the import/export tab.
	$args['icon_type'] = 'image';
	$args['icon_type'] = 'iconfont';
	// Default: refresh
	$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'chariot';

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Chariot', AZ_THEME_NAME);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Chariot', AZ_THEME_NAME);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options_general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', AZ_THEME_NAME),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', AZ_THEME_NAME)
    );


    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', AZ_THEME_NAME);

    $sections = array();

    $sections[] = array(
		'icon' => 'edit',
		'icon_class' => 'icon-large',
        'title' => __('General Settings', AZ_THEME_NAME),
        'desc' => __('<p class="description">Welcome to the Chariot Options Panel! Control and configure the general setup of your theme.</p>', AZ_THEME_NAME),
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'upload',
                'title' => __('Favicon Upload', AZ_THEME_NAME), 
                'sub_desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', AZ_THEME_NAME),
                'desc' => ''
            ),
			array(
                'id' => 'use-logo',
                'type' => 'checkbox_hide_below',
                'title' => __('Use Image for Logo?', AZ_THEME_NAME), 
                'sub_desc' => __('Upload a logo for your theme.<br/> Otherwise you will see the Plain Text Logo.', AZ_THEME_NAME),
                'desc' => '',
				'switch' => true,
                'std' => '0', // 1 = checked | 0 = unchecked
                'next_to_hide' => '4'
            ),
            array(
                'id' => 'logo',
                'type' => 'upload',
                'title' => __('Logo Upload', AZ_THEME_NAME), 
                'sub_desc' => __('Upload your logo.', AZ_THEME_NAME),
                'desc' => ''  
            ),
			 array(
                'id' => 'logo-size-width',
                'type' => 'text',
                'title' => __('Logo Width', AZ_THEME_NAME), 
                'sub_desc' => __('Specify the width of the logo. Enter only number value.', AZ_THEME_NAME),
                'desc' => ''
            ),
			 array(
                'id' => 'logo-size-height',
                'type' => 'text',
                'title' => __('Logo Height', AZ_THEME_NAME), 
                'sub_desc' => __('Specify the height of the logo. Enter only number value.', AZ_THEME_NAME),
                'desc' => ''
            ),
			array(
                'id' => 'retina-logo',
                'type' => 'upload',
                'title' => __('Retina Logo Upload', AZ_THEME_NAME), 
                'sub_desc' => __('Upload your Retina Logo for Retina Devices.', AZ_THEME_NAME),
                'desc' => ''  
            ),
            array(
                'id' => 'accent-color',
                'type' => 'color',
                'title' => __('Accent Color', AZ_THEME_NAME), 
				'sub_desc' => __('Change this color to specify the "accent" color for your site.<br/> You can also choose six different skin.', AZ_THEME_NAME),
                'desc' => '',
                'std' => '#E96045'
            ),
			array(
                'id' => 'enable-animation',
                'type' => 'checkbox',
                'title' => __('Do you want Preloader?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable preloader page for your site.', AZ_THEME_NAME),
                'desc' => '',
				'switch' => true,
                'std' => '0' // 1 = checked | 0 = unchecked
            ),
			array(
                'id' => 'enable-animation-effects',
                'type' => 'checkbox',
                'title' => __('Do you want Animation Effects on mobile devices?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable animation effects on mobile devices for items.', AZ_THEME_NAME),
                'desc' => '',
				'switch' => true,
                'std' => '1' // 1 = checked | 0 = unchecked
            ),
			array(
                'id' => 'enable-sticky-header',
                'type' => 'checkbox',
                'title' => __('Enable Sticky Header?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable Sticky Header Feature.<br/>This features not available if active boxed layout.', AZ_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'std' => '0' // 1 = checked | 0 = unchecked
            ),
            array(
                'id' => 'enable-back-to-top',
                'type' => 'checkbox',
                'title' => __('Back to Top?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable Back to Top Feature.', AZ_THEME_NAME),
                'desc' => '',
				'switch' => true,
                'std' => '1' // 1 = checked | 0 = unchecked
            ),
			array(
                'id' => 'tracking-code',
                'type' => 'textarea',
                'title' => __('Tracking Code', AZ_THEME_NAME), 
                'sub_desc' => __('Paste your Google Analytics (or other) tracking code here.<br/> It will be inserted before the closing head tag of your theme.', AZ_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'custom-css',
                'type' => 'textarea',
                'title' => __('Custom CSS', AZ_THEME_NAME), 
                'sub_desc' => __('If you have any custom CSS you would like added to the site, please enter it here.', AZ_THEME_NAME),
                'desc' => ''
            )
        )
    );
	
	$sections[] = array(
        'icon' => 'edit',
        'icon_class' => 'icon-large',
        'title' => __('Boxed Layout Settings', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your boxed layout.</p>', AZ_THEME_NAME),
        'fields' => array(   
            array(
                'id' => 'enable-boxed-layout',
                'type' => 'checkbox_hide_below',
                'title' => __('Enable Boxed Layout?', AZ_THEME_NAME), 
                'sub_desc' => __('Do you want enable boxed layout?.', AZ_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'std' => '0',
                'next_to_hide' => '6'
            ),
            array(
                'id' => 'boxed-background-color',
                'type' => 'color',
                'title' => __('Background Color', AZ_THEME_NAME), 
                'sub_desc' => __('If you would rather simply use a solid color for your background, select one here.', AZ_THEME_NAME),
                'desc' => '',
                'std' => '#F1F1F1'
            ),    
            array(
                'id' => 'boxed-background-image',
                'type' => 'upload',
                'title' => __('Background Image', AZ_THEME_NAME), 
                'sub_desc' => __('Upload your background here. You can find sample elements here:<br/><br/>
                                  <em>chariot/_include/img/sample_bg_images/</em><br/>
                                  <em>chariot/_include/img/sample_patterns/</em>', AZ_THEME_NAME),
                'desc' => ''
            ),
            array(
                'id' => 'boxed-background-repeat', 
                'type' => 'select', 
                'title' => __('Background Repeat', AZ_THEME_NAME),
                'sub_desc' => __('Do you want your background to repeat? (Turn on when using patterns)', AZ_THEME_NAME),
                'options' => array(
                    "no-repeat" => "No-Repeat",
                    "repeat" => "Repeat"
                )
            ),
            array(
                'id' => 'boxed-background-position', 
                'type' => 'select', 
                'title' => __('Background Position', AZ_THEME_NAME),
                'sub_desc' => __('How would you like your background image to be aligned?', AZ_THEME_NAME),
                'options' => array(
                     "left top" => "Left Top",
                     "left center" => "Left Center",
                     "left bottom" => "Left Bottom",
                     "center top" => "Center Top",
                     "center center" => "Center Center",
                     "center bottom" => "Center Bottom",
                     "right top" => "Right Top",
                     "right center" => "Right Center",
                     "right bottom" => "Right Bottom"
                )
            ),
            array(
                'id' => 'boxed-background-attachment', 
                'type' => 'select', 
                'title' => __('Background Attachment', AZ_THEME_NAME),
                'sub_desc' => __('Would you prefer your background to scroll with your site or be fixed and not move', AZ_THEME_NAME),
                'options' => array(
                    "scroll" => "Scroll",
                    "fixed" => "Fixed"
                )
            ),
            array(
                'id' => 'boxed-background-cover',
                'type' => 'checkbox',
                'title' => __('Auto resize background image to fit window?', AZ_THEME_NAME), 
                'sub_desc' => __('This will ensure your background image always fits no matter what size screen the user has. (Don\'t use with patterns)', AZ_THEME_NAME),
                'desc' => '',
                'std' => '0' 
            )
        )
    );

    $sections[] = array(
		'icon' => 'edit',
		'icon_class' => 'icon-large',
        'title' => __('Footer Settings', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your footer area.</p>', AZ_THEME_NAME),
        'fields' => array(
            array(
                'id' => 'footer-widget-columns',
                'type' => 'radio_img',
                'title' => __('Footer Widget Area Columns', AZ_THEME_NAME), 
                'sub_desc' => __('Select the columns for footer widget area.', AZ_THEME_NAME),
                'desc' => '',
                'options' => array(
                    '2' => array('title' => '2 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/2col.png'),
                    '3' => array('title' => '3 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
                    '4' => array('title' => '4 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/4col.png')
                ),
                'std' => '3'
            ),   
			array(
                'id' => 'enable-footer-social-area',
                'type' => 'checkbox',
                'title' => __('Footer Social Area', AZ_THEME_NAME), 
                'sub_desc' => __('Do you want enable social profiles?<br/>You can set your social profile in <b>Social Options Tabs</b>.', AZ_THEME_NAME),
                'desc' => '',
                'switch' => true,
                'std' => '0'
            ),
			array(
                'id' => 'footer-copyright-text',
                'type' => 'textarea',
                'title' => __('Footer Copyright Section Text', AZ_THEME_NAME), 
                'sub_desc' => __('Please enter the copyright section text.<br/>HTML is allowed.', AZ_THEME_NAME),
                'desc' => ''
            )
        )
    );
	
	$sections[] = array(
		'icon' => 'folder-open-alt',
		'icon_class' => 'icon-large',
        'title' => __('Portfolio Options', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your portfolio.</p>', AZ_THEME_NAME),
        'fields' => array( 
			array(
                'id' => 'enable-comment-portfolio-area',
                'type' => 'checkbox',
                'title' => __('Enable Comments Template on Single Portfolio Post?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable Comments Template.', AZ_THEME_NAME),
                'desc' => '',
				'switch' => true,
                'std' => '0' // 1 = checked | 0 = unchecked
            ),
			array(
				'id' => 'portfolio_rewrite_slug', 
				'type' => 'text', 
				'title' => __('Custom Slug', AZ_THEME_NAME),
				'sub_desc' => __('If you want your portfolio post type to have a custom slug in the url, please enter it here. <br/><br/> <br>
								 <b>You will still have to refresh your permalinks after saving this!</b> <br/><br/>This is done by going to <b>Settings -> Permalinks</b> and clicking save.', AZ_THEME_NAME),
				'desc' => ''
			)                          
        )
    );
	
	$sections[] = array(
		'icon' => 'folder-open-alt',
		'icon_class' => 'icon-large',
        'title' => __('Team Options', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your team.</p>', AZ_THEME_NAME),
        'fields' => array( 
			array(
                'id' => 'enable-comment-team-area',
                'type' => 'checkbox',
                'title' => __('Enable Comments Template on Single Team Post?', AZ_THEME_NAME), 
                'sub_desc' => __('Enable/Disable Comments Template.', AZ_THEME_NAME),
                'desc' => '',
				  'switch' => true,
                'std' => '0' // 1 = checked | 0 = unchecked
            ),
			array(
				'id' => 'team_rewrite_slug', 
				'type' => 'text', 
				'title' => __('Custom Slug', AZ_THEME_NAME),
				'sub_desc' => __('If you want your team post type to have a custom slug in the url, please enter it here. <br/><br/> <br>
								 <b>You will still have to refresh your permalinks after saving this!</b> <br/><br/>This is done by going to <b>Settings -> Permalinks</b> and clicking save.', AZ_THEME_NAME),
				'desc' => ''
			)                          
        )
    );
	
	$sections[] = array(
		'icon' => 'edit',
		'icon_class' => 'icon-large',
        'title' => __('Blog Settings', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your blog.</p>', AZ_THEME_NAME),
        'fields' => array(
            array(
                'id' => 'blog-social',
                'type' => 'checkbox_hide_below',
                'title' => __('Social Media Sharing Buttons', AZ_THEME_NAME), 
                'sub_desc' => __('Activate this to enable social sharing buttons on your blog posts.', AZ_THEME_NAME),
                'desc' => '',
                'next_to_hide' => '4',
                'switch' => true,
                'std' => '0' 
            ),  
             array(
                'id' => 'blog-facebook-sharing',
                'type' => 'checkbox',
                'title' => __('Facebook', AZ_THEME_NAME), 
                'sub_desc' => 'Share it.',
                'std' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-twitter-sharing',
                'type' => 'checkbox',
                'title' => __('Twitter', AZ_THEME_NAME), 
                'sub_desc' => 'Tweet it.',
                'std' => '1', 
                'desc' => '',
            ),
            array(
                'id' => 'blog-google-sharing',
                'type' => 'checkbox',
                'title' => __('Google Plus', AZ_THEME_NAME), 
                'sub_desc' => 'Google it.',
                'std' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-pinterest-sharing',
                'type' => 'checkbox',
                'title' => __('Pinterest', AZ_THEME_NAME), 
                'sub_desc' => 'Pin it.',
                'std' => '1',
                'desc' => '',
            ),
			array(
				'id' => 'blog_type',
				'type' => 'select_hide_below',
				'title' => __('Blog Type', AZ_THEME_NAME), 
				'sub_desc' => __('Please select your blog format here.', AZ_THEME_NAME),
				'desc' => '',
				'options' => array(
					'standard-blog' => array('name' => 'Standard Blog', 'allow' => 'true'),
					'masonry-blog' => array('name' => 'Masonry Blog', 'allow' => 'false')
				),
				'std' => 'standard-blog'
			),
			
			array(
				'id' => 'blog_sidebar_layout',
				'type' => 'radio_img',
				'title' => __('Blog Sidebar Layout', AZ_THEME_NAME), 
				'sub_desc' => __('Select main content and sidebar alignment.', AZ_THEME_NAME),
				'desc' => '',
				'options' => array(
					'no_side' => array('title' => 'No Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/no_side.png'),
					'left_side' => array('title' => 'Left Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/left_side.png'),
					'right_side' => array('title' => 'Right Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/right_side.png')
				),
				'std' => 'right_side'
			),
			
			array(
				'id' => 'blog_post_sidebar_layout',
				'type' => 'radio_img',
				'title' => __('Blog Post Sidebar Layout', AZ_THEME_NAME), 
				'sub_desc' => __('Select main content and sidebar alignment for single post.', AZ_THEME_NAME),
				'desc' => '',
				'options' => array(
					'no_side' => array('title' => 'No Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/no_side.png'),
					'left_side' => array('title' => 'Left Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/left_side.png'),
					'right_side' => array('title' => 'Right Sidebar', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/right_side.png')
				),
				'std' => 'right_side'
			),
			
			array(
				'id' => 'masonry_layout',
				'type' => 'radio_img',
				'title' => __('Masonry Layout', AZ_THEME_NAME), 
				'sub_desc' => __('Select the column for masonry blog.', AZ_THEME_NAME),
				'desc' => '',
				'options' => array(
					'2' => array('title' => '2 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/2col.png'),
					'3' => array('title' => '3 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
					'4' => array('title' => '4 Columns', 'img' => AZ_FRAMEWORK_DIRECTORY.'options/img/4col.png')
				),
				'std' => '3'
			)
        )
    );
	
	$sections[] = array(
		'icon' => 'map-marker',
		'icon_class' => 'icon-large',
        'title' => __('Contact Map Options', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your contact and map page.</p>', AZ_THEME_NAME),
        'fields' => array(
			array(
				'id' => 'title-marker',
				'type' => 'text',
				'title' => __('Insert your Title Marker', AZ_THEME_NAME), 
				'sub_desc' => __('Please Enter here your text of Title Marker.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'zoom-level',
				'type' => 'text',
				'title' => __('Default Map Zoom Level', AZ_THEME_NAME), 
				'sub_desc' => __('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', AZ_THEME_NAME),
				'desc' => '',
				'validate' => 'numeric'
			),
			array(
				'id' => 'center-lat',
				'type' => 'text',
				'title' => __('Map Center Latitude', AZ_THEME_NAME), 
				'sub_desc' => __('Please enter the latitude for the maps center point.', AZ_THEME_NAME),
				'desc' => '',
				'validate' => 'numeric'
			),
			array(
				'id' => 'center-lng',
				'type' => 'text',
				'title' => __('Map Center Longitude', AZ_THEME_NAME), 
				'sub_desc' => __('Please enter the longitude for the maps center point.', AZ_THEME_NAME),
				'desc' => '',
				'validate' => 'numeric'
			),
			array(
				'id' => 'marker-img',
				'type' => 'upload',
				'title' => __('Marker Icon Upload', AZ_THEME_NAME), 
				'sub_desc' => __('Please upload an image that will be used for the marker on your map.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'map-info',
				'type' => 'textarea',
				'title' => __('Map Infowindow Text', AZ_THEME_NAME), 
				'sub_desc' => __('If you would like to display any text in an info window for location, please enter it here.<br/> HTML is allowed.', AZ_THEME_NAME),
				'desc' => ''
			)		
        )
    );
	
	$sections[] = array(
		'icon' => 'twitter',
		'icon_class' => 'icon-large',
        'title' => __('Social Options', AZ_THEME_NAME),
        'desc' => __('<p class="description">Control and configure the general setup of your social profile. <br/>Will be visible in the footer area (if enabled) and the social profile widget.</p>', AZ_THEME_NAME),
        'fields' => array(
			array(
				'id' => '500px-url', 
				'type' => 'text', 
				'title' => __('500PX URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your 500PX URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'addthis-url', 
				'type' => 'text', 
				'title' => __('Add This URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Add This URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'behance-url', 
				'type' => 'text', 
				'title' => __('Behance URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Behance URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'bebo-url', 
				'type' => 'text', 
				'title' => __('Bebo URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Bebo URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'blogger-url', 
				'type' => 'text', 
				'title' => __('Blogger URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Blogger URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'deviant-art-url', 
				'type' => 'text', 
				'title' => __('Deviant Art URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Deviant Art URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'digg-url', 
				'type' => 'text', 
				'title' => __('Digg URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Digg URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'dribbble-url', 
				'type' => 'text', 
				'title' => __('Dribbble URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Dribbble URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'email-url', 
				'type' => 'text', 
				'title' => __('Email URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Email URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'envato-url', 
				'type' => 'text', 
				'title' => __('Envato URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Envato URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'evernote-url', 
				'type' => 'text', 
				'title' => __('Evernote URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Envernote URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'facebook-url', 
				'type' => 'text', 
				'title' => __('Facebook URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Facebook URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'flickr-url', 
				'type' => 'text', 
				'title' => __('Flickr URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Flickr URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'forrst-url', 
				'type' => 'text', 
				'title' => __('Forrst URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Forrst URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'github-url', 
				'type' => 'text', 
				'title' => __('Github URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Github URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'google-plus-url', 
				'type' => 'text', 
				'title' => __('Google Plus URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Google Plus URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'grooveshark-url', 
				'type' => 'text', 
				'title' => __('Grooveshark URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Grooveshark URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'instagram-url', 
				'type' => 'text', 
				'title' => __('Instagram URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Instagram URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'last-fm-url', 
				'type' => 'text', 
				'title' => __('Last FM URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Last FM URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'linkedin-url', 
				'type' => 'text', 
				'title' => __('Linked In URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Linked In URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'myspace-url', 
				'type' => 'text', 
				'title' => __('My Space URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your My Space URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'paypal-url', 
				'type' => 'text', 
				'title' => __('Paypal URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Paypal URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'photobucket-url', 
				'type' => 'text', 
				'title' => __('Photobucket URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Photobucket URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'pinterest-url', 
				'type' => 'text', 
				'title' => __('Pinterest URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Pinterest URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'quora-url', 
				'type' => 'text', 
				'title' => __('Quora URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Quora URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'share-this-url', 
				'type' => 'text', 
				'title' => __('Share This URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Share This URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'skype-url', 
				'type' => 'text', 
				'title' => __('Skype URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Skype URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'soundcloud-url', 
				'type' => 'text', 
				'title' => __('Soundcloud URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Soundcloud URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'stumbleupon-url', 
				'type' => 'text', 
				'title' => __('Stumble Upon URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Stumble Upon URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'tumblr-url', 
				'type' => 'text', 
				'title' => __('Tumblr URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Tumblr URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'twitter-url', 
				'type' => 'text', 
				'title' => __('Twitter URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Twitter URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'viddler-url', 
				'type' => 'text', 
				'title' => __('Viddler URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Viddler URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'vimeo-url', 
				'type' => 'text', 
				'title' => __('Vimeo URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Vimeo URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'virb-url', 
				'type' => 'text', 
				'title' => __('Virb URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Virb URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'wordpress-url', 
				'type' => 'text', 
				'title' => __('Wordpress URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Wordpress URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'yahoo-url', 
				'type' => 'text', 
				'title' => __('Yahoo URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Yahoo URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'yelp-url', 
				'type' => 'text', 
				'title' => __('Yelp URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Yelp URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'youtube-url', 
				'type' => 'text', 
				'title' => __('You Tube URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your You Tube URL.', AZ_THEME_NAME),
				'desc' => ''
			),
			array(
				'id' => 'zerply-url', 
				'type' => 'text', 
				'title' => __('Zerply URL', AZ_THEME_NAME),
				'sub_desc' => __('Please enter in your Zerply URL.', AZ_THEME_NAME),
				'desc' => ''
			)
        )
    );
	          
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', AZ_THEME_NAME) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', AZ_THEME_NAME) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', AZ_THEME_NAME) . $version . '</p>';
	$item_info .= '<p class="redux-opts-item-data description item-tags"><div class="redux-opts-heading"><h3>' . __('Documentation: ', AZ_THEME_NAME) . '</h3></div>';
	$item_info .= '<p class="redux-opts-item-data description">' . __('You can find the high quality version of documentation inside the package. For view this docs you have to be logged in a google account.', AZ_THEME_NAME) . '</p>';
	$item_info .= '<iframe src="http://docs.google.com/gview?url=themes.alessioatzeni.com/docs/chariot-documentation.pdf&embedded=true" style="width:100%; height:800px;" frameborder="0"></iframe>';
    $item_info .= '</div>';

    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', AZ_THEME_NAME),
        'content' => $item_info
    );
    
	/*
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', AZ_THEME_NAME),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }
	*/
	
    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}
