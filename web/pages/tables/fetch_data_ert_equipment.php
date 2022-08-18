<?php

//fetch_data.php
$output[] = array();

$connect = new PDO("mysql:host=localhost;dbname=hspb_tool", "root", "!TS3l4lu0nc4ll");

$method = $_SERVER['REQUEST_METHOD'];


if($method == 'GET')
{
 $data = array(
  ':room_number'   => "%".$_GET['room_number']."%",
  ':date_maintenance'   => "%".$_GET['date_maintenance']."%",
  ':date_next_maintenance'     => "%".$_GET['date_next_maintenance']."%"
 );
 $query = "SELECT * from ac_room_maintenance WHERE room_number LIKE :room_number AND date_maintenance LIKE :date_maintenance AND date_next_maintenance LIKE :date_next_maintenance ORDER BY room_number DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'room_number'  => $row['room_number'],
   'date_maintenance'   => $row['date_maintenance'],
   'date_next_maintenance'    => $row['date_next_maintenance']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

/*if($method == "POST")
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
}*/

?>
