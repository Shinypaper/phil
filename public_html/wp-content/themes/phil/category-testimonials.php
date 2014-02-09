<?php
	// Template Name: Testimonials Page
get_header(); ?>

		<div class="main">
			<?php get_template_part('banner') ?>	
			<div class="wrapper">
				<div class="wrapper_inner">
					<h2 class="page_title">Testimonials</h2>
					<div class="blogwrap">
						<section class="testimonials_posts main_blog">
							<?php $postlist = get_posts(array('category_name' => 'testimonials')); ?>
							<?php 
							if ($postlist):
							foreach ($postlist as $post):
							setup_postdata($post); ?>
								<article <?php post_class(); ?>>
									<h3 class="post_title"><?php the_title(); ?> -</h3>
									<?php the_content(); ?>
								</article>
							<?php endforeach; else: ?>
							<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							<?php endif; ?>
							<?php wp_reset_query(); ?>
						</section>
						<?php get_template_part('blog-sidebar') ?>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>