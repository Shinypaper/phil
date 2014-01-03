<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	include_once(dirname(__FILE__).'/theme.php');
	include_once(dirname(__FILE__).'/sp_functions.php');
		
			function sp_analytics() 
			{
				echo '<meta name="soldpress" content="'. SOLDPRESS_PRODUCT_VERSION .'" />'. PHP_EOL;	
				
				global $post;
				if(get_option( 'sc-layout-analytics',false)){
				
					$s = get_post_meta($post->ID,'dfd_AnalyticsView',true);
					$s = str_replace("<![CDATA[","",$s);
					$s = str_replace("]]>","",$s);
					echo $s;
					
					$s = get_post_meta($post->ID,'dfd_AnalyticsClick',true);
					$s = str_replace("<![CDATA[","",$s);
					$s = str_replace("]]>","",$s);
					echo $s;							
									
				}
						
				$address = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
				
				echo '<meta name="description" content="' . get_post_meta($post->ID,'dfd_PublicRemarks',true) . '" />'. PHP_EOL;		
				echo '<meta name="keywords" content="'. $address .'" />'. PHP_EOL;	

				$image_url= sp_get_default_listing_image($post->ID);
				
				if(get_option("sc-layout-facebook-og",1) == 1)
				{							
					echo '<meta property="og:title" content="' . get_the_title().'" />'. PHP_EOL;			
					echo '<meta property="og:type" content="website" />'. PHP_EOL;
					echo '<meta property="og:url" content="'. get_permalink() .'" />'. PHP_EOL;
					echo '<meta property="og:image" content="' .  $image_url . '" />'. PHP_EOL;	
					echo '<meta property="og:description" content="' .  get_post_meta($post->ID,'dfd_PublicRemarks',true) . '" />'. PHP_EOL;
				}
			}
			
			add_action('wp_head', 'sp_analytics');
					
			$syncxml = get_post_meta($post->ID,'dfd_xml',true); 	
			
			if($syncxml != '')
			{
				$xml = simplexml_load_string($syncxml,"SimpleXMLElement", LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOWARNING); 
			}
			
			include_once(dirname(__FILE__).'/sp_property_section.php');		
	?>
		
<?php if(get_option('sc-layout-header',false) == false){ get_header(); } ?>	
<div id="soldpress" class="sp sp-reset <?php echo sp_responsive_css_container(); ?>">	
	<?php dynamic_sidebar('soldpress-sidebar-heading'); ?>
	<h1><?php the_title(); ?></h1>	
	<div class="well2">
		<?php include_once(dirname(__FILE__).'/single-slideshow.php');?>	
		<div class="well3">
			<div class="<?php echo sp_responsive_css_row(); ?>">
				<div class="span6">MLS®: <?php echo get_post_meta($post->ID,'dfd_ListingId',true); ?>  
				<?php if(get_option( 'sc-layout-analytics',false)){
						if(get_post_meta( 'dfd_MoreInformationLink',true) != ""){
						?>					
					<a class="btn" target="_blank" href="<?php echo get_post_meta($post->ID,'dfd_MoreInformationLink',true); ?> " >
						<i class="icon-external-link"></i>
					</a> 
				<?php 
					}
				} ?>
				</div>	
				
				<div class="span6 pull-right">
					<span class="pull-right">
					
						<?php 

							if(isset($xml))
							{
								if(get_post_meta($post->ID,'dfd_ListPrice',true) == 0)
								{
									//Determin if there is a lease value
									$lease = sp_get_xml_single($xml,"/PropertyDetails/Lease");
									if(isset($lease))
									{
										echo '<strong>For Lease: $ ' . $lease . '</strong>';
									}
									else
									{
										//Nothing For Now
									}
								}
								else
								{
									echo '<strong>For Sale: $' . number_format(get_post_meta($post->ID,'dfd_ListPrice',true)) . '</strong>';	
								}
							}
							else
							{
								echo '<strong>For Sale: $' . number_format(get_post_meta($post->ID,'dfd_ListPrice',true)) . '</strong>';		
							}

						?> 		
						
					</span>
				</div>
			</div>					
		</div>
		<div class="<?php echo sp_responsive_css_row('visible-desktop'); ?>">
			<div class="span6">
				<?php
					$address = stripslashes(get_post_meta($post->ID,'dfd_UnparsedAddress',true) . ', ' . get_post_meta($post->ID,'dfd_City',true) . ', ' . get_post_meta($post->ID,'dfd_StateOrProvince',true). ' ' . get_post_meta($post->ID,'dfd_PostalCode',true));
					$host = $_SERVER['HTTP_HOST'];
					$message = 'Check out this great home on ' . $host . ' - ' . $address;
				?>	
				<div class="btn-group"> 
				  <a class="btn sp-social visible-desktop" id="sp-facebook" data-title="Facebook"  href="#" data-url="//www.facebook.com/sharer.php?u=<?php echo get_permalink()?>&amp;t=<?php echo $message?>" data-width="658" data-height="255"><i class="icon-facebook"></i></a>
				  <a class="btn sp-social" id="sp-twitter"  data-title="Twitter" href="#" data-url="//twitter.com/home/?status=<?php echo $message?> — <?php echo get_permalink()?>" data-width="500" data-height="250"><i class="icon-twitter"></i></a>
				  <a class="btn sp-social" id="sp-linkedin" data-title="LinedIn"  href="#" data-url="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink()?>&amp;title=<?php echo $message ?>" data-width="560" data-height="400"><i class="icon-linkedin"></i></a>
				 <a class="btn sp-social" id="sp-google-plus" data-title="Google+"  href="#" data-url="//plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php echo get_permalink() ?>" data-width="500" data-height="275"><i class="icon-google-plus"></i></a>				 
				<a class="btn sp-social " id="sp-pinterest" data-title="Pinterest" data-url="//pinterest.com/pin/create/button/" data-width="658" data-height="255" href="#"><i class="icon-pinterest"></i></a>
				</div>
			</div>
			<div class="span6 pull-right">		
				<div class="btn-group pull-right visible-desktop">
				<a class="btn" id="sp-print" href="#"><i class="icon-print"></i> Print this Page</a>
				</div>			
			</div>	
		</div>		
	</div>	
		
	<div class="<?php echo sp_responsive_css_container(); ?>">	
		<div class="<?php echo sp_responsive_css_row(); ?>">
			
			<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left') == 'sidebar-left'){ ?> 				
					
				<div class="span4">	
					<?php include_once(dirname(__FILE__).'/section/sp_property_main_aside.php');?>		
				</div>
				<div class="span8">								
					<?php include_once(dirname(__FILE__).'/section/sp_property_main_section.php');?>		
				</div>		
			<?php }?>
			<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left')  == 'sidebar-right'){ ?> 
				<div class="span8">								
					<?php include_once(dirname(__FILE__).'/section/sp_property_main_section.php');?>		
				</div>		
				<div class="span4">	
					<?php include_once(dirname(__FILE__).'/section/sp_property_main_aside.php');?>		
				</div>
			<?php }?>
			<?php if(get_option('sc-layout-propertydetails-grid','sidebar-left')  == 'full-width'){ ?> 			
				<div class="span12">								
					<?php include_once(dirname(__FILE__).'/section/sp_property_main_section.php')?>	
				</div>	
			<?php }?>						
		</div>
		<div class="row-fluid">			
			<div class=" span12">
				<p><small>Data Provided by <?php echo get_post_meta($post->ID,'dfd_ListAOR',true); ?></small></p>
				<p><small>Last Modified <?php echo get_post_meta($post->ID,'dfd_ModificationTimestamp',true); ?></small></p>
				<p><small>Listing Office : <?php echo get_post_meta($post->ID,'dfd_ListOfficeName',true); ?></small></p>				
			</div>
		</div>		
	</div>
	
<?php include_once(dirname(__FILE__).'/disclaimer.php');?>	
<?php include_once(dirname(__FILE__).'/sp_property_footer.php');?>		
<?php wp_reset_query(); ?>
</div>

<?php if(get_option('sc-layout-footer',false) == false){ get_footer(); } ?>	
