<?php get_header(); ?>

		<div class="main">
			<header class="banner">
				<figure>
					<img src="http://placehold.it/1200x400/eeeeee/eeeeee" alt="">
				</figure>
			</header>

			<div class="wrapper">
				<div class="wrapper_inner">
					<h2 class="page_title">Blog</h2>
					<section class="main_blog">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<article <?php post_class(); ?>>
								<?php if (has_post_thumbnail()) { ?>
									<figure><?php the_post_thumbnail(); ?></figure>
								<? } ?>
								<?php if (in_category('testimonials')) { ?>
									<h3>Testimonial:</h3>
								<? } ?>
								<h3 class="post_title"><?php the_title(); ?></h3>
								<small class="categories"><?php the_category(' | '); ?></small>
								<p><?php the_excerpt(); ?></p>
							</article>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						<?php endif; ?>
						<?//php dynamic_sidebar( 'blog-sidebar' ); ?>
					</section>
				</div>
			</div>
		</div>
<?php get_footer(); ?>