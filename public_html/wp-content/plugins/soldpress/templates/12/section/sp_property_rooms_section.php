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

function sp_get_room_data_xml($xml)
{
	$rooms = array();
	$result = $xml->xpath('/PropertyDetails/Building/Rooms/Room');
	
	foreach ((array)$result as $n) { 			
		$room = array(
			'RoomLevel' =>  $n->Level,
			'RoomType' => $n->Type,
			'RoomDimensions' => $n->Dimension,);
			$rooms[] = $room;
	}
	
	return $rooms;
}

function sp_get_rooms_section_xml($xml){

$rooms = sp_get_room_data_xml($xml);

if($rooms){ ?> 
	<div class="well3">			
		<table class="table table-striped table-condensed ">
				 <caption>Rooms</caption>
				 <tbody>
					<tr>
						<th>Level</th>
						<th>Type</th>
						<th>Dimensions</th>
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
				</tbody>
		</table>	
	</div>
<?php }
}

function sp_get_rooms_section(){

$rooms = sp_get_room_data_reso();

if($rooms){ ?> 
	<div class="well3">			
		<table class="table table-striped table-condensed ">
				 <caption>Rooms</caption>
				 <tbody>
					<tr>
						<th>Level</th>
						<th>Type</th>
						<th>Dimensions</th>
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
				</tbody>
		</table>	
	</div>
<?php }
}
?>	
