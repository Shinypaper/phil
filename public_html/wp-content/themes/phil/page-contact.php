<?php 
	// Template Name: Contact
get_header(); ?>

<div class="main">
		<?php get_template_part('banner') ?>
			<div class="wrapper">
				<div class="wrapper_inner">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
							<h2 class="post_title"><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

					<article>
						<div class="row">
							
							<figure class="map" id="map">
							</figure>
							<div class="col-md-6">
								
								<div class="contactinfo">
									<h1></h1>
									<address> 453 Keas Str. <br>
									Toronto, ON <br>
									T: +30-6977664062 <br>
									F: +30-2106398905</address>
								</div>
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
					</article>
				</div>
			</div>
		</div>

<?php get_footer(); ?>