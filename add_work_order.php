<?php

$serverName = "127.0.0.1,5000";
$connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}
$method = $_SERVER['REQUEST_METHOD'];


if($method == 'POST') {
    $code_wo = "";
    $code_dept_wo_request = "";
    $user_wo_create = "";
    $jenis_wo = "";
    $skala = "";


    if (isset($_POST['code_wo'])) {
        $code_wo = $_POST['code_wo'];
    }

    if (isset($_POST['code_dept_wo_request'])) {
        $code_dept_wo_request = $_POST['code_dept_wo_request'];
    }


    if (isset($_POST['user_wo_create'])) {
        $user_wo_create = $_POST['user_wo_create'];
    }

    if (isset($_POST['jenis_wo'])) {
        $jenis_wo = $_POST['jenis_wo'];
    }

    if (isset($_POST['skala'])) {
        $skala = $_POST['skala'];
    }
    $date = date("m-d-Y");


    $date = new DateTime();


    $daterecord = $date->format('Y-m-d H:i:s');


    $sql = "INSERT INTO table_wo(code_wo,code_dept_wo_request,date_wo_start,user_wo_create,status,jenis_wo,skala) VALUES (?, ?,?,?,?,?,?)";
    $params = array("$code_wo", "$code_dept_wo_request", "$daterecord", "$user_wo_create", "create", "$jenis_wo", "$skala");

    $stmt = sqlsrv_query($conn, $sql, $params);

    if( $stmt == false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    else
    {

    }


}
?>