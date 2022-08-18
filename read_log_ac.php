<?php
require_once('connection.php');

$room_number="";



if(isset($_POST['room_number'])){
$room_number=$_POST['room_number'];
}


$result = array();

	$query = mysqli_query($CON,"SELECT * from log_ac_maintenance WHERE room_number='$room_number' ORDER BY date_maintenance DESC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}

echo json_encode(array('result'=>$result));



?>