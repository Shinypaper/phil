<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sp_scripts() {

	/*wp-includes/js/jquery/jquery.js?ver=1.8.3*/
	//wp_enqueue_script('jquery', false, array(), false, true);
	
	$theme = get_option("sc-layout-theme","bootstrap");
	
	if($theme == "bootstrap")
	{
		wp_enqueue_script(
		'bootstrap',
		 plugins_url( 'lib/bootstrap/js/bootstrap.min.js' , __FILE__ ), 
		array('jquery'), 
		'2.3.2', 
		true);
		
		wp_enqueue_script(
		'bootstrap-modal-master',
		 plugins_url( 'lib/bootstrap-modal-master/js/bootstrap-modalmanager.js' , __FILE__ ), 
		array('jquery'), 
		'2.2', 
		true);
	}
	
	if($theme == "spbootstrap")
	{
		//Uses the same js scripts
		wp_enqueue_script(
		'bootstrap',
		 plugins_url( 'lib/bootstrap/js/bootstrap.min.js' , __FILE__ ), 
		array('jquery'), 
		'2.3.2', 
		true);
		
		wp_enqueue_script(
		'bootstrap-modal-master',
		 plugins_url( 'lib/bootstrap-modal-master/js/bootstrap-modalmanager.js' , __FILE__ ), 
		array('jquery'), 
		'2.2', 
		true);
	}
	
	wp_enqueue_script(
	'jquery.cookie',
	plugins_url( 'lib/jquery.cookie/jquery.cookie.js' , __FILE__ ),
	array('jquery'), 
	'1.3.1', 
	true);
	
	wp_enqueue_script(
	'jquery.prettyPhoto',
	plugins_url( 'lib/jquery.prettyPhoto/js/jquery.prettyPhoto.js' , __FILE__ ),
	array('jquery'), 
	'2.1.5', 
	true);
	
	wp_enqueue_script(
	'google.maps',
	'//maps.google.com/maps/api/js?sensor=false&.js',
	array('jquery'), 
	'3.0.0', 
	false);
		
	wp_enqueue_script(
	'gmap3',
	plugins_url( 'lib/gmap3v5.1.1/gmap3.min.js' , __FILE__ ),
	array('jquery'), 
	'5.1.1', 
	true);
		
	wp_enqueue_script(
	'flexslider',
	plugins_url( 'lib/jquery.flexslider/jquery.flexslider-min.js' , __FILE__ ),
	array('jquery'), 
	'5.1.1', 
	true);
		
	wp_enqueue_script(
	'sanskript.soldpress',
	plugins_url( 'soldpress.js' , __FILE__ ),
	array('jquery'), 
	'1.1.1', 
	true);
}

add_action( 'wp_enqueue_scripts', 'sp_scripts' ); 

function sp_styles()  
{ 

	$theme = get_option("sc-layout-theme","bootstrap");
	
	if($theme == "bootstrap")
	{
		wp_register_style( 'bootstrap-style', 
		 plugins_url( 'lib/bootstrap/css/bootstrap.min.css' , __FILE__ ), 
		array(), 
		'2.3.2', 
		'all' );		
		wp_enqueue_style( 'bootstrap-style' );
	  
		$isResponsive = get_option( 'sc-layout-responsive',1 );
		if($isResponsive == 1)
		{
			wp_register_style( 'bootstrap-responsive-style', 
			plugins_url( 'lib/bootstrap/css/bootstrap-responsive.css' , __FILE__ ), 
			array(), 
			'2.3.2', 
			'all' );		
			wp_enqueue_style( 'bootstrap-responsive-style' );	
		
			wp_register_style( 'bootstrap-modal-master-style', 
			plugins_url( 'lib/bootstrap-modal-master/css/bootstrap-modal.css' , __FILE__ ), 
			array(), 
			'2.2', 
			'all' );		
			wp_enqueue_style( 'bootstrap-modal-master-style' );
		}
	}

	if($theme == "spbootstrap")
	{
		wp_register_style( 'sp-bootstrap-style', 
		 plugins_url( 'lib/bootstrap/css/bootstrap-sp.css' , __FILE__ ), 
		array(), 
		'2.3.2', 
		'all' );		
		wp_enqueue_style( 'sp-bootstrap-style' );
	  
		$isResponsive = get_option( 'sc-layout-responsive',1 );
		if($isResponsive == 1)
		{
			wp_register_style( 'sp-bootstrap-responsive-style', 
			plugins_url( 'lib/bootstrap/css/responsive-sp.css' , __FILE__ ), 
			array(), 
			'2.3.2', 
			'all' );		
			wp_enqueue_style( 'sp-bootstrap-responsive-style' );	
		
			wp_register_style( 'bootstrap-modal-master-style', 
			plugins_url( 'lib/bootstrap-modal-master/css/bootstrap-modal.css' , __FILE__ ), 
			array(), 
			'2.2', 
			'all' );		
			wp_enqueue_style( 'bootstrap-modal-master-style' );
		}
	}
	
	
	if($theme == "custom")
	{			
		wp_register_style( 'sp-bootstrap-style', 
			$filepath = SOLDPRESS_BASEUPLOAD_FILE . '/custom/boostrap.css', 
			array(), 
			'2.3.2', 
			'all' );					
		wp_enqueue_style( 'sp-bootstrap-style' );
			
		$isResponsive = get_option( 'sc-layout-responsive',1 );
		if($isResponsive == 1)
		{
			wp_register_style( 'sp-bootstrap-responsive-style', 
			SOLDPRESS_BASEUPLOAD_FILE . '/custom/bootstrap-responsive.css', 
			array(), 
			'2.3.2', 
			'all' );		
			wp_enqueue_style( 'sp-bootstrap-responsive-style' );	
		
			wp_register_style( 'bootstrap-modal-master-style', 
			plugins_url( 'lib/bootstrap-modal-master/css/bootstrap-modal.css' , __FILE__ ), 
			array(), 
			'2.2', 
			'all' );		
			wp_enqueue_style( 'bootstrap-modal-master-style' );
		}
	}
	
	if($theme == "none")
	{
	
	}
	
	wp_register_style( 'jquery.prettyPhoto-style', 
	plugins_url( 'lib/jquery.prettyPhoto/css/prettyPhoto.css' , __FILE__ ), 
	array(), 
	'2.1.5', 
	'all' );		
	wp_enqueue_style( 'jquery.prettyPhoto-style' );
		
	wp_register_style( 'jquery.flexsilder-style', 
	plugins_url( 'lib/jquery.flexslider/flexslider.css' , __FILE__ ), 
	array(), 
	'2.0.0', 
	'all' );	
	wp_enqueue_style( 'jquery.flexsilder-style' );
	
	wp_register_style( 'font-awesome-style', 
	plugins_url( 'lib/font-awesome/css/font-awesome.min.css' , __FILE__ ), 
	array(), 
	'3.1.1.', 
	'all' );	
	wp_enqueue_style( 'font-awesome-style' );
	 
	wp_enqueue_style('ie7-style', 'lib/font-awesome/css/font-awesome-ie7.min.css');
	global $wp_styles;
	$wp_styles->add_data('ie7-style', 'conditional', 'lte IE 7');


	/*  wp_register_style( 'soldpress-style', 
		plugins_url( 'style/soldpress.min.css' , __FILE__ ), 
		array(), 
		'1.1.0', 
		'all' );*/
		
		//TODO://Check If Debug Mode
		
	wp_register_style( 'soldpress-style', 
	plugins_url( 'style/soldpress.css' , __FILE__ ), 
	array(), 
	'1.2.0', 
	'all' );
		
	wp_enqueue_style( 'soldpress-style' );
}

add_action('wp_enqueue_scripts', 'sp_styles');

?>
