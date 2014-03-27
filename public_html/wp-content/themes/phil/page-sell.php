<?php 
	// Template Name: Sell Page
get_header(); ?>

<div class="container">
	<?php// get_template_part('banner') ?>	
	<div class="main">
	
		<div id="carousel-example-generic" class="carousel slide sell_carousel" data-ride="carousel" data-interval="false">

			<!-- Wrapper for slides -->
			
				
			<div class="carousel-inner">
				<?php $first = 1; ?>
					<?php if( have_rows('sell_content') ): ?>
						 
						<?php while( have_rows('sell_content') ): the_row(); 
					 
							// vars
							$icon = get_sub_field('icon');
							$content = get_sub_field('content');
					 
							?>
							<div class="item <?php echo $first? 'active': ''; ?>">
								<div class="carousel_row">
									<figure class="sell_icon">
										<i class="fa <?= $icon;?>"></i>
									</figure>
									<div class="sell_content">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php $first = 0; ?>

						<?php endwhile; ?>
					<?php endif; ?>
				<!-- Controls -->
			</div>				
			<a class="left content_left carousel_navigation" href="#carousel-example-generic" data-slide="prev">
				<span><i class="fa fa-chevron-left"></i></span>
			</a>
			<a class="right content_right carousel_navigation" href="#carousel-example-generic" data-slide="next">
				<span><i class="fa fa-chevron-right"></i></span>
			</a>
		</div>		
		<a href="<?php bloginfo('url'); ?>/contact" class="btn btn-primary sell_contact">Contact Me</a>
	</div>
</div>


<?php get_footer(); ?>

