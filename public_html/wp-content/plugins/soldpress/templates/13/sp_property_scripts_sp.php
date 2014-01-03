<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'sp_only_scripts' ) ) {

function sp_only_scripts() {

	$theme = get_option("sc-layout-theme","bootstrap");
	
	if($theme == "bootstrap" || $theme == "spbootstrap")
	{
		//Uses the same js scripts
		wp_enqueue_script(
		'bootstrap',
		SOLDPRESS_PLUGIN_URL. 'lib/bootstrap/js/bootstrap.min.js', 
		array('jquery'), 
		'2.3.2', 
		true);
		
		wp_enqueue_script(
		'bootstrap-modal-master',
		SOLDPRESS_PLUGIN_URL. 'lib/bootstrap-modal-master/js/bootstrap-modalmanager.js', 
		array('jquery'), 
		'2.2', 
		true);
	}
	
	$load_jquery_cookie = get_option("sc-layout-jquery-cookie",true);
	
	if($load_jquery_cookie)
	{
		wp_enqueue_script(
		'jquery.cookie',
		SOLDPRESS_PLUGIN_URL. 'lib/jquery.cookie/jquery.cookie.js',
		array('jquery'), 
		'1.3.1', 
		true);
	}
	
	$load_jquery_prettyPhoto = get_option("sc-layout-jquery-prettyPhoto",true);
	
	if($load_jquery_prettyPhoto)
	{
		wp_enqueue_script(
		'jquery.prettyPhoto',
		SOLDPRESS_PLUGIN_URL. 'lib/jquery.prettyPhoto/js/jquery.prettyPhoto.js',
		array('jquery'), 
		'2.1.5', 
		true);
	}
	
	$load_google_maps = get_option("sc-layout-google-maps",true);
	if($load_google_maps)
	{	
		wp_enqueue_script(
		'google.maps',
		'//maps.google.com/maps/api/js?sensor=false&.js',
		array('jquery'), 
		'3.0.0', 
		false);
	}
	
	$load_gmap3 = get_option("sc-layout-gmap3",true);
	if($load_gmap3)
	{
		wp_enqueue_script(
		'gmap3',
		SOLDPRESS_PLUGIN_URL.'lib/gmap3v5.1.1/gmap3.js',
		array('jquery'), 
		'5.1.1', 
		true);
	}
	
	$load_flexslider = get_option("sc-layout-flexslider",true);
	if($load_flexslider)
	{
		wp_enqueue_script(
		'flexslider',
		SOLDPRESS_PLUGIN_URL.'lib/jquery.flexslider/jquery.flexslider-min.js',
		array('jquery'), 
		'2.2.1', 
		true);
	}
	
	$load_jquery_bxslider = get_option("sc-layout-jquery.bxslider",true);	
	if($load_jquery_bxslider)
	{
		wp_enqueue_script(
		'jquery.bxslider',
		SOLDPRESS_PLUGIN_URL. 'lib/jquery.bxslider/jquery.bxslider.min.js',
		array('jquery'), 
		'4.1.1', 
		true);
	}
	
	
	$load_spinjs = get_option("sc-layout-spinjs",true);
	if($load_spinjs)
	{	
		wp_enqueue_script(
		'spinjs',
		SOLDPRESS_PLUGIN_URL.'lib/spinjs/spin.min.js',
		array(), 
		'1.3.2', 
		true);

	}
	
	$load_markerclusterer = get_option("sc-layout-markerclusterer",true);
	if($load_markerclusterer)
	{	
		wp_enqueue_script(
		'markerclusterer',
		SOLDPRESS_PLUGIN_URL.'lib/markerclusterer/markerclusterer.js',
		array(), 
		'1.0.1', 
		true);

	}
	
	$load_sanskript_soldpress = get_option("sc-layout-soldpress",true);
	if($load_sanskript_soldpress)
	{
		wp_enqueue_script(
		'sanskript.soldpress',
		SOLDPRESS_PLUGIN_URL. 'soldpress.js',
		array('jquery'), 
		'1.3.0', 
		true);
	}
	
	/*wp_enqueue_script(
		'jquery.jcarousel',
		SOLDPRESS_PLUGIN_URL. 'lib/jquery.jcarousel/jquery.jcarousel.min.js',
		array('jquery'), 
		'0.2.9', 
		true);*/
	
	/* <!--[if lt IE 10]>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
      <![endif]-->*/
	
}

add_action( 'wp_enqueue_scripts', 'sp_only_scripts' ); 

}

if ( ! function_exists( 'sp_only_styles' ) ) {

function sp_only_styles()  
{ 

	$theme = get_option("sc-layout-theme","bootstrap");
	
	if($theme == "bootstrap" || $theme == "spbootstrap")
	{
		wp_register_style( 'sp-bootstrap-style', 
		SOLDPRESS_PLUGIN_URL. 'lib/bootstrap/css/bootstrap-sp.css', 
		array(), 
		'2.3.2', 
		'all' );		
		wp_enqueue_style( 'sp-bootstrap-style' );
	  
		$isResponsive = get_option( 'sc-layout-responsive',1 );
		if($isResponsive == 1)
		{
			wp_register_style( 'sp-bootstrap-responsive-style', 
			SOLDPRESS_PLUGIN_URL. 'lib/bootstrap/css/responsive-sp.css', 
			array(), 
			'2.3.2', 
			'all' );		
			wp_enqueue_style( 'sp-bootstrap-responsive-style' );	
		
			wp_register_style( 'bootstrap-modal-master-style', 
			SOLDPRESS_PLUGIN_URL. 'lib/bootstrap-modal-master/css/bootstrap-modal.css', 
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
			SOLDPRESS_PLUGIN_URL . 'lib/bootstrap-modal-master/css/bootstrap-modal.css', 
			array(), 
			'2.2', 
			'all' );		
			wp_enqueue_style( 'bootstrap-modal-master-style' );
		}
	}
	
	if($theme == "none")
	{
	
	}
	
	$load_jquery_prettyPhoto = get_option("sc-layout-jquery-prettyPhoto",true);
	
	if($load_jquery_prettyPhoto)
	{
		wp_register_style( 'jquery.prettyPhoto-style', 
		SOLDPRESS_PLUGIN_URL .'lib/jquery.prettyPhoto/css/prettyPhoto.css', 
		array(), 
		'2.1.5', 
		'all' );		
		wp_enqueue_style( 'jquery.prettyPhoto-style' );	
	}
		
	$load_flexslider = get_option("sc-layout-flexslider",true);
	if($load_flexslider)
	{	
		wp_register_style( 'jquery.flexsilder-style', 
		SOLDPRESS_PLUGIN_URL . 'lib/jquery.flexslider/flexslider.css', 
		array(), 
		'2.2.1', 
		'all' );	
		wp_enqueue_style( 'jquery.flexsilder-style' );
	}
	
	$load_bxslider = get_option("sc-layout-bxslider",true);
	if($load_bxslider)
	{	
		wp_register_style( 'jquery.bxslider-style', 
		SOLDPRESS_PLUGIN_URL . 'lib/jquery.bxslider/jquery.bxslider.css', 
		array(), 
		'4.1.1', 
		'all' );	
		wp_enqueue_style( 'jquery.bxslider-style' );
	}
	
	$load_font_awesome = get_option("sc-layout-font-awesome",true);
	if($load_font_awesome)
	{
		wp_register_style( 'font-awesome-style', 
		SOLDPRESS_PLUGIN_URL . 'lib/font-awesome/css/font-awesome.min.css', 
		array(), 
		'4.0.1.', 
		'all' );	
		wp_enqueue_style( 'font-awesome-style' );	
		 
		wp_enqueue_style('ie7-style', SOLDPRESS_PLUGIN_URL .'lib/font-awesome/css/font-awesome-ie7.min.css');
		global $wp_styles;
		$wp_styles->add_data('ie7-style', 'conditional', 'lte IE 7');
	}
	

	$load_sanskript_soldpress = get_option("sc-layout-sanskript-soldpress ",true);
	if($load_sanskript_soldpress)
	{	
		wp_register_style( 'soldpress-style', 
		SOLDPRESS_PLUGIN_URL .'style/soldpress.css', 
		array(), 
		'1.3.0', 
		'all' );
			
		wp_enqueue_style( 'soldpress-style' );
	}
}

add_action('wp_enqueue_scripts', 'sp_only_styles');

}
?>
