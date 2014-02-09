<?php 
	// Template Name: Featured Listings Page
get_header(); ?>

		<div class="main">
			<?php get_template_part('banner') ?>
			<div class="wrapper">
				<div class="wrapper_inner">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<?php 

						$args = array(
					 		'post_type' => 'sp_property',
					 		'meta_key' => 'featured_listing',
					 		'meta_value' => '1'
					 	);
						$listings = get_posts( $args );
						
						foreach ($listings as $post) {
							setup_postdata($post);
							//print_r(get_post_meta($post->ID));
					?>
						<article class="post <?php post_class(); ?>">
							<?php $images = sp_get_property_images(); ?>
							<?php 
							foreach ($images as &$sp_slideshowimage) 
							{
								echo '<div class="flexslider sp-no-print"><ul class="thumbnails"><li class="thumbnail"><a href="' . $sp_slideshowimage . '" class="swipebox"><img itemprop="image" class="sp-gallery-image" src="' . $sp_slideshowimage . '" alt="'. $image_description .'" /></a></li></ul></div>';					
							} 
							?>
							<h2 class="post_title"><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
						
					<?php } ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

<?php get_footer(); ?>