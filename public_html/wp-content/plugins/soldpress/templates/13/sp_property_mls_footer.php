<div class="span12">
	<p>
	<small>
	<?php _e('Data Provided by','soldpress') ?><?php echo get_post_meta($post->ID,'dfd_ListAOR',true); ?>
	</small>
	</p>
	<p>
	<small>
	<?php _e('Last Modified','soldpress') ?>:<?php echo get_post_meta($post->ID,'dfd_ModificationTimestamp',true); ?></small>
	</p>
	<p>
	<small>
	<?php _e('Listing Office','soldpress') ?> :<?php echo get_post_meta($post->ID,'dfd_ListOfficeName',true); ?></small>
	</p>				
</div>