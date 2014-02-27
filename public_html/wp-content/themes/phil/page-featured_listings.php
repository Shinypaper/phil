<?php 
	// Template Name: Featured Listings Page
get_header(); ?>

		<div class="container">
			<?php// get_template_part('banner') ?>
			<div class="main">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page_title"><?php the_title(); ?></h2>
					<?php the_content(); ?>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<?php // GET DATA FOR FEATURED LISTINGS

					$args = array(
				 		'post_type' => 'sp_property',
				 		'meta_key' => 'featured_listing',
				 		'meta_value' => '1'
				 	);
					$listings = get_posts( $args );
					
					foreach ($listings as $post) {
						setup_postdata($post);
						$sp_slideshow = array();

						$photosCount = get_post_meta($post->ID,'dfd_PhotosCount',true) ;					
						$type = get_option('sc-soldpress_photo_listing_q', 'LargePhoto');
						$wp_upload_dir = wp_upload_dir(); 
						$photoindex = $photosCount - 1;
						for ($i=0; $i<=$photoindex; $i++)
						{
							
							$filename      = get_post_meta($post->ID,'dfd_ListingKey',true) . '-' . $type . '-' . $i . '.jpg';
							$fileurl      = $wp_upload_dir['baseurl'] . '/soldpress/' . $filename;		
							$filepath     = $wp_upload_dir['basedir'] . '/soldpress/' . $filename;

							if(file_exists ($filepath))
							{						
								$sp_slideshow[]    = $fileurl;			
							}						
						}

				?>
					<article class="post <?php post_class(); ?>">

						<div id="carousel-<?php echo $post->ID; ?>" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<?php 
								$first = 1;
								foreach ($sp_slideshow as $sp_slideshowimage) { ?>
								<div class="item <?=$first?'active':''; ?>">
									<img itemprop="image" class="featured-listing-image" src="<?php echo $sp_slideshowimage ?>" />
								</div>
								<?php $first = 0; ?>
								<? } ?>
							</div>

							<!-- Controls -->
							<a class="left carousel-control" href="#carousel-<?php echo $post->ID; ?>" data-slide="prev">
								<span><i class="fa fa-chevron-left"></i></span>
							</a>
							<a class="right carousel-control" href="#carousel-<?php echo $post->ID; ?>" data-slide="next">
								<span><i class="fa fa-chevron-right"></i></span>
							</a>
						</div>

						<h2 class="post_title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
						<?php the_content(); ?>
					</article>
					
				<?php } ?>
				<?php wp_reset_postdata(); ?>
				
			</div>
		</div>

<?php get_footer(); ?>