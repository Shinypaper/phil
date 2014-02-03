<?php 
	// Template Name: Sell Page
get_header(); ?>

		<div class="main">
			<?php get_template_part('banner') ?>	
			<div class="wrapper">
				<div class="wrapper_inner">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="<?php post_class(); ?>">
							<h2 class="page_title"><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<form method="POST" role="form">
						<legend>Get in touch</legend>
					
						<div class="form-group">
							<label for="">email</label>
							<input type="text" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">Message</label>
							<textarea class="form-control" id="" placeholder="Input field"></textarea>
						</div>
					
						
					
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
			</div>
		</div>

<?php get_footer(); ?>