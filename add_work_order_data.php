<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
    $serverName = "127.0.0.1,5000";
    $connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
    $conn = sqlsrv_connect( $serverName, $connectionInfo );
    if( $conn == false ) {
        die( print_r( sqlsrv_errors(), true));
    }


    $code_wo = "";
    $code_dept_wo_request = "";
    $user_wo_create = "";
    $jenis_wo = "";
    $skala = "";
    $wo_request = "";
    $image_location= "";
    $code_maintenance = "";
    $code_barang = "";
    $note="";
    $code_wo_detail = "";

    if (isset($_POST['wo_request'])) {
        $wo_request = $_POST['wo_request'];
    }

    if (isset($_POST['image_location'])) {
        $image_location = $_POST['image_location'];
    }
    if (isset($_POST['code_maintenance'])) {
        $code_maintenance = $_POST['code_maintenance'];
    }
    if (isset($_POST['code_barang'])) {
        $code_barang = $_POST['code_barang'];
    }

    if (isset($_POST['note'])) {
        $note = $_POST['note'];
    }

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

    if (isset($_POST['code_wo_detail'])) {
        $code_wo_detail = $_POST['code_wo_detail'];
    }

    $date = date("m-d-Y");




    $date = new DateTime();


    $daterecord = $date->format('Y-m-d H:i:s');





    $sql1 = "INSERT INTO table_wo(no,code_wo,code_dept_wo_request,date_wo_start,user_wo_create,status,jenis_wo,skala) VALUES (?, ?,?,?,?,?,?,?); 
INSERT INTO table_wo_detail(no,code_wo_detail,code_wo,wo_request,status,image_location) VALUES (?,?,?,?,?,?); 
INSERT INTO table_maintenace(no,code_maintenance, code_barang,status,note,user_maintenance_create, code_wo_detail) VALUES (?, ?,?,?,?,?,?);";
    $params1 = array(111,"$code_wo", "$code_dept_wo_request", "$daterecord", "$user_wo_create", "create", "$jenis_wo", "$skala",
        111,"$code_wo_detail", "$code_wo", "$wo_request", "create", $image_location,
        111,"$code_maintenance", "$code_barang", "create", "$note","$user_wo_create","$code_wo_detail" );

    $stmt1 = sqlsrv_query($conn, $sql1, $params1);
    echo json_encode(array('message'=>'data successfully updated.'));





}
?>