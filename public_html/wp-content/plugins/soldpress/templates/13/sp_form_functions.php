<?php  
/**
 * @author 		Sanskript Solutions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sp_search_form_select($name, $search_field_name,$type = 'dfd_') 
{			  
?>
    <select id="<?php echo $search_field_name; ?>" name="<?php echo $search_field_name; ?>">
        <option value=""><?php _e('Any Option &raquo;', 'framework'); ?></option>
		<?php 
			global $wpdb;
				
			$query = "SELECT DISTINCT meta_value 
			FROM  $wpdb->postmeta pm 
			INNER JOIN  $wpdb->posts p ON p.ID = pm.post_id 
			WHERE pm.meta_key = '". $type . $name ."' AND p.post_status = 'publish'";
			
			$results = $wpdb->get_results($query);													
			foreach ($results as $result)
				{
					if ($result->meta_value == '')
						continue;																
					echo '<option value="'.htmlentities($result->meta_value).'">'.$result->meta_value.'</option> ';   
				}			
		  ?>
    </select>
    <?php
}


?>