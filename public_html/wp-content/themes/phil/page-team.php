<?php 
	// Template Name: Team Page
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<div class="phil_team_wrapper">
					
					<div class="phil_team">
						<img src="<?php the_field('phil'); ?>" alt="" />
						<div class="phil_member_wrap">
							<h3>Phil</h3>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<article class="<?php post_class(); ?>">
										<?php the_content(); ?>
									</article>
								<?php endwhile;  ?>
								<?php endif; ?>
								
						</div>
					</div>

				</div>
 
				<article class="team_members">
					<div class="members-wrap">
	
					<?php if( have_rows('teammate') ): ?>
				 
				 
					<?php while( have_rows('teammate') ): the_row(); 
				 
						// vars
						$image = get_sub_field('image');
						$content = get_sub_field('text');
				 
						?>
						<div class="team_member">
							<figure>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
							</figure>
							<div class="member-wrap">
								<div>
									<?php echo $content; ?>
								</div>

							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
					</div>
				</article>
			</div>
		</div>

	

<?php get_footer(); ?>