<?php
require_once('connection.php');

$filter_by="";

if(isset($_POST['filter_by'])){
$filter_by=$_POST['filter_by'];
}


$result = array();

if ($filter_by=="Sort By Room Number")
{
	$query = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update ORDER BY keytag_update.no_kamar ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Sort By Older Data")
{
	$query = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update ORDER BY keytag_update.next_keytag_update ASC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Already Execute")
{

	$query = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update ORDER BY keytag_update.last_keytag_update DESC");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));
}
elseif ($filter_by=="Show Only Never Execute")
{
	$query = mysqli_query($CON,"SELECT * FROM keytag_update where last_keytag_update ='0000-00-00' ORDER BY no_kamar ASC");
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
	$query = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update AND where keytag_update.next_keytag_update < '$changedate' AND keytag_update.last_keytag_update !='0000-00-00' ORDER BY keytag_update.no_kamar ASC");
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