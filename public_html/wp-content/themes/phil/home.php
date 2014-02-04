<?php get_header(); ?>

		<div class="main">
			<?php get_template_part('banner') ?>

			<div class="wrapper">
				<div class="wrapper_inner">
					<h2 class="page_title">Blog</h2>
					<div class="blogwrap">
						<section class="main_blog">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
								</article>
							<?php endwhile; else: ?>
							<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							<?php endif; ?>
						</section>
						<?php get_template_part('blog-sidebar') ?>
					</div>
				</div>
			</div>
		</div>
<?php get_footer(); ?>