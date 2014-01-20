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
			<a href="#" id="show-navobile"><i class="fa fa-bars"></i></a>
			<header id="header" class="header">
				<h1>
					<div class="logo">
						<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt=""></a>
					</div>
				</h1>

				<?php wp_nav_menu( array('menu' => 'Primary Menu', 'container' => 'nav', 'container_class' => 'menu', 'menu_class' => 'nav') ); ?>

				

			</header>
