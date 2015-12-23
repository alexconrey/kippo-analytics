<?php
include('header.php');
		global $mysqli;
        $sql = "SELECT password FROM auth WHERE timestamp BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59' LIMIT 128";
        if(!$result = $mysqli->query($sql)) {
                echo "Couldn't run that query";
                exit;
        }
        if($result->num_rows === 0) {
                $error = throwError("That isn't showing in the records.");
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


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Popular Passwords</h1>

<?php if(isset($error)) {
        echo $error;
        exit;
}
?>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Start Time</td>
				<td>End Time</td>
				<td>Sensor</td>
				<td>Username</td>
				<td>Password</td>
				<td>IP</td>
			</tr>
		</thead>
	<tbody>
		<?php
		foreach($counted_list as $item) {
			print_r($item);
		}
		?>
	</tbody>
</table>
</div>
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

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 200px; height: 200px;"></div>
