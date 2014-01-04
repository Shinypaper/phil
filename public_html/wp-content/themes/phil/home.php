<?php get_header(); ?>

		<div class="main">
			<div class="wrapper">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_excerpt(); ?>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>