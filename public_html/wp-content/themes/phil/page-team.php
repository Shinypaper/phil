<?php 
	// Template Name: Team Page
get_header(); ?>

		<div class="main">
			<header class="page_banner">
				<figure>
					<img src="http://placehold.it/1200x400/eeeeee/eeeeee" alt="">
				</figure>
			</header>
			<div class="wrapper">
				<div class="wrapper_inner">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="<?php post_class(); ?>">
							<h2 class="post_title"><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

					<article class="team_members">
						<div class="row">
							<div class="col-md-4 team_member">
								<figure>
									<img src="http://placehold.it/500/ccc" alt="">
								</figure>
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
							<div class="col-md-4 team_member">
								<figure>
									<img src="http://placehold.it/500/ccc" alt="">
								</figure>
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
							<div class="col-md-4 team_member">
								<figure>
									<img src="http://placehold.it/500/ccc" alt="">
								</figure>
								<div>
									<h3>John Doe</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis.</p>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>

<?php get_footer(); ?>