<?php
require_once('connection.php');



$result = array();


$date = new DateTime();


	$daterecord=$date->format('Y-m-d');
	$date->add(new DateInterval('P2W'));
	$changedate=$date->format('Y-m-d');
	$query = mysqli_query($CON,"SELECT COUNT(no_kamar) AS jumlah_urgent FROM batery_kamar WHERE next_change_battery < '$changedate' ORDER BY no_kamar");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;}
echo json_encode(array('result'=>$result));




?>
??>