<?php 
	// Template Name: Featured Listings Page
get_header(); ?>

		<div class="container">
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
					 // check if the repeater field has rows of data
						$images = array();

						$featured_image = sp_get_property_images();
						if( have_rows('custom_images') ):
						 
						 	// loop through the rows of data
						    while ( have_rows('custom_images') ) : the_row();
						 
						        // display a sub field value
						        $images[] = get_sub_field('custom_image');
						    endwhile;
						  
						endif; 

							if (count($featured_image) < 1 AND count($images) > 0 ) {
								$featured_image = $images;
							}
				?>
					<article class="post <?php post_class(); ?>">
					<div class="featured_container">
						
						<div id="carousel-<?php echo $post->ID; ?>" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<?php 
								$first = 1;
								foreach ($featured_image as $sp_slideshowimage) { ?>
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
						<div class="featured_text">
							<h2 class="post_title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
							<?php the_content(); ?>
						</div>
					</div>
					</article>
					
				<?php } ?>
				<?php wp_reset_postdata(); ?>
				
			</div>
		</div>


<?php get_footer(); ?>