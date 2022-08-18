<?php

//fetch_data.php
$output[] = array();

$serverName = "127.0.0.1,5000";
$connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}
$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET')
{

  $sql = "SELECT TOP 1 code_maintenance from table_maintenace ORDER BY code_maintenance DESC";

  $stmt = sqlsrv_query( $conn, $sql );
  if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
  }

  while($result = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
   $output[]=$result;
  }
 header("Content-Type: application/json");
    echo json_encode(array('result'=>$output));
}



?>
