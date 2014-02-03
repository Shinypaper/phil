<?php get_header(); ?>

		<div class="main">
			<?php get_template_part('banner') ?>

			<div class="wrapper">
				<h2 class="page_title"><?php the_title(); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h3 class="post_title"><?php the_title(); ?></h3>
						<p><?php the_content(); ?></p>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
			</div>
		</div>

<?php get_footer(); ?>