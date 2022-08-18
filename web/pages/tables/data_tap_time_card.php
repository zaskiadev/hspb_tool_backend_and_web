<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=export-data-tap-time-card.xls");
?>

<?php
$filter_by="";

if(isset($_GET['filter_by'])){
  $filter_by=$_GET['filter_by'];
}
echo "Ventaza Tap Time Card Filtered Data By : $filter_by"
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


    $sql = mysqli_query($CON, "SELECT * FROM tap_time_card ORDER BY no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_tap_time_card'] . '</td>
  <td>' . $data['next_tap_time_card'] . '</td>
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


  $sql = mysqli_query($CON,"SELECT * FROM tap_time_card where last_tap_time_card ='0000-00-00' ORDER BY no_kamar ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_tap_time_card'] . '</td>
  <td>' . $data['next_tap_time_card'] . '</td>
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
    $sql = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card AND next_tap_time_card < '$changedate' ORDER BY tap_time_card.no_kamar");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_tap_time_card'] . '</td>
  <td>' . $data['next_tap_time_card'] . '</td>
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
      "   <th>LAST EXECUTED BY</th>".
      "  </tr>";

    $date = new DateTime();


    $daterecord=$date->format('Y-m-d');
    $date->add(new DateInterval('P2W'));
    $changedate=$date->format('Y-m-d');
    $sql = mysqli_query($CON,"SELECT tap_time_card.no_kamar, tap_time_card.next_tap_time_card, tap_time_card.last_tap_time_card, log_tap_time_card.user FROM tap_time_card INNER JOIN log_tap_time_card ON tap_time_card.no_kamar = log_tap_time_card.no_kamar WHERE tap_time_card.last_tap_time_card=log_tap_time_card.date_tap_time_card ORDER BY tap_time_card.no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['last_tap_time_card'] . '</td>
  <td>' . $data['next_tap_time_card'] . '</td>
    <td>' . $data['user'] . '</td>
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
      "  <th>USER EXECUTED</th>".
      "  </tr>";
    $sql = mysqli_query($CON,"SELECT * from log_tap_time_card ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_tap_time_card'] . '</td>
    <td>' . $data['user'] . '</td>
  </tr>
  ';
    }

  }
  elseif ($filter_by=="room_number_log")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE EXECUTED</th>".
      "  <th>USER EXECUTED</th>".
      "  </tr>";
    $room_number_search_log="";

    if(isset($_GET['room_number_search_log'])){
      $room_number_search_log=$_GET['room_number_search_log'];
    }

    $sql = mysqli_query($CON,"SELECT * from log_tap_time_card where no_kamar='$room_number_search_log' ORDER BY date_tap_time_card DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
			<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_tap_time_card'] . '</td>
    <td>' . $data['user'] . '</td>
  </tr>
  ';
    }

  }

  ?>
</table>
