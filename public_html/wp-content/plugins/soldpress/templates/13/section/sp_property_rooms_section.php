<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */ 
//Architecture For Section Is Divide Into 2 Methods Data and Presentaion
function sp_get_room_data_reso()
{
	global $post;
	$rooms = array();
	for ($i=1; $i<=20; $i++)
	{	
		if(get_post_meta($post->ID,'dfd_RoomLevel' . $i ,true) != ''){
			$room = array(
			'RoomLevel' =>  get_post_meta($post->ID,'dfd_RoomLevel' . $i ,true),
			'RoomType' => get_post_meta($post->ID,'dfd_RoomType' . $i ,true),
			'RoomDimensions' => get_post_meta($post->ID,'dfd_RoomDimensions' . $i ,true),);
			$rooms[] = $room;
			
		 }
	}
	
	return $rooms;
}

function sp_get_room_data_xml()
{
	global $sp_property_xml;

	$rooms = array();
	$result = $sp_property_xml->xpath('/PropertyDetails/Building/Rooms/Room');
	
	foreach ((array)$result as $n) { 			
		$room = array(
			'RoomLevel' =>  $n->Level,
			'RoomType' => $n->Type,
			'RoomDimensions' => $n->Dimension,);
			$rooms[] = $room;
	}
	
	return $rooms;
}

function sp_get_rooms_section_xml(){

	global $sp_property_xml;
	
$rooms = sp_get_room_data_xml();

if($rooms){
		$caption = __('Rooms', 'soldpress');
		$table_start = '<div class="well3"><table class="table table-striped table-condensed "> <caption></caption><tbody>';	
		echo apply_filters('soldpress_table_room_template_start', $table_start, $caption )	;
		?>						 
					<tr>
						<th> <?php _e('Level', 'soldpress')?></th>
						<th> <?php _e('Type', 'soldpress')?></th>
						<th> <?php _e('Dimensions', 'soldpress')?></th>
					</tr>															
					<?php
						foreach($rooms  as &$room){
								 echo "<tr>";
								 echo "<td>" . $room['RoomLevel'] . "</td>";	
								 echo "<td>" . $room['RoomType']. "</td>";	;
								 echo "<td>". $room['RoomDimensions']. "</td>";	
								 echo "</tr>";
						}
					?>
<?php 
		$table_end = '</tbody></table></div>';
		echo apply_filters('soldpress_table_room_template_end', $table_end)	;
	}
}

function sp_get_rooms_section(){

$rooms = sp_get_room_data_reso();

if($rooms){
		$caption = __('Rooms', 'soldpress');
		$table_start = '<div class="well3"><table class="table table-striped table-condensed "> <caption></caption><tbody>';	
		echo apply_filters('soldpress_table_room_template_start', $table_start, $caption )	
		?>
					<tr>
						<th> <?php _e('Level', 'soldpress')?></th>
						<th> <?php _e('Type', 'soldpress')?></th>
						<th> <?php _e('Dimensions', 'soldpress')?></th>
					</tr>															
					<?php
						foreach($rooms  as &$room){
								 echo "<tr>";
								 echo "<td>" . $room['RoomLevel'] . "</td>";	
								 echo "<td>" . $room['RoomType']. "</td>";	;
								 echo "<td>". $room['RoomDimensions']. "</td>";	
								 echo "</tr>";
						}
					?>
<?php 
		$table_end = '</tbody></table></div>';
		echo apply_filters('soldpress_table_room_template_end', $table_end)	;
	}
}

function sp_get_rooms()
{
	global $sp_property_xml;
	
	if(isset($sp_property_xml))
	{
		sp_get_rooms_section_xml(); 				
	}
	else
	{
		sp_get_rooms_section();
	}

}

?>	
