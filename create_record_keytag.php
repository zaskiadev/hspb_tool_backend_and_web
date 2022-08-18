<?php
require_once('connection.php');


$user="";
$room_number="";

if(isset($_POST['user'])){
$user=$_POST['user'];
}
else
{
}

if(isset($_POST['room_number'])){
$room_number=$_POST['room_number'];
}
else
{
}


$date= date("m-d-Y");


$date = new DateTime();


$daterecord=$date->format('Y-m-d');
$date->add(new DateInterval('P6M'));
$changedate=$date->format('Y-m-d');



// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($CON,"select * from keytag_update where no_kamar='$room_number'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){


$query = mysqli_query($CON, "UPDATE keytag_update SET last_keytag_update='$daterecord', next_keytag_update='$changedate' WHERE no_kamar = '$room_number'");

if($query){
    echo json_encode(array('message'=>'data successfully updated.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

$query = mysqli_query($CON, "INSERT INTO log_keytag_update VALUES ('$room_number','$daterecord','$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }
	
}else{


$query = mysqli_query($CON, "INSERT INTO keytag_update VALUES ('$room_number','$daterecord','$changedate')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

$query = mysqli_query($CON, "INSERT INTO log_keytag_update VALUES ('$room_number','$daterecord','$user')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to add.'));
  }


}




?>