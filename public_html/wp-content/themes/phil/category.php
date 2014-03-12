<?php

get_header(); ?>

		<div class="container">
			<div class="main">
				<h2 class="page_title"><?php single_cat_title(); ?></h2>
				<div class="blogwrap">
					
					<section class="testimonials_posts main_blog">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
							<article <?php post_class(); ?>>
								<h3 class="post_title"><?php the_title(); ?></h3>
								<?php the_content(); ?>
							</article>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</section>
					<?php get_template_part('blog-sidebar') ?>
				</div>
			</div>
		</div>

<?php get_footer(); ?>