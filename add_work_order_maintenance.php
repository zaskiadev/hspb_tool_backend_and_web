<?php

$serverName = "127.0.0.1,5000";
$connectionInfo = array( "Database"=>"working_order_hspb", "UID"=>"edpbintaro", "PWD"=>"sqledpbintaro123", "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}
$method = $_SERVER['REQUEST_METHOD'];


if($method == 'POST') {
    $code_wo_detail = "";
    $code_maintenance = "";
    $code_barang = "";
    $user_maintenance_create= "";
    $note="";


    if (isset($_POST['code_maintenance'])) {
        $code_maintenance = $_POST['code_maintenance'];
    }

    if (isset($_POST['code_wo_detail'])) {
        $code_wo_detail = $_POST['code_wo_detail'];
    }


    if (isset($_POST['code_barang'])) {
        $code_barang = $_POST['code_barang'];
    }

    if (isset($_POST['user_maintenance_create'])) {
        $user_maintenance_create = $_POST['user_maintenance_create'];
    }

    if (isset($_POST['note'])) {
        $note = $_POST['note'];
    }



    $sql = "INSERT INTO table_maintenace(code_maintenance, code_barang,status,note,user_maintenance_create, code_wo_detail) VALUES (?, ?,?,?,?,?)";
    $params = array("$code_maintenance", "$code_barang", "create", "$note","$user_maintenance_create","$code_wo_detail");

    $stmt = sqlsrv_query($conn, $sql, $params);

    if( $stmt == false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    else
    {
        echo json_encode(array('message'=>'data successfully updated.'));
    }


}
?>