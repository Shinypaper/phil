<?php
/**
 * @author 		Sanskript Solutions, Inc.
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $active_tab
?>
<?php while ( have_posts() ) : the_post(); ?>		
<?php soldpress_template_property_archive_list();	?>		
<?php endwhile; ?>
