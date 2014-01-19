<?php
	// Template Name: Testimonials Page
get_header(); ?>

		<div class="main">
			<header class="banner">
				<figure>
					<img src="http://placehold.it/1200x400/eeeeee/eeeeee" alt="">
				</figure>
			</header>		
			<div class="wrapper">
				<div class="wrapper_inner">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="<?php post_class(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

<?php get_footer(); ?>