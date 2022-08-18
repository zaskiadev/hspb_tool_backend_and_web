<?php
require_once('connection.php');
$date= date("m/d/Y");
$room_number = $_POST['room_number'];

$user= $_POST['user'];

$query = mysqli_query($CON, "UPDATE batery_kamar SET last_change_battery=now() WHERE no_kamar = '$room_number'");
if($query){
    echo json_encode(array('message'=>'data successfully updated.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

$query = mysqli_query($CON, "INSERT INTO log_change_battery VALUES ('$room_number',now(),'$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }




?>