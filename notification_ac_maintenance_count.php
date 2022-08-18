<?php
require_once('connection.php');



$result = array();


$date = new DateTime();


	$daterecord=$date->format('Y-m-d');
	$date->add(new DateInterval('P2W'));
	$changedate=$date->format('Y-m-d');
	$query = mysqli_query($CON,"SELECT COUNT(room_number) AS jumlah_urgent FROM ac_room_maintenance WHERE date_next_maintenance < '$changedate' ORDER BY room_number");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;}
echo json_encode(array('result'=>$result));




?>
??>