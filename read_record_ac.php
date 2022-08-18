<?php
require_once('connection.php');

$filter_by="";

if(isset($_POST['filter_by'])){
$filter_by=$_POST['filter_by'];
}


$result = array();

if ($filter_by=="Sort By Room Number")
{
	$query = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number ORDER BY ac_room_maintenance.room_number ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Sort By Older Data")
{
	$query = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number ORDER BY ac_room_maintenance.date_next_maintenance");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Already Execute")
{

	$query = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number WHERE ac_room_maintenance.date_maintenance!='0000-00-00' ORDER BY ac_room_maintenance.room_number DESC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Never Execute")
{
	$query = mysqli_query($CON,"SELECT * FROM ac_room_maintenance where date_maintenance ='0000-00-00' ORDER BY room_number ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Urgent To Execute")
{
$date = new DateTime();


	$daterecord=$date->format('Y-m-d');
	$date->add(new DateInterval('P2W'));
	$changedate=$date->format('Y-m-d');
	$query = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number WHERE ac_room_maintenance.date_next_maintenance < '$changedate' ORDER BY  ac_room_maintenance.date_next_maintenance ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;}
echo json_encode(array('result'=>$result));
}
else
{
echo json_encode(array('result'=>$result));
}



?>
