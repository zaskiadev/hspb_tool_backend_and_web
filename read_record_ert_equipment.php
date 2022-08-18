<?php
require_once('connection.php');


	$query = mysqli_query($CON,"SELECT * from ert_equipment ORDER BY date_checking");
	while($row = mysqli_fetch_assoc($query)){
  	$result[] = $row;
	}
echo json_encode(array('result'=>$result));



?>
