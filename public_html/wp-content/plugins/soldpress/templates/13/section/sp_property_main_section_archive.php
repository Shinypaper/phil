<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */
 
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
  
  global $title;
  global $active_tab;
  global $showposts;
?>
	<div class="<?php echo sp_responsive_css_container(); ?> properties well4">
		<div class="container-pad">
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<div class="search-bar">
					<div class="search-title">
						<div class="inner">
							<div class="pull-left custom-margin">
								<strong><?php echo $title ?></strong>
							</div>
							<div class="pull-right results-per-page custom-margin">
								<span class="text-line"><?php _e('Results per page','soldpress') ?>:</span>
								<ul>
									<li class="<?php echo $showposts == '12' ? 'active' : ''; ?>"><a href="<?php echo add_query_arg( 'showposts', '12',  $_SERVER['REQUEST_URI']) ?>" >12</a></li>
									<li>|</li>
									<li class="<?php echo $showposts == '24' ?  'active' : ''; ?>"><a href="<?php echo add_query_arg( 'showposts', '24',  $_SERVER['REQUEST_URI']) ?>">24</a></li>
									<li>|</li>
									<li class="<?php echo $showposts == '48' ?  'active' : ''; ?>"><a href="<?php echo add_query_arg( 'showposts', '48',  $_SERVER['REQUEST_URI']) ?>">48</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="search-bottom">
						<div class="inner">
							<div class="pull-right view-type custom-margin">
								<span class="text-line"><?php _e('View','soldpress') ?>:</span>
								<div class="btn-group">
								  <a href="<?php echo add_query_arg( 'type', 'grid',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="fa fa-th"></i></a>
								  <a href="<?php echo add_query_arg( 'type', 'list',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="fa fa-list"></i></a>
								  <a href="<?php echo add_query_arg( 'type', 'map',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="fa fa-map-marker"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<div class="featured-item-wrapper featured-item-list">						
					<?php 					
							 if( $active_tab == 'grid' ) { 
								soldpress_template_property_archive_grid();
							 }								 
							 if( $active_tab == 'list' ) { 
								soldpress_template_property_archive_list_loop();
							 }
							  if( $active_tab == 'map' ) { 
								soldpress_template_property_archive_map();
							 }
					?>
				</div>				
			</div>
			<div class="<?php echo sp_responsive_css_row(); ?>">
			
				<?php
				if(function_exists('wp_pagenavi')) 
				{
					wp_pagenavi();
				} 
				else 
				{ 
					numeric_posts_nav();
				}					
				 
				 ?>				

			</div>
		</div>
	</div>