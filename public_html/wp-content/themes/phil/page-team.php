<?php 
	// Template Name: Team Page
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
			<div class="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="<?php post_class(); ?>">
						<h2 class="page_title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</article>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<article class="team_members">
					<div class="members-wrap">
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/women/3.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>Jane Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/men/46.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
						<div class="team_member">
							<figure>
								<img src="http://api.randomuser.me/0.3/portraits/men/3.jpg" alt="">
							</figure>
							<div class="member-wrap">
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>

<?php get_footer(); ?>