<?php 
	// Template Name: Contact
get_header(); ?>

<div class="container">
		<?php //get_template_part('banner') ?>
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article <?php post_class(); ?>>
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<section>
					<div class="contact_container">
						
						<div class="contactinfo">
							<h1>PHONE: 444-444-4444</h1>
							<h1>EMAIL: PHILIPSTAVROU@PHIL.COM</h1>
						</div>
					</div>
				</section>
			</div>
		</div>

<?php get_footer(); ?>