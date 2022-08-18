<?php
require_once('connection.php');


$user_create="";
$type_disaster="";
$apar=0;
$smoke_detector=0;
$heat_detector=0;
$sprinkle=0;
$hidran_pilar=0;
$switch_lift_automation=0;
$automation_lift_to_lg=0;
$note_checking="";

if(isset($_POST['user_create'])){
$user_create=$_POST['user_create'];
}


if(isset($_POST['type_disaster'])){
$type_disaster=$_POST['type_disaster'];
}


if(isset($_POST['apar'])){
$apar=$_POST['apar'];
}

if(isset($_POST['smoke_detector'])){
$smoke_detector=$_POST['smoke_detector'];
}


if(isset($_POST['sprinkle'])){
$sprinkle=$_POST['sprinkle'];
}

if(isset($_POST['switch_lift_automation'])){
$switch_lift_automation=$_POST['switch_lift_automation'];
}

if(isset($_POST['automation_lift_to_lg'])){
$automation_lift_to_lg=$_POST['automation_lift_to_lg'];
}

if(isset($_POST['note_checking'])){
$isVacumDrain=$_POST['note_checking'];
}


$date = new DateTime();

$daterecord=$date->format('Y-m-d H:i:s');
$date->add(new DateInterval('P3M'));
$changedate=$date->format('Y-m-d H:i:s');

$query = mysqli_query($CON, "INSERT INTO ert_equipment VALUES 
('$daterecord','$type_disaster','$apar','$smoke_detector','$heat_detector','$sprinkle','$hidran_pilar','$switch_lift_automation','$automation_lift_to_lg','$user_create','$note_checking')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }
?>