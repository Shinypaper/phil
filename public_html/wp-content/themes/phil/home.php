<?php get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>

			<div class="main">
				<h2 class="page_title">Blog</h2>
				<div class="blogwrap">
					<section class="main_blog">

						<?php 
						// the query
						$the_query = new WP_Query('post_type=post'); ?>

						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<article <?php post_class(); ?>>
								<?php if (in_category('testimonials')) { ?>
									<h3>Testimonial:</h3>
								<? } ?>
								<h3 class="post_title"><?php the_title(); ?></h3>
								<small class="categories"><?php the_category(' | '); ?></small>
								<?php if (has_post_thumbnail()) { ?>
									<figure><?php the_post_thumbnail(); ?></figure>
								<? } ?>
								<p><?php the_excerpt(); ?></p>
							</article><?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

						<?php else:  ?>
							<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
						<?php endif; ?>
					</section>
					<?php get_template_part('blog-sidebar') ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>