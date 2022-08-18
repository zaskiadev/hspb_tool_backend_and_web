<?php
require_once('connection.php');



$result = array();


$date = new DateTime();


	$daterecord=$date->format('Y-m-d');
	$date->add(new DateInterval('P2W'));
	$changedate=$date->format('Y-m-d');
	$query = mysqli_query($CON,"SELECT no_kamar FROM tap_time_card WHERE next_tap_time_card < '$changedate' ORDER BY no_kamar");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;}
echo json_encode(array('result'=>$result));




?>
??>