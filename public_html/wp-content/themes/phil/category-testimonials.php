<?php
	// Template Name: Testimonials Page
get_header(); ?>

		<div class="main">
			<header class="banner">
				<figure>
					<img src="http://placehold.it/1200x400/eeeeee/eeeeee" alt="">
				</figure>
			</header>		
			<div class="wrapper">
				<div class="wrapper_inner">
					<h2 class="page_title">Testimonials</h2>
					<section class="testimonials_posts">
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
				</div>
			</div>
		</div>

<?php get_footer(); ?>