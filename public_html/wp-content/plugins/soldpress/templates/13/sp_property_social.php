<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="<?php echo sp_responsive_css_row('visible-desktop'); ?>">
	<div class="span6">
		<?php
			$message = 'Check out this great home on' . get_site_url() . ' - ' . soldpress_get_full_address();
		?>	
		<div class="btn-group"> 
		  <a class="btn sp-social visible-desktop" id="sp-facebook" data-title="Facebook"  href="#" data-url="//www.facebook.com/sharer.php?u=<?php echo get_permalink()?>&amp;t=<?php echo $message?>" data-width="658" data-height="255"><i class="fa fa-facebook"></i></a>
		  <a class="btn sp-social" id="sp-twitter"  data-title="Twitter" href="#" data-url="//twitter.com/home/?status=<?php echo $message?> — <?php echo get_permalink()?>" data-width="500" data-height="250"><i class="fa fa-twitter"></i></a>
		  <a class="btn sp-social" id="sp-linkedin" data-title="LinedIn"  href="#" data-url="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink()?>&amp;title=<?php echo $message ?>" data-width="560" data-height="400"><i class="fa fa-linkedin"></i></a>
		 <a class="btn sp-social" id="sp-google-plus" data-title="Google+"  href="#" data-url="//plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php echo get_permalink() ?>" data-width="500" data-height="275"><i class="fa fa-google-plus"></i></a>				 
		<a class="btn sp-social " id="sp-pinterest" data-title="Pinterest" data-url="//pinterest.com/pin/create/button/" data-width="658" data-height="255" href="#"><i class="fa fa-pinterest"></i></a>
		</div>
	</div>
	<div class="span6 pull-right">		
		<div class="btn-group pull-right visible-desktop">
		<a class="btn" id="sp-print" href="#"><i class="fa fa-print"></i><?php _e('Print this Page','soldpress');?> </a>
		</div>			
	</div>	
</div>