<?php
require_once('connection.php');

$filter_by="";
$room_number="";


$filter_by=$_POST['filter_by'];

$room_number=$_POST['room_number'];

$result = array();

if ($filter_by=="Change Battery")
{
	$query = mysqli_query($CON,"SELECT batery_kamar.no_kamar AS room_number, batery_kamar.last_change_battery AS last_date_executed, batery_kamar.next_change_battery AS next_date_executed, log_change_battery.user_change_battery AS user_execute FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery AND batery_kamar.no_kamar='$room_number' ORDER BY batery_kamar.last_change_battery ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}

echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Tap Time Card")
{
	$stringquery="SELECT tap_time_card.no_kamar AS room_number , tap_time_card.next_tap_time_card AS last_date_executed, tap_time_card.last_tap_time_card AS next_date_executed, log_tap_time_card.user AS user_execute FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card AND tap_time_card.no_kamar='$room_number' ORDER BY tap_time_card.last_tap_time_card ASC";
	$query = mysqli_query($CON,'$stringquery');
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo $stringquery;
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Maintenance Ventaza")
{

	$query = mysqli_query($CON,"SELECT * from ventaza_maintenance_record WHERE no_kamar='$room_number'");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
else
{
echo $room_number;
echo $filter_by;
}


?>