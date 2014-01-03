<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

$wp_upload_dir = wp_upload_dir();
$log_file = $wp_upload_dir['basedir'] . '/soldpress/soldpress-log-id.txt';	
$base_url = $wp_upload_dir['baseurl'];
$log_url = $wp_upload_dir['baseurl'] . '/soldpress/soldpress-log-id.txt';						
$fp = fopen($log_file, 'r');
$rooms;
while ( !feof($fp) )
{
    $line = fgets($fp, 2048);
	if($line != '')
	{
		$delimiter = " ";
		$data = str_getcsv($line, $delimiter);
		
	}
	if(count($data) > 2){
	$rooms[] = $data;
	}
}                

//var_dump($rooms);              
fclose($fp);
?>

<a href="<?php echo $log_url?>" target="_blank">soldpress-log-id.txt</a>
<table>
<?php
foreach($rooms  as &$room){
	 echo "<tr>";
	 echo "<td>". $room[0] . "</td>";	
	 echo "<td>". $room[1]. "</td>";	;
	 echo "<td><a href='".$base_url ."/soldpress/logs/soldpress-log-". $room[2] .".txt' >" . $room[2]. "</a></td>";	
	 echo "</tr>";
}
?>


</table>