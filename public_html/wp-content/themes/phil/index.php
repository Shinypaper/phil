<?php get_header(); ?>

		<div class="main">
			<div class="wrapper">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="post_title"><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>