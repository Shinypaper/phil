<?php

add_action( 'in_admin_footer', 'sp_admin_footer' );
	
function sp_admin_footer() {
	$plugin_data = get_plugin_data( SOLDPRESS_FILE );
	printf('%1$s ' . __("", 'SoldPress') .' | ' . __("Version", 'SoldPress') . ' %2$s | '. __('', 'SoldPress') . ' %3$s | <a href="http://support.sanskript.com/customer/portal/emails/new">Support<a/> <br />', $plugin_data['Title'], SOLDPRESS_PRODUCT_VERSION , $plugin_data['Author']);
}

?>