<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	function sp_shortcode_listings_slide($atts, $content = null, $code = "") {	

		include_once(SOLDPRESS_TEMPLATE_DIR.'/sp_property_section.php');	
		
		global $wp_query;
		global $title;
		global $showposts;
		
		$defaults = array(			
			'type'     => 'grid',
			'before' => '',
			'after'  => '',
			'wrap'	 => 'div',
			'title' => '',
			'mode' => '',
			'width' => '540',
			'height' => '300',
			'showposts' => '12'
		  );
		  
		extract( shortcode_atts( $defaults, $atts ) );
		
		$shorcode = "sc";
		
		if(!empty($atts))
		{
			foreach ( $atts as $key =>  $val)
			{		
				if(strstr($key, 'dfd'))
				{
					$metaquery[] = array(
													'key' => $key,
													'value' => $val,
													'compare' => 'LIKE'
									);  
				}
			}
		}
		
		if(empty($metaquery))
		{
			$shorcode = "";
		}
		
				
		global $active_tab;	
		
		$active_tab = isset( $_GET[ 'type' ] ) ? $_GET[ 'type' ] : 'grid'; 	
				
		include(SOLDPRESS_TEMPLATE_DIR . '/archive-filter.php');
		
		global $post;

		ob_start();	
		
		if ( have_posts() ) 
		{	
			if($mode == 'tv')
			{
			echo '<div id="sp_tv"><div class="sp">
				<div class="properties">
				<div class="featured-item-wrapper featured-item-list">
				<div class="row-fluid">';
			?>
		
<script>		
		jQuery( document ).ready(function() {
			if(jQuery().bxSlider){
				jQuery('#prop_bxslider_tv').bxSlider({
						minSlides: 2,
						maxSlides: 2,
						adaptiveHeight: false,
						slideWidth: <?php echo $width ?>,
						slideMargin: 5,
						moveSlides:2,
						useCSS: true,
						auto: true,
						autoControls: false,
						pager:false,
						pause:7000,
						speed:1000,
						controls:false,
				});
		
			}
		});
		
	</script>	
<style>
.sp .properties .listing figure {height: <?php echo $height ?>px;}
body
{
background-color:black;
}
</style>	
			<ul id="prop_bxslider_tv" class="bxslider" style="margin: 0 0 0px 0px">	
				<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<div class="<?php echo 'span12'; ?> listing-wrapper">	
						<div class="listing">
								<div class="top">
									<div class="inner-border">
										<div class="inner-padding">
											<figure>
											 <?php if(get_post_meta($post->ID,'sc-sync-picture-agent',true) != ''){
													if(get_post_meta($post->ID,'sc-sync-picture-agent-file-LargePhoto',true) != ''){ ?> 
													<img src="<?php $wp_upload_dir = wp_upload_dir();  echo $wp_upload_dir['baseurl'] .'/soldpress/'. get_post_meta($post->ID,'sc-sync-picture-agent-file-LargePhoto',true); ?>">
												<?php }}?>
												<div class="banner"> <?php _e('Listing Agent','soldpress') ?></div>
											</figure>
												<h3>
												<?php echo get_post_meta($post->ID,'dfd_ListOfficeName',true); ?>
												</h3>
												<p>
												<?php echo get_post_meta($post->ID,'dfd_ListOfficePhone',true); ?>
												</p>
										</div>
									</div>
										
								</div>
								<div class="bottom">
									<div class="inner-border">
										<div class="inner-padding">
										       <h2>	
                                                                           <p>
											<?php echo get_post_meta($post->ID,'dfd_ListAgentFullName',true); ?>
											</p>
                                                                           </h2> 
										</div>

 
									</div>
								</div>
								
							</div>
						</div>
				</li>
				<li> 
				<div class="<?php echo 'span12'; ?> listing-wrapper">	
							<div class="listing">
								<div class="top">
									<div class="inner-border">
										<div class="inner-padding">
											<figure>
											  <?php 
									echo '<a href="' . get_permalink() . '"><img alt="'. get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true) .'" src="' . sp_get_default_listing_image($post->post_excerpt) . '" /></a>';
									?>
											<?php if(get_post_meta($post->ID,'dfd_ListPrice',true) == 0) {?>
											<div class="banner"> <?php _e('For Rent','soldpress') ?></div>
											<?php } else { ?>
											<div class="banner"> <?php _e('For Sale','soldpress') ?></div>
											<?php } ?>
											</figure>

							<div class="price-wrapper" style="display: block;">			
								<h2><div class="price"><?php echo sp_get_the_property_price(get_the_ID())  ?></div></h2>				
							</div>





											<h3>
											<a href="<?php the_permalink(); ?>"> <?php echo get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true); ?></a>
											</h3>
											
											<p><?php echo esc_html( get_post_meta( get_the_ID(), 'dfd_City', true ) ); ?></p>











										</div>
									</div>	
								</div>
								<div class="bottom">



									<div class="inner-border">
										<div class="inner-padding">
                                                                            <h2>
											<p>
												<?php echo get_post_meta(get_the_ID(),'dfd_BedroomsTotal',true); ?> bedrooms + <?php echo get_post_meta(get_the_ID(),'dfd_BathroomsTotal',true); ?> bathrooms </p> </h2>
                                                                           
										</div>
									</div>
								</div>
							</div>
					</div>	
				</li>
				<?php endwhile; ?>
				</ul>
			
			<?php echo '</div></div></div></div></div>'; }
			else
			{
				soldpress_template_property_archive_slide_loop_shortcode();				
			}
		}
		else
		{
			echo apply_filters( 'soldpress_no_listings', 'Sorry, no listings matched your criteria' ) ;
		}
		
		$output_string = ob_get_contents();				
		ob_end_clean();			
		$output = sprintf( '<%4$s class="sp">%1$s%3$s%2$s</%4$s>', $before, $after, $output_string, $wrap );
		
		wp_reset_query();
		return $output;	

		
	}		

	add_shortcode("soldpress-slide", "sp_shortcode_listings_slide");
	
?>