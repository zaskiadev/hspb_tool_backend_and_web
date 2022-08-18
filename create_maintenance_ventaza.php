<?php
require_once('connection.php');


$user="";
$room_number="";
$maintenance_type="";
$remark="";

if(isset($_POST['user'])){
$user=$_POST['user'];
}


if(isset($_POST['room_number'])){
$room_number=$_POST['room_number'];
}

if(isset($_POST['maintenance_type'])){
$maintenance_type=$_POST['maintenance_type'];
}

if(isset($_POST['remark'])){
$remark=$_POST['remark'];
}

$date= date("m-d-Y");


$date = new DateTime();


$daterecord=$date->format('Y-m-d H:i:s');






$query = mysqli_query($CON, "INSERT INTO ventaza_maintenance_record VALUES ('$room_number','$daterecord','$maintenance_type','$remark','$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }








?>