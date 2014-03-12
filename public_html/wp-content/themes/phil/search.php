<?php get_header(); ?>

		<div class="container">
			<?php get_template_part('banner') ?>	
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>