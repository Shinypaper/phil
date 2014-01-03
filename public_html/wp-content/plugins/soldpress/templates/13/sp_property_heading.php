
<div class="well3">
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<div class="span6"><?php _e('MLS®','soldpress') ?>: <?php echo get_post_meta($post->ID,'dfd_ListingId',true); ?>  
				<?php if(get_option( 'sc-layout-analytics',false)){
				
						if(get_post_meta( 'dfd_MoreInformationLink',true) != ""){
						?>					
					<a class="btn" target="_blank" href="<?php echo get_post_meta($post->ID,'dfd_MoreInformationLink',true); ?> " >
						<i class="fa fa-external-link"></i>
					</a> 
				<?php 
					}
				} ?>
				</div>	
				
				<div id="sp_price" class="span6 pull-right">
					<span class="pull-right">				
						<?php 
							echo sp_get_property_price();
						?> 		
						
					</span>
				</div>
			</div>					
		</div>