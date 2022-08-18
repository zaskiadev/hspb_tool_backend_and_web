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
    $code_wo = "";
    $wo_request = "";
    $image_location= "";


    if (isset($_POST['code_wo'])) {
        $code_wo = $_POST['code_wo'];
    }

    if (isset($_POST['code_wo_detail'])) {
        $code_wo_detail = $_POST['code_wo_detail'];
    }


    if (isset($_POST['wo_request'])) {
        $wo_request = $_POST['wo_request'];
    }

    if (isset($_POST['image_location'])) {
        $image_location = $_POST['image_location'];
    }




    $sql = "INSERT INTO table_wo_detail(code_wo_detail,code_wo,wo_request,status,image_location) VALUES (?,?,?,?,?)";
    $params = array("$code_wo_detail", "$code_wo", "$wo_request", "create", $image_location);

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