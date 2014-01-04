<?php

add_theme_support( 'post-thumbnails' ); 

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
//require_once('wp_bootstrap_navwalker.php');



?>