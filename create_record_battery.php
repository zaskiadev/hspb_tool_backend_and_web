<?php
require_once('connection.php');
$date= date("m-d-Y");
$room_number = $_POST['room_number'];

$date = new DateTime();


$daterecord=$date->format('Y-m-d');
$date->add(new DateInterval('P2M'));
$changedate=$date->format('Y-m-d');
$user= $_POST['user'];


// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($CON,"select * from batery_kamar where no_kamar='$room_number'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){


$query = mysqli_query($CON, "UPDATE batery_kamar SET last_change_battery='$daterecord', next_change_battery='$changedate' WHERE no_kamar = '$room_number'");

if($query){
    echo json_encode(array('message'=>'data successfully updated.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

$query = mysqli_query($CON, "INSERT INTO log_change_battery VALUES ('$room_number','$daterecord','$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }
	
}else{


$query = mysqli_query($CON, "INSERT INTO batery_kamar VALUES ('$room_number','$daterecord','$changedate','')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

$query = mysqli_query($CON, "INSERT INTO log_change_battery VALUES ('$room_number','$daterecord','$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }


}




?>