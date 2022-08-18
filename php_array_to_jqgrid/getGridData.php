<?php 
require_once('connection.php');

$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 

if(!$sidx) $sidx =1; 

$result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM users"); 
$row = mysqli_fetch_array($result); 

$count = $row['count']; 
if( $count > 0 && $limit > 0) { 
    $total_pages = ceil($count/$limit); 
} else { 
    $total_pages = 0; 
} 
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
if($start <0) $start = 0; 

$SQL = "SELECT * FROM users ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysqli_query($conn, $SQL ) or die("Couldn't execute query.".mysqli_error($conn)); 

$i=0;
while($row = mysqli_fetch_array($result)) {
	$responce->rows[$i]['id']=$row['userId'];
	$responce->rows[$i]['cell']=array($row['userId'],$row['userName'],$row['firstName'],$row['lastName']);
	$i++;
}
echo json_encode($responce);
?>