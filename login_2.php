<?php
require_once('connection.php');

$usr = $_POST['user'];

$pas = $_POST['pass'];

$query = mysqli_query($CON,"SELECT * FROM user where user='$usr' and password='$pas'");

$cek = mysqli_num_rows($query);
$result = array();

while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
}
echo json_encode(array('result'=>$result));


?>