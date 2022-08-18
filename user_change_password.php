<?php
require_once('connection.php');

$user="";
$new_password="";

if(isset($_POST['user'])){
$user=$_POST['user'];
}
else
{
}

if(isset($_POST['new_password'])){
$new_password=$_POST['new_password'];
}
else
{
}



$query = mysqli_query($CON, "UPDATE user SET password='$new_password' WHERE user = '$user' ");

if($query){
    echo json_encode(array('message'=>'data successfully updated.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }

?>