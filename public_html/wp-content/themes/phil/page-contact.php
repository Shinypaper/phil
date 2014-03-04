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
							<div class="phone">
								<p>Phone</p>
								<h1>444-444-4444</h1>
							</div>
							<div class="email">
								<p>Email</p>
								<a href="mailto:philipstavrou@phil.com"><h1>philipstavrou@phil.com</h1></a>
							</div>
							<div class="address">
								<p>Address</p>
								<h1>1605-30 Harrison Garden Blvd Toronto ON M2N 7A9</h1>
							</div>
						</div>
					</div>
					<div class="social_buttons">
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-instagram"></i></a>
					</div>
				</section>

			</div>
		</div>

<?php get_footer(); ?>