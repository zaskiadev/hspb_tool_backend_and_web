<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=export-data-battery-kamar.xls");
?>

<?php
$filter_by="";

if(isset($_GET['filter_by'])){
  $filter_by=$_GET['filter_by'];
}
echo "Table Battery Kamar Filtered Data By : $filter_by"
?>

  <?php

	require_once('connection.php');




  if($filter_by=="all") {

    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>NEXT DATE EXECUTED</th>".
      "  </tr>";


    $sql = mysqli_query($CON, "SELECT * FROM batery_kamar ORDER BY no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_change_battery'] . '</td>
  <td>' . $data['next_change_battery'] . '</td>
  </tr>
  ';
    }
  }
  elseif ($filter_by=="never_execute")
  {

    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>NEXT DATE EXECUTED</th>".
      "  </tr>";

  $sql = mysqli_query($CON,"SELECT * FROM batery_kamar where last_change_battery ='0000-00-00' ORDER BY no_kamar ASC");

  while ($data = mysqli_fetch_assoc($sql)) {
    echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_change_battery'] . '</td>
  <td>' . $data['next_change_battery'] . '</td>
  </tr>
  ';
  }
  }
  elseif ($filter_by=="urgent_to_execute")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>NEXT DATE EXECUTED</th>".
      "<th>USER EXECUTE</th>".
      "  </tr>";
    $date = new DateTime();


    $daterecord=$date->format('Y-m-d');
    $date->add(new DateInterval('P2W'));
    $changedate=$date->format('Y-m-d');
    $sql = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery AND next_change_battery < '$changedate' ORDER BY batery_kamar.no_kamar");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_change_battery'] . '</td>
  <td>' . $data['next_change_battery'] . '</td>
   <td>' . $data['user_change_battery'] . '</td>
  </tr>
  ';
    }

  }
  elseif ($filter_by=="already_execute")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>NEXT DATE EXECUTED</th>".
      "<th>USER EXECUTE</th>".
      "  </tr>";

    $date = new DateTime();


    $daterecord=$date->format('Y-m-d');
    $date->add(new DateInterval('P2W'));
    $changedate=$date->format('Y-m-d');
    $sql = mysqli_query($CON,"SELECT batery_kamar.no_kamar, batery_kamar.last_change_battery, batery_kamar.next_change_battery, log_change_battery.user_change_battery FROM batery_kamar INNER JOIN log_change_battery ON batery_kamar.no_kamar = log_change_battery.no_kamar WHERE batery_kamar.last_change_battery=log_change_battery.date_change_battery ORDER BY batery_kamar.no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_change_battery'] . '</td>
  <td>' . $data['next_change_battery'] . '</td>
     <td>' . $data['user_change_battery'] . '</td>
  </tr>
  ';
    }

  }
  elseif ($filter_by=="all_log")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE EXECUTED</th>".
      "<th>USER EXECUTE</th>".
      "  </tr>";

    $sql = mysqli_query($CON,"SELECT * from log_change_battery ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_change_battery'] . '</td>
  <td>' . $data['user_change_battery'] . '</td>

  </tr>
  ';
    }

  }
  elseif ($filter_by=="room_number_log")
  {
    $room_number_search_log="";

    if(isset($_GET['room_number_search_log'])){
      $room_number_search_log=$_GET['room_number_search_log'];
    }

    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE EXECUTED</th>".
      "<th>USER EXECUTE</th>".
      "  </tr>";

    $sql = mysqli_query($CON,"SELECT * from log_change_battery where no_kamar =$room_number_search_log  ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_change_battery'] . '</td>
  <td>' . $data['user_change_battery'] . '</td>
  </tr>
  ';
    }

  }

  ?>
</table>
