<?php
include('functions.php');

        $date = $_GET['date'];
        $mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
	$starttime = $date . ' 00:00:00';
	$endtime = $date . ' 23:59:59';
        $sql = "SELECT * FROM auth, sessions WHERE auth.session = sessions.id AND starttime BETWEEN '$starttime' AND '$endtime'";
        if(!$result = $mysqli->query($sql)) {
                echo "Couldn't run that query";
		echo $mysqli->connect_error;
                exit;
        }
        if($result->num_rows === 0) {
                echo "No matches";
                exit;
        }
?>
<table>
<tr>
	<td>ID</td>
	<td>Start Time</td>
	<td>End Time</td>
	<td>Sensor</td>
	<td>Username</td>
	<td>Password</td>
	<td>IP</td>
</tr>

<?php


        while($attempt = $result->fetch_assoc()) {
                $list['id'] = $attempt['id'];
		$list['starttime'] = $attempt['starttime'];
		$list['endtime'] = $attempt['endtime'];
		$list['sensor'] = $attempt['sensor'];
		echo "<tr>";
		echo "<td>".$attempt['id']."</td>";
		echo "<td>".$attempt['starttime']."</td>";
		echo "<td>".$attempt['endtime']."</td>";
		echo "<td>".$attempt['sensor']."</td>";
		echo "<td>".$attempt['username']."</td>";
		echo "<td>".$attempt['password']."</td>";
		echo "<td>".$attempt['ip']."</td>";
		echo "</tr>";	
        }


?>

<?php

foreach($list as $i) {
}
?>
</table>
