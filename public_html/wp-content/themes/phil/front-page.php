<?php get_header(); ?>

	<section class="main homepage_main">
		<?php $background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );?>
		 <input class="backgroundimage" type="hidden" value="<?=$background[0]; ?>">
		<div class="home_banner">
			<figure>
				<!-- <img class="banner_img" src="<?php bloginfo('template_url'); ?>/assets/img/AURA75_LIVINGREZ.jpg" alt=""> -->
			</figure>
			<div class="call_to_action">
				<div class="wrapper">
					<a href="#" class="action_link"><i class="fa fa-angle-double-right"></i></a>
					
					<section class="main_links">
							
						<div class="links_wrap">
							<div class="link"><img src="http://placehold.it/200x100&text=Buy" alt=""></div>
							<div class="link"><img src="http://placehold.it/200x100&text=Sell" alt=""></div>
							<div class="link"><img src="http://placehold.it/200x100&text=Contact" alt=""></div>
						</div>

					</section>

				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>