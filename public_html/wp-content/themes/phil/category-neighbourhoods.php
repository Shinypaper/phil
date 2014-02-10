<?php
	// Template Name: Neighbourhoods Page
get_header(); ?>

		<div class="container">
			<?php// get_template_part('banner') ?>	
			<div class="main">
				<h2 class="page_title">Neighbourhoods</h2>
				<div class="blogwrap">
					<section class="neighbourhoods_posts main_blog">
						<?php $postlist = get_posts(array('category_name' => 'neighbourhoods')); ?>
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

<?php get_footer(); ?>