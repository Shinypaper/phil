<?php 
	// Template Name: Meet Phil
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
				<div class="main profile">
				
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
							<h2 class="page_title"><?php the_title(); ?></h2>
									
							<div class="profile-text">
								<?php the_content(); ?>
								<a href="<?php bloginfo('url'); ?>/phils-team" class="btn btn-primary">Meet the team</a>
							</div>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
			</div>
		</div>

<?php get_footer(); ?>