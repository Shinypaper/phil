<?php
/** 
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="soldpress" class="sp sp-reset <?php echo sp_responsive_css_container();?>" <?php echo sp_microdata("","","http://schema.org/Product")?>>
	 <div class="well4">	
		<?php dynamic_sidebar('soldpress-sidebar-heading'); ?>	
		<?php soldpress_template_property_header() ?>
		<?php soldpress_template_property_slideshow() ?>
		<div class="well3 visible-desktop">	
			<?php //soldpress_template_property_slideshow() ?>
			<?php // soldpress_template_property_heading() ?>
			<?php soldpress_template_property_social() ?>	
		</div>
		<div class="<?php echo sp_responsive_css_container(); ?>">	
			<div class="<?php echo sp_responsive_css_row(); ?>">			
				<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left') == 'sidebar-left'){ ?> 									
					<div class="span4">	
						<?php soldpress_template_property_single_content_aside();?>		
					</div>
					<div class="span8">								
						<?php soldpress_template_property_single_content_main() ;?>		
					</div>		
				<?php }?>
				<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left')  == 'sidebar-right'){ ?> 
					<div class="span8">								
						<?php soldpress_template_property_single_content_main() ;?>		
					</div>		
					<div class="span4">	
						<?php soldpress_template_property_single_content_aside();?>		
					</div>
				<?php }?>
				<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left')  == 'full-width'){ ?> 			
					<div class="span12">								
						<?php soldpress_template_property_single_content_main() ?>	
					</div>	
				<?php }?>						
			</div>
			<div class="<?php echo sp_responsive_css_row(); ?>">	
				<?php soldpress_template_property_mls_data_footer();?>	
			</div>		
		</div>	
	<?php soldpress_template_property_disclaimer();?>	
	<?php soldpress_template_property_footer();?>
	<div class="<?php echo sp_responsive_css_row(); ?>">		
	<?php dynamic_sidebar('soldpress-page-footer'); ?>	
	</div>		
	<?php wp_reset_query(); ?>
	</div>
</div>