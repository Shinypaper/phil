<?php
	// Template Name: Neighbourhoods Page
get_header(); ?>

		<div class="container">
			<div class="main">
			<img class="torontomap" src="<?=bloginfo('url')?>/wp-content/themes/phil//assets/img/torontomap.png" alt="">
				<h2 class="page_title">Neighbourhoods</h2>
				<div class="blogwrap">
					<section class="neighbourhoods_posts main_blog">
					
						<?php $descendants = get_categories(array('child_of' => 6)); ?>
						<?php foreach ($descendants as $child) { ?>
						<div class="post">
							<h1 class="post_title"><a href="<?= bloginfo('url'). "/category/neighbourhoods/" .$child->slug; ?>" class="neighbourhoods"> <?php echo $child->cat_name; ?></a></h1>
						</div>
							
						<?php } ?>
							
					</section>
					<?php get_template_part('blog-sidebar') ?>
				</div>
			</div>
		</div>


<?php get_footer(); ?>