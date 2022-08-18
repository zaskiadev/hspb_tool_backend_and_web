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
    $code_wo_detail = "";
    $note="";

    if (isset($_POST['code_wo'])) {
        $code_wo = $_POST['code_wo'];
    }

    if (isset($_POST['code_wo_detail'])) {
        $code_wo_detail = $_POST['code_wo_detail'];
    }

    $date = date("m-d-Y");




    $date = new DateTime();


    $daterecord = $date->format('Y-m-d H:i:s');





    $sql1 = "UPDATE table_maintenace SET 
                            status = ? , maintenance_date_finish= ?, note = ? 
			 WHERE code_wo_detail = ?;
			 UPDATE table_wo SET status = ? WHERE code_wo = ?;
            UPDATE table_wo_detail SET status=? where code_wo_detail= ?;";
    $params1 = array("finish","$daterecord","$note","$code_wo_detail","finish","$code_wo","finish","$code_wo_detail");

    $stmt1 = sqlsrv_query($conn, $sql1, $params1);
    echo json_encode(array('message'=>'data successfully updated.'));





}
?>