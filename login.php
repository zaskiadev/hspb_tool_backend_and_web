<?php
require_once('connection.php');

$usr = $_POST['user'];

$pas = $_POST['pass'];

$query = mysqli_query($CON,"SELECT * FROM user where user='$usr' and password='$pas'");

$cek = mysqli_num_rows($query);
 
if($cek > 0)
{
	echo json_encode(array('message'=>'login successfully'));
}
else
{
	echo json_encode(array('message'=>'login failed'));
}
?>