<?php 
	// Template Name: Meet Phil
get_header(); ?>

		<div class="main">
			<header class="banner">
				<figure>
					<img src="http://placehold.it/1200x400/eeeeee/eeeeee" alt="">
				</figure>
			</header>
			<div class="wrapper">
				<div class="wrapper_inner">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="<?php post_class(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>

					<article>
						<div class="row">
							
							<figure class="col-md-6">
								<img src="http://placehold.it/500/ccc" alt="">
							</figure>
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, autem, totam, animi beatae alias perspiciatis fugiat impedit atque ea placeat dolorum in illum perferendis reiciendis quisquam omnis eaque sequi enim recusandae cupiditate consequatur laudantium esse vitae labore maxime eius deserunt hic tempora ex consectetur laborum qui est nostrum. Dolorum at aut recusandae sapiente eaque. Commodi, excepturi molestias sint a assumenda dicta harum fugit qui hic quis quibusdam vitae rem voluptates aut perspiciatis dolorum eaque! Expedita, quisquam, doloremque soluta culpa ipsa fugiat atque quia eum est alias! Tempore, reiciendis, nostrum dicta voluptas animi nulla aliquam? Error, provident quisquam ab tempora iusto.</p>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>

<?php get_footer(); ?>