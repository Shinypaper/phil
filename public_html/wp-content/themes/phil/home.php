<?php get_header(); ?>

		<div class="main">
			<div class="wrapper">
				<div class="wrapper_inner">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="<?php post_class(); ?>">
							<figure><?php the_post_thumbnail(); ?></figure>
							<h2><?php the_title(); ?></h2>
							<p><?php the_excerpt(); ?></p>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<?//php dynamic_sidebar( 'blog-sidebar' ); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>