<?php
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=export-data-ventaza_maintenance.xls");
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


  if ($filter_by=="all_log")
  {
    echo "<table border='1'>".
      " <tr> ".
      "  <th>NO KAMAR</th>".
      "  <th>DATE MAINTENANCE</th>".
      "  <th>MAINTENANCE TYPE</th>".
      "  <th>REMARK</th>".
      "  <th>USER</th>".
      "  </tr>";
    $sql = mysqli_query($CON,"SELECT * from ventaza_maintenance_record ORDER BY no_kamar DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
    <td>' . $data['maintenace_type'] . '</td>
    <td>' . $data['remark'] . '</td>
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
      "  <th>DATE MAINTENANCE</th>".
      "  <th>MAINTENANCE TYPE</th>".
      "  <th>REMARK</th>".
      "  <th>USER</th>".
      "  </tr>";
    $room_number_search_log="";

    if(isset($_GET['room_number_search_log'])){
      $room_number_search_log=$_GET['room_number_search_log'];
    }

    $sql = mysqli_query($CON,"SELECT * from ventaza_maintenance_record where no_kamar='$room_number_search_log' ORDER BY date_maintenance DESC");

    while ($data = mysqli_fetch_assoc($sql)) {
      echo '
		<tr>
  <td>' . $data['no_kamar'] . '</td>
  <td>' . $data['date_maintenance'] . '</td>
    <td>' . $data['maintenace_type'] . '</td>
    <td>' . $data['remark'] . '</td>
    <td>' . $data['user'] . '</td>
  </tr>
  ';
    }

  }

  ?>
</table>
