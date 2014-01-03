<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once(dirname(__FILE__).'/theme.php');
include_once(dirname(__FILE__).'/sp_functions.php');

$active_tab = isset( $_GET[ 'type' ] ) ? $_GET[ 'type' ] : 'grid'; 

?>

<?php if(get_option('sc-layout-header',false) == false){ get_header(); } ?>	
<div id="soldpress" class="sp sp-reset <?php echo sp_responsive_css_container(); ?>">
	
<?php include_once(dirname(__FILE__).'/archive-filter.php');?>	
		 <?php if ( have_posts() ) : ?>		
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<?php if(get_option('sc-layout-propertylistings-grid','full-width') == 'sidebar-left'){ ?> 
					<div class="span3">	
						<?php include_once(dirname(__FILE__).'/section/sp_property_main_aside_archive.php');?>		
					</div>
					<div class="span9">								
						<?php include_once(dirname(__FILE__).'/section/sp_property_main_section_archive.php');?>		
					</div>						
				<?php }?>
				<?php if(get_option('sc-layout-propertylistings-grid','full-width')  == 'sidebar-right'){ ?> 
					<div class="span9">								
						<?php include_once(dirname(__FILE__).'/section/sp_property_main_section_archive.php');?>		
					</div>		
					<div class="span3">	
						<?php include_once(dirname(__FILE__).'/section/sp_property_main_aside_archive.php');?>		
					</div>
				<?php }?>
				<?php if(get_option('sc-layout-propertylistings-grid','full-width')  == 'full-width'){ ?> 			
					<div class="span12">								
						<?php include_once(dirname(__FILE__).'/section/sp_property_main_section_archive.php')?>	
					</div>	
				<?php }?>
			</div>
		 <?php else: ?>
			 <div id="content" role="main">
				<section class="<?php echo sp_responsive_css_container(); ?> properties well4">
					<div class="container-pad">
						<div class="<?php echo sp_responsive_css_row(); ?>">
							<p>Sorry, no listings matched your criteria</p>
						</div>
					</div>
				</section>
			</div>		
		<?php endif; ?>
		<?php include_once(dirname(__FILE__).'/disclaimer.php');?>			
<?php include_once(dirname(__FILE__).'/sp_property_footer.php');?>		
</div>

<?php if(get_option('sc-layout-header',false) == false){ get_footer(); } ?>	