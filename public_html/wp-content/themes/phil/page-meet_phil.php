<?php 
	// Template Name: Meet Phil
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
				<div class="main">
				
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
							<h2 class="page_title"><?php the_title(); ?></h2>
							<div class="profile-wrap">
								<div class="profile">
									<figure class="profile-image">
										<img src="http://img06.taobaocdn.com/bao/uploaded/i6/T1aabwXcddXXXSdo.1_042645.jpg" alt="">
									</figure>
									
									<div class="profile-text">
										<?php the_content(); ?>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis reiciendis quisquam omnis eaque sequi enim recusandae cupiditate consequatur laudantium esse vitae labore maxime eius deserunt hic tempora ex consectetur laborum qui est nostrum. Dolorum at aut recusandae sapiente eaque. Commodi, excepturi molestias sint a assumenda dicta harum fugit qui hic quis quibusdam vitae rem voluptates aut perspiciatis dolorum eaque! Expedita, quisquam, doloremque soluta culpa ipsa fugiat atque quia eum est alias! Tempore, reiciendis, nostrum dicta voluptas animi nulla aliquam? Error, provident quisquam ab tempora iusto.</p>
										<a href="<?php bloginfo('url'); ?>/phils-team" class="btn btn-primary">Meet the team</a>
									</div>
								</div>
							</div>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
			</div>
		</div>

<?php get_footer(); ?>