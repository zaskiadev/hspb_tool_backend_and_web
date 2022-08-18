<?php

//fetch_data.php
$output[] = array();

$connect = new PDO("mysql:host=localhost;dbname=hspb_tool", "root", "!TS3l4lu0nc4ll");

$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET')
{
 $data = array(
  ':no_kamar'   => "%".$_GET['no_kamar']."%",
  ':last_change_battery'   => "%".$_GET['last_change_battery']."%",
  ':next_change_battery'     => "%".$_GET['next_change_battery']."%"
 );
 $query = "SELECT * from batery_kamar WHERE no_kamar LIKE :no_kamar AND last_change_battery LIKE :last_change_battery AND next_change_battery LIKE :next_change_battery ORDER BY no_kamar DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'no_kamar'  => $row['no_kamar'],
   'last_change_battery'   => $row['last_change_battery'],
   'next_change_battery'    => $row['next_change_battery']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array(
  ':first_name'  => $_POST['first_name'],
  ':last_name'  => $_POST["last_name"],
  ':age'    => $_POST["age"],
  ':gender'   => $_POST["gender"]
 );

 $query = "INSERT INTO sample_data (first_name, last_name, age, gender) VALUES (:first_name, :last_name, :age, :gender)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':id'   => $_PUT['id'],
  ':first_name' => $_PUT['first_name'],
  ':last_name' => $_PUT['last_name'],
  ':age'   => $_PUT['age'],
  ':gender'  => $_PUT['gender']
 );
 $query = "
 UPDATE sample_data
 SET first_name = :first_name,
 last_name = :last_name,
 age = :age,
 gender = :gender
 WHERE id = :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM sample_data WHERE id = '".$_DELETE["id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
