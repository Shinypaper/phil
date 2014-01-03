<?php
/**
 * @author 		Sanskript Solutions, Inc.
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $active_tab
?>
<div class="sp">
	<div class="properties">
		<div class="featured-item-wrapper featured-item-list">
			<div class="row-fluid">
			<?php soldpress_template_property_archive_slide_loop();	?>		
			</div>
		</div>
	</div>
</div>

