<?php
require_once('connection.php');


$user_name="";
$password="";
$email="";
$deptCode="";

if(isset($_POST['user_name'])){
$user_name=$_POST['user_name'];
}


if(isset($_POST['password'])){
$password=$_POST['password'];
}

if(isset($_POST['email'])){
$email=$_POST['email'];
}

if(isset($_POST['deptCode'])){
$deptCode=$_POST['deptCode'];
}


$query = mysqli_query($CON, "INSERT INTO temp_user_account VALUES ('$user_name','$password','$email','$deptCode')");

if($query){
    echo json_encode(array('message'=>'data successfully added.'));
  }else{
    echo json_encode(array('message'=>'data failed to update.'));
  }








?>