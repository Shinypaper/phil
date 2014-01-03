<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */
?>
<div id="content" role="main">
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
								<span class="text-line">Results per page:</span>
								<ul>
									<li class="<?php echo $showposts == '12' ? 'active' : ''; ?>"><a rel="nofollow" href="<?php echo add_query_arg( 'showposts', '12',  $_SERVER['REQUEST_URI']) ?>" >12</a></li>
									<li>|</li>
									<li class="<?php echo $showposts == '24' ?  'active' : ''; ?>"><a rel="nofollow" href="<?php echo add_query_arg( 'showposts', '24',  $_SERVER['REQUEST_URI']) ?>">24</a></li>
									<li>|</li>
									<li class="<?php echo $showposts == '48' ?  'active' : ''; ?>"><a  rel="nofollow" href="<?php echo add_query_arg( 'showposts', '48',  $_SERVER['REQUEST_URI']) ?>">48</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="search-bottom">
						<div class="inner">
							<div class="pull-right view-type custom-margin">
								<span class="text-line">View:</span>
								<div class="btn-group">
								  <a rel="nofollow" href="<?php echo add_query_arg( 'type', 'grid',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="icon-th"></i></a>
								  <a rel="nofollow" href="<?php echo add_query_arg( 'type', 'list',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="icon-list"></i></a>
								  <a  rel="nofollow" href="<?php echo add_query_arg( 'type', 'map',  $_SERVER['REQUEST_URI']) ?>" class="btn"><i class="icon-map-marker"></i></a>
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
								include(dirname(__FILE__).'/archive-grid.php');
							 }								 
							 if( $active_tab == 'list' ) { 
								include(dirname(__FILE__).'/archive-list.php');
							 }
							  if( $active_tab == 'map' ) { 
								include(dirname(__FILE__).'/archive-map.php');
							 }
					?>
				</div>				
			</div>
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<?php numeric_posts_nav(); ?>
			</div>
		</div>
	</div>
</div>