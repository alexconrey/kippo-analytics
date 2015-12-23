<?php

include('functions.php');

$myqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
$sql = "SELECT * FROM sessions";
if(!$result = $mysqli->query($sql)) {
	echo "Couldn't run that query right now.";
	exit;
}
if($result->num_rows === 0) {
	echo "Could not find any established connections";
	exit;
}

?>

<table>
<tr>
	<td>Session ID</td>
	<td>Start Date & Time</td>
	<td>End Date & Time</td>
	<td>Sensor</td>
	<td>IP</td>
</tr>
<?php

while($session = $result->fetch_assoc()) {
	echo "<tr>";
	echo "<td>".$session['id']."</td>";
	echo "<td>".$session['starttime']."</td>";
	echo "<td>".$session['endtime']."</td>";
	echo "<td>".$session['sensor']."</td>";
	echo "<td>".$session['ip']."</td>";
	echo "</tr>";
}
?>

</table>
