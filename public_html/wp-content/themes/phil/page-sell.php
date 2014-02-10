<?php 
	// Template Name: Sell Page
get_header(); ?>

		<div class="container">
			<?php// get_template_part('banner') ?>	
			<div class="main">
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<form action="" method="POST" role="form">
					<legend>Contact Me</legend>
				
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" id="Name">
						<label for="">Telephone</label>
						<input type="text" class="form-control" id="Telephone">
						<label for="">Email Address</label>
						<input type="text" class="form-control" id="Email">
						<label for="">Message</label>
						<textarea class="form-control" id="Message"></textarea>
					</div>
										
			
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

				
			</div>
		</div>

<?php get_footer(); ?>