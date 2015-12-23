<?php
global $mysqli;
        $sql = "SELECT starttime FROM sessions LIMIT 200";
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
                $list[] = date('l', strtotime($attempt['starttime']));
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

        var chart = new google.visualization.PieChart(document.getElementById('piechart-dow'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart-dow" style="width: 200px; height: 200px;"></div>
