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


if($method == 'POST' || $method=='GET') {
$sql="";
$wo_code="";

    if (isset($_POST['wo_code'])) {
        $wo_code = $_POST['wo_code'];
    }
    if (isset($_GET['wo_code'])) {
        $wo_code = $_GET['wo_code'];
    }




            $sql="SELECT a.code_wo as code_wo, a.jenis_wo as jenis, a.skala as skala, b.dept_name as dept_name,e.nama_barang as nama_barang, e.location as location,c.wo_request as wo_minta ,c.image_location as image_location FROM table_wo as a 
  inner join table_dept as b on a.code_dept_wo_request=b.dept_code
  inner join table_wo_detail as c on a.code_wo=c.code_wo
  inner join table_maintenace as d on c.code_wo_detail=d.code_wo_detail
  inner join table_barang as e on d.code_barang=e.code_barang where a.code_wo='$wo_code'";

    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $output[] = $result;
    }
    header("Content-Type: application/json");
    echo json_encode(array('hasilnya' => $output));

}

?>
