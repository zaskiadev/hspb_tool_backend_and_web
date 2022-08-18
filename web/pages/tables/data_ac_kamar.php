<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=export-data-ac-kamar.xls");
?>

<?php
$filter_by="";

if(isset($_GET['filter_by'])){
  $filter_by=$_GET['filter_by'];
}
echo "Table Record AC Room Maintenance Filtered Data By : $filter_by"
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

    $sql = mysqli_query($CON, "SELECT * FROM ac_room_maintenance ORDER BY room_number ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  <td>' . $data['date_next_maintenance'] . '</td>
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

  $sql = mysqli_query($CON,"SELECT * FROM ac_room_maintenance where date_maintenance ='0000-00-00' ORDER BY room_number ASC");

  while ($data = mysqli_fetch_assoc($sql)) {
    echo '
		<tr>
  <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  <td>' . $data['date_next_maintenance'] . '</td>
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
    $sql = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number WHERE ac_room_maintenance.date_maintenance=log_ac_maintenance.date_maintenance AND next_tap_time_card < '$changedate' ORDER BY tap_time_card.room_number");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
   <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  <td>' . $data['date_next_maintenance'] . '</td>
  <td>' . $data['user'] . '</td>
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
    $sql = mysqli_query($CON,"SELECT ac_room_maintenance.room_number, ac_room_maintenance.date_maintenance, ac_room_maintenance.date_next_maintenance, log_ac_maintenance.user FROM ac_room_maintenance INNER JOIN log_ac_maintenance ON ac_room_maintenance.room_number = log_ac_maintenance.room_number WHERE log_ac_maintenance.date_maintenance LIKE CONCAT('%', ac_room_maintenance.date_maintenance, '%') ORDER BY ac_room_maintenance.room_number DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
   <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  <td>' . $data['date_next_maintenance'] . '</td>
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
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>CLEANING</th>".
      "  <th>TUNING FILTER</th>".
      "  <th>BLOWER</th>".
      "  <th>COIL AND EVAVORATOR</th>".
      "  <th>VACUM DRAIN</th>".
      "  <th>CHECKING DUCTING CONNECTION</th>".
      "  <th>REMARK</th>".
      "  <th>USER EXECUTED</th>".
      "  </tr>";

    $sql = mysqli_query($CON,"SELECT * FROM log_ac_maintenance  ORDER BY room_number ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  ';
      if($data['isRepairBrokenPart']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCleaningFilter']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isBlower']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCoilEvavorator']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isVacumDrain']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCheckingDuctingConnection']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      echo '<td>' . $data['remark'] . '</td>
    <td>' . $data['user'] . '</td>
  </tr>
      ';
    }

  } elseif ($filter_by=="room_number_log")
  {
    if(isset($_GET['room_number_search_log'])){
      $room_number_search_log=$_GET['room_number_search_log'];
    }

    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>LAST DATE EXECUTED</th>".
      "  <th>CLEANING</th>".
      "  <th>TUNING FILTER</th>".
      "  <th>BLOWER</th>".
      "  <th>COIL AND EVAVORATOR</th>".
      "  <th>VACUM DRAIN</th>".
      "  <th>CHECKING DUCTING CONNECTION</th>".
      "  <th>REMARK</th>".
      "  <th>USER EXECUTED</th>".
      "  </tr>";

    $sql = mysqli_query($CON,"SELECT * FROM log_ac_maintenance where room_number='$room_number_search_log' ORDER BY date_maintenance ASC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['room_number'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
  ';
      if($data['isRepairBrokenPart']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCleaningFilter']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isBlower']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCoilEvavorator']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isVacumDrain']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      if($data['isCheckingDuctingConnection']!=0)
      {
        echo '<td> Yes </td>';
      }
      else
      {
        echo '<td> NO </td>';
      }

      echo '<td>' . $data['remark'] . '</td>
    <td>' . $data['user'] . '</td>
  </tr>
      ';
    }
  }

  ?>
</table>
