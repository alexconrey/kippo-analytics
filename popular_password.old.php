<?php
include('functions.php');

        $ip = $_GET['ip'];
        $mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
        $sql = "SELECT password FROM auth";
        if(!$result = $mysqli->query($sql)) {
                echo "Couldn't run that query";
                exit;
        }
        if($result->num_rows === 0) {
                echo "No matches";
                exit;
        }

	$list = array();
	while($attempt = $result->fetch_assoc()) {
		$list[] = $attempt['password'];
	}

	$unique_list = array_unique($list);
	$counted_list = array_count_values($list);
?>

<html>
<head>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("visualization","1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Password', 'Attempts'],
				['Test','1'],
				['Test 2','3'],
			<?php
			foreach($unique_list as $i) {
				echo "['".$i."', '".$counted_list[$i]."'],";
			}
			?>
			]);

			var options = {
				title: 'Password Attempts'
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
		}
	</script>
</head>
<table>
<tr>
	<td>Password</td>
	<td>Attempts</td>
</tr>
<?php
	foreach($unique_list as $i) {
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$counted_list[$i]."</td>";
		echo "</tr>";
	}
	
//	echo("<pre>".print_r(array_count_values($list))."</pre>");
?>

</table>
<div id="piechart" style="width: 900px; height: 500px;"></div>
			<?php
			foreach($unique_list as $i) {
				echo "['".$i."', '".$counted_list[$i]."'],\n";
			}
			?>

