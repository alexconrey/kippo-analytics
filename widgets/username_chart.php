<?php
include('../functions.php');
global $mysqli;
        $sql = "SELECT username FROM auth WHERE timestamp BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'";
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
                $list[] = $attempt['username'];
        }

        $unique_list = array_unique($list);
	$counted_list = array_count_values($list);
	arsort($counted_list);
//	print_r($counted_list);

?>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Password', 'Attempts'],
	  <?php 
	  foreach($unique_list as $i) {
		echo "['".$i."', ".$counted_list[$i]."],\n";
	  }
	  ?>
        ]);

        var options = {
	  chartArea: {width:'90%', height: '90%'},
	  legend: {position: 'none'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart-username'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart-username" style="width: 200px; height: 200px;"></div>