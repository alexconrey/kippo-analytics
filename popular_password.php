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
	arsort($counted_list);
//	print_r($counted_list);

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Password', 'Attempts'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
	  <?php 
	  foreach($unique_list as $i) {
		echo "['".$i."', ".$counted_list[$i]."],\n";
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
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
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
?>
    </table>
</body>
</html>

