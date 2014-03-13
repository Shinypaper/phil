<?php 
	// Template Name: Meet Phil
get_header(); ?>

		<div class="container">
			<?php //get_template_part('banner') ?>
				<div class="main profile">
				
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
						<h2 class="page_title">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#team" data-toggle="tab"> <?php the_title(); ?></a></li>
								<li class="pull-right"><a href="#awards" data-toggle="tab">Awards</a></li>
							</ul>
						</h2>
						<div class="tab-content">
							<div class="tab-pane profile-text fade in active" id="team">
								<?php the_content(); ?>
								<a href="<?php bloginfo('url'); ?>/phils-team" class="btn btn-primary">Meet the team</a>
							</div>
							<div class="tab-pane profile-text fade in" id="awards">
								<?php the_field('awards'); ?>
							</div>
						</div>
						</article>
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
			</div>
		</div>

<?php get_footer(); ?>