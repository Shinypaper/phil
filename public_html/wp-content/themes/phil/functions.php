<?php

add_theme_support( 'post-thumbnails' ); 

register_nav_menus( array(
	'primary'   => __( 'Primary menu' ),
	'secondary' => __( 'Secondary menu' ),
) );

// Register Custom Navigation Walker
// docs at https://github.com/twittem/wp-bootstrap-navwalker
require_once('wp_bootstrap_navwalker.php');



?>