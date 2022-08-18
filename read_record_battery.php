<?php
require_once('connection.php');

$filter_by="";

if(isset($_POST['filter_by'])){
$filter_by=$_POST['filter_by'];
}


$result = array();

if ($filter_by=="Sort By Room Number")
{
	$query = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery ORDER BY batery_kamar.no_kamar");


	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Sort By Older Data")
{
	$query = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery ORDER BY batery_kamar.next_change_battery ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Already Execute")
{

	$query = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery ORDER BY batery_kamar.no_kamar ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Never Execute")
{
	$query = mysqli_query($CON,"SELECT * FROM batery_kamar where last_change_battery ='0000-00-00' ORDER BY no_kamar ASC");
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
	$query = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery AND next_change_battery < '$changedate' ORDER BY batery_kamar.no_kamar");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;}
echo json_encode(array('result'=>$result));
}
else
{
echo json_encode(array('result'=>$result));
}





?>
??>