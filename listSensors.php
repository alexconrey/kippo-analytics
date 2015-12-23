<?php

include('header.php');
//$sensors = fetchSensors();

?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Sensor List</h1>

          <div class="row placeholders">
          </div>
<?php
if(!$result = $mysqli->query("SELECT * FROM sensors")) {
        echo "Couldn't run that query right now.";
        exit;
}
if($result->num_rows === 0) {
        echo "Could not find any established connections";
        exit;
}

?>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Sensor ID</th>
                  <th>Sensor IP</th>
                  <th>Hostname</th>
                </tr>
              </thead>
              <tbody>
		<?php
		$sensors = fetchSensors();
		foreach($sensors as $sensor) {
			echo "<tr>";
			echo "<td>".$sensor['id']."</td>";
			echo "<td>".$sensor['ip']."</td>";
			echo "<td>".$sensor['hostname']."</td>";
			echo "</tr>";
		}

		?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

