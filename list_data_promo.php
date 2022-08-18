<?php
require_once('connection.php');

$month = date('m');
$year = date('Y');


$result = array();
$query = mysqli_query($CON,"SELECT * FROM list_promo where bulan=$month and tahun=$year");
while($row = mysqli_fetch_assoc($query)){
  $result[] = $row;
}

echo json_encode(array('result'=>$result));
?>
