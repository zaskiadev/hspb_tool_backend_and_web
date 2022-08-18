<?php
require_once('connection.php');

$filter_by="";

if(isset($_POST['filter_by'])){
$filter_by=$_POST['filter_by'];
}


$result = array();

if ($filter_by=="Sort By Room Number")
{
	$query = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card ORDER BY tap_time_card.no_kamar ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Sort By Older Data")
{
	$query = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card ORDER BY tap_time_card.next_tap_time_card");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Already Execute")
{

	$query = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card ORDER BY tap_time_card.no_kamar DESC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Never Execute")
{
	$query = mysqli_query($CON,"SELECT * FROM tap_time_card where last_tap_time_card ='0000-00-00' ORDER BY no_kamar ASC");
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
	$query = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card AND next_tap_time_card < '$changedate' ORDER BY tap_time_card.no_kamar");
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