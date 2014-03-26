<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php bloginfo('name'); ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>

		<script src="<?php bloginfo('template_url'); ?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<?php wp_head(); ?>
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	</head>

	<body <?php body_class(); ?>>
		<!--[if lt IE 7]>
				<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->
		<div id="content">
			<a href="#" id="show-nav">
				<i class="fa fa-bars"></i><?php if (is_front_page()) {?> MENU<? } ?>
			</a>
			<header class="masthead">
					<div class="logo">
						<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo_black.png" alt="Philip Stavrou"></a>
					</div>
			</header>
			<aside id="sidebar" class="sidebar">

				<?php wp_nav_menu( array('menu' => 'Primary Menu', 'container' => 'nav', 'container_class' => 'menu', 'menu_class' => 'nav') ); ?>
				<div class="featured_images_header">
					
					<p class="featured_title">Featured Listings</p>
					<div id="carousel-<?php echo $post->ID; ?>" class="carousel slide" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
								<?php // GET DATA FOR FEATURED LISTINGS

									$args = array(
								 		'post_type' => 'sp_property',
								 		'meta_key' => 'featured_listing',
								 		'meta_value' => '1'
								 	);
									$listings = get_posts( $args );
								
									$first = 1;

									foreach ($listings as $post) {
										setup_postdata($post);
										$sp_slideshow = array();

										$photosCount = get_post_meta($post->ID,'dfd_PhotosCount',true) ;					
										$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
										$wp_upload_dir = wp_upload_dir(); 
										$photoindex = $photosCount - 1;
										for ($i=0; $i<=$photoindex; $i++)
										{
											
											$filename      = get_post_meta($post->ID,'dfd_ListingKey',true) . '-' . $type . '-' . $i . '.jpg';
											$fileurl      = $wp_upload_dir['baseurl'] . '/soldpress/' . $filename;		
											$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;

											if(file_exists ($filepath))
											{						
												$sp_slideshow[]    = $fileurl;			
											}						
										}
										
									
										$images = array();

										$featured_image = sp_get_property_images();
										if( have_rows('custom_images') ):
										 
										 	// loop through the rows of data
										    while ( have_rows('custom_images') ) : the_row();
										 
										        // display a sub field value
										        $images[] = get_sub_field('custom_image');
										    endwhile;
										  
										endif; 

											if (count($featured_image) < 1 AND count($images) > 0 ) {
												$featured_image = $images;
											}
									if ($featured_image) {
								?>
									<div class="item <?=$first?'active':''; ?> nav_slider">
									<a href="<?= $post->guid?>"> <img itemprop="image" class="featured-listing-image" src="<?php echo $featured_image[0] ?>" /></a>
									</div>
								<?php $first = 0; ?>
							<? } ?>
							<? } ?>
							</div>
					</div>
				</div>
			</aside>
			<div class="page_image">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					if (is_page()) {
						$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
						if (!$feature_image) 
							$feature_image[0] = get_bloginfo('template_url')."/assets/img/home.jpg"; ?>
						<figure class="banner_img" style="background: url('<?php echo $feature_image[0]; ?>') no-repeat center center fixed; background-size: cover;"> </figure>

					<? } else {
						if ($feature_image) {
							break;
						}
						$frontpage_id = get_option('page_for_posts');
						$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $frontpage_id ), 'full'); 
						if (!$feature_image) {
							
							$feature_image[0] = get_bloginfo('template_url')."/assets/img/home.jpg";
						}
						?>
						<figure class="banner_img" style="background: url('<?php echo $feature_image[0]; ?>') no-repeat center center fixed; background-size: cover;"> </figure>

					<? }
				?>
				<?php endwhile; ?>
				<?php endif; ?>
			</div>