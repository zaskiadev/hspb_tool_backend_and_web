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


if($method == 'POST')
{

    $item_name="";

    if(isset($_POST['item_name'])){
        $item_name=$_POST['item_name'];
    }


    $sql = "SELECT code_barang, nama_barang, location, dept_code from table_barang where nama_barang LIKE '%$item_name%' ORDER BY nama_barang DESC";

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
