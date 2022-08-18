<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=export-data-keytag-update.xls");
?>

<?php
$filter_by="";

if(isset($_GET['filter_by'])){
  $filter_by=$_GET['filter_by'];
}
echo "Table Keytag Update Filtered Data By : $filter_by"
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

    $sql = mysqli_query($CON, "SELECT * FROM keytag_update ORDER BY no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_keytag_update'] . '</td>
  <td>' . $data['next_keytag_update'] . '</td>
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
  $sql = mysqli_query($CON,"SELECT * FROM keytag_update where last_keytag_update ='0000-00-00' ORDER BY no_kamar ASC");

  while ($data = mysqli_fetch_assoc($sql)) {
    echo '
		<tr>
 <tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_keytag_update'] . '</td>
  <td>' . $data['next_keytag_update'] . '</td>
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
      "   <th>LAST EXECUTED BY</th>".
      "  </tr>";
    $date = new DateTime();


    $daterecord=$date->format('Y-m-d');
    $date->add(new DateInterval('P2W'));
    $changedate=$date->format('Y-m-d');
    $sql = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update AND where keytag_update.next_keytag_update < '$changedate' AND keytag_update.last_keytag_update !='0000-00-00' ORDER BY keytag_update.no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
 <tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_keytag_update'] . '</td>
  <td>' . $data['next_keytag_update'] . '</td>
  <td>' . $data['user_keytag_update'] . '</td>
  </tr>
  ';
    }

  }
  elseif($filter_by=="all_log")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE EXECUTED</th>".

      "   <th>EXECUTED BY</th>".
      "  </tr>";
    $sql = mysqli_query($CON,"SELECT * from log_keytag_update ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_keytag_update'] . '</td>
  <td>' . $data['user_keytag_update'] . '</td>
  </tr>
  ';
    }
  }
  elseif($filter_by=="room_number_log")
  {
    if(isset($_GET['room_number_search_log'])){
      $room_number_search_log=$_GET['room_number_search_log'];
    }
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE EXECUTED</th>".

      "   <th>EXECUTED BY</th>".
      "  </tr>";
    $sql = mysqli_query($CON,"SELECT * from log_keytag_update where no_kamar='$room_number_search_log' ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
 <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_keytag_update'] . '</td>
  <td>' . $data['user_keytag_update'] . '</td>
  </tr>
  ';
    }
  }
  elseif($filter_by=="already_execute")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>NEXT DATE EXECUTED</th>".
      "   <th>LAST EXECUTED BY</th>".
      "  </tr>";
    $sql = mysqli_query($CON,"SELECT keytag_update.no_kamar, keytag_update.last_keytag_update, keytag_update.next_keytag_update, log_keytag_update.user_keytag_update FROM `keytag_update` INNER JOIN log_keytag_update ON keytag_update.no_kamar=log_keytag_update.no_kamar WHERE keytag_update.last_keytag_update=log_keytag_update.date_keytag_update ORDER BY keytag_update.last_keytag_update DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_change_battery'] . '</td>
  <td>' . $data['next_change_battery'] . '</td>
  <td>' . $data['user_keytag_update'] . '</td>
  </tr>
  ';
    }
  }

  ?>
</table>
