<table border="1">
  <tr>
    <th>NO KAMAR</th>
    <th>LAST DATE EXECUTED</th>
    <th>NEXT DATE EXECUTED</th>
  </tr>
  <?php
	require_once('connection.php');
	

	$sql = mysqli_query($CON,"SELECT * FROM batery_kamar ORDER BY no_kamar ASC");

	while($data = mysqli_fetch_assoc($sql)){
	echo '
		<tr>
  <td>'.$data['no_kamar'].'</td>
  <td>'.$data['last_change_battery'].'</td>
  <td>'.$data['next_change_battery'].'</td>
  </tr>
  ';
  }
  ?>
</table>
