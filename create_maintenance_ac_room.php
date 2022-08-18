<?php
require_once('connection.php');


$user="";
$room_number="";
$isRepairBrokenPart=0;
$isCleaningFilter=0;
$isBlower=0;
$isCoilEvavorator=0;
$isVacumDrain=0;
$isCheckingDuctingConnection=0;
$remark="";

if(isset($_POST['user'])){
$user=$_POST['user'];
}


if(isset($_POST['room_number'])){
$room_number=$_POST['room_number'];
}


if(isset($_POST['remark'])){
$remark=$_POST['remark'];
}

if(isset($_POST['isRepairBrokenPart'])){
$isRepairBrokenPart=$_POST['isRepairBrokenPart'];
}


if(isset($_POST['isCleaningFilter'])){
$isCleaningFilter=$_POST['isCleaningFilter'];
}

if(isset($_POST['isBlower'])){
$isBlower=$_POST['isBlower'];
}

if(isset($_POST['isCoilEvavorator'])){
$isCoilEvavorator=$_POST['isCoilEvavorator'];
}

if(isset($_POST['isVacumDrain'])){
$isVacumDrain=$_POST['isVacumDrain'];
}

if(isset($_POST['isCheckingDuctingConnection'])){
$isCheckingDuctingConnection=$_POST['isCheckingDuctingConnection'];
}

$date = new DateTime();



$daterecord=$date->format('Y-m-d H:i:s');
$date->add(new DateInterval('P3M'));
$changedate=$date->format('Y-m-d H:i:s');




// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($CON,"select * from ac_room_maintenance where room_number='$room_number'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){


$query = mysqli_query($CON, "UPDATE ac_room_maintenance SET date_maintenance='$daterecord', date_next_maintenance='$changedate' WHERE room_number = '$room_number'");

if($query){
    echo json_encode(array('message'=>'data successfully updated.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }


	
}else{


$query = mysqli_query($CON, "INSERT INTO ac_room_maintenance VALUES ('$room_number','$daterecord','$changedate')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }


}


$query = mysqli_query($CON, "INSERT INTO log_ac_maintenance VALUES ('$room_number','$daterecord','$isRepairBrokenPart','$isCleaningFilter','$isBlower','$isCoilEvavorator','$isVacumDrain','$isCheckingDuctingConnection','$user','$remark')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }





?>