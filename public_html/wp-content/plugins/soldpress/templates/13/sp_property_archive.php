<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="soldpress" class="sp sp-reset <?php echo sp_responsive_css_container(); ?>">
<?php include_once(SOLDPRESS_TEMPLATE_DIR.'/archive-filter.php');?>	
		 <?php if ( have_posts() ) : ?>		
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<?php if(get_option('sc-layout-propertylistings-grid','full-width') == 'sidebar-left'){ ?> 
					<div class="span3">	
						<?php soldpress_template_property_archive_content_aside();?>		
					</div>
					<div class="span9">								
						<?php soldpress_template_property_archive_content_main();?>		
					</div>						
				<?php }?>
				<?php if(get_option('sc-layout-propertylistings-grid','full-width')  == 'sidebar-right'){ ?> 
					<div class="span9">								
						<?php soldpress_template_property_archive_content_main();?>		
					</div>		
					<div class="span3">	
						<?php soldpress_template_property_archive_content_aside();?>		
					</div>
				<?php }?>
				<?php if(get_option('sc-layout-propertylistings-grid','full-width')  == 'full-width'){ ?> 			
					<div class="span12">								
						<?php soldpress_template_property_archive_content_main();?>	
					</div>	
				<?php }?>
			</div>
		 <?php else: ?>
			 <div id="content" role="main">
				<section class="<?php echo sp_responsive_css_container(); ?> properties well4">
					<div class="container-pad">
						<div class="<?php echo sp_responsive_css_row(); ?>">
							<p><?php _e('Sorry, no listings matched your criteria.','soldpress') ?></p>
						</div>
					</div>
				</section>
			</div>		
		<?php endif; ?>
	<?php soldpress_template_property_disclaimer();?>	
	<?php soldpress_template_property_footer();?>	
	<?php dynamic_sidebar('soldpress-sidebar-footer'); ?>		
</div>