<?php 

// Template Name: Search Page

get_header(); ?>

		<div class="container">
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
						<div class="search_content">
							<div class="search_form"><?php the_content(); ?></div>
							<div class="search_map">
								<?php echo do_shortcode(' [soldpress-map]' ); ?>
							</div>
						</div>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>