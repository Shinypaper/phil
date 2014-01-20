<?php

add_theme_support( 'post-thumbnails' ); 

function my_register_sidebars() {

	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'blog-sidebar',
			'name' => __( 'Blog Sidebar' ),
			'description' => __( 'This will be displayed on the blog page' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	/* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'my_register_sidebars' );

function register_my_menus() {
  register_nav_menus(
    array(
      'primary' => 'Primary Menu' ,
      'secondary' => 'Secondary Menu'
    )
  );
}
add_action( 'init', 'register_my_menus' );
// Register Custom Navigation Walker
// docs at https://github.com/twittem/wp-bootstrap-navwalker
require_once('wp_bootstrap_navwalker.php');



?>