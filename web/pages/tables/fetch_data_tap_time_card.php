<?php

//fetch_data.php
$output[] = array();

$connect = new PDO("mysql:host=localhost;dbname=hspb_tool", "root", "!TS3l4lu0nc4ll");

$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET')
{
 $data = array(
  ':no_kamar'   => "%".$_GET['no_kamar']."%",
  ':last_tap_time_card'   => "%".$_GET['last_tap_time_card']."%",
  ':next_tap_time_card'     => "%".$_GET['next_tap_time_card']."%"
 );
 $query = "SELECT * from tap_time_card WHERE no_kamar LIKE :no_kamar AND last_tap_time_card LIKE :last_tap_time_card AND next_tap_time_card LIKE :next_tap_time_card ORDER BY no_kamar DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {

  $output[] = array(
   'no_kamar'  => $row['no_kamar'],
   'last_tap_time_card'   => $row['last_tap_time_card'],
   'next_tap_time_card'    => $row['next_tap_time_card']
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
